<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}

include("PHPMailer/src/PHPMailer.php");
include("PHPMailer/src/Exception.php");
include("PHPMailer/src/SMTP.php");

include("../PHPMailer/src/PHPMailer.php");
include("../PHPMailer/src/Exception.php");
include("../PHPMailer/src/SMTP.php");

function login(string $email, string $password, bool $_persist): User
{
    try {
        global $conn;

        $conn->begin_transaction();

        $stmt = $conn->prepare("
            SELECT *
            FROM Users
            WHERE email = ?;
        ");

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::NoAccount);
        }

        $assoc_result = $result->fetch_assoc();
        $stmt->free_result();

        if (password_verify(base64_encode(hash("sha256", $password, true)), $assoc_result["password"])) {
            $conn->commit();
            if ($_persist) {
                create_secure_session($assoc_result["user_id"]);
            }
            return User::from_assoc($assoc_result);
        }

        return User::raise_error(AuthenticationErrors::WrongPassword);
    } catch (Exception $e) {
        $conn->rollback();
        return User::raise_error("Error: {$e->getMessage()}");
    }
}


function register(string $username, string $email, string $password, string $confirm_password, string $gender, mixed $bday, string $address): User
{
    global $conn;

    try {
        $conn->begin_transaction();

        // Check if account already exists
        $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::AccountAlreadyExists);
        }

        if ($password != $confirm_password) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::PasswordsNotMatching);
        }

        $stmt->close();

        $id = genid(16, 3);
        $hashed_password = password_hash(base64_encode(hash("sha256", $password, true)), PASSWORD_DEFAULT);

        $verified = 0;

        $stmt = $conn->prepare(
            "INSERT INTO Users 
            (user_id, username, email, gender, birthdate, address, password, verified) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssssssi", $id, $username, $email, $gender, $bday, $address, $hashed_password, $verified);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $conn->commit();
            return new User($id, $username, $email, $gender, $bday, $address, $hashed_password, $verified);
        }

        return User::raise_error($stmt->get_result());
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        return User::raise_error("Error: " . $e->getMessage());
    }
}

function updateProfile(User $user, string $newUsername, string $newEmail, string $newAddress): bool
{
    global $conn;

    try {
        $conn->begin_transaction();

        // Check if the new email is already associated with another account
        $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? AND user_id <> ?");
        $stmt->bind_param("ss", $newEmail, $user->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $conn->rollback();
            return false; // Return false indicating the email is already in use
        }

        $stmt->close();

        // Update the user's profile
        $stmt = $conn->prepare("UPDATE Users SET username = ?, email = ?, address = ? WHERE user_id = ?");
        $stmt->bind_param("ssss", $newUsername, $newEmail, $newAddress, $user->user_id);
        $stmt->execute();

        $conn->commit();

        return true; // Return true indicating the profile update was successful
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        return false; // Return false if an error occurred during the profile update
    }
}



function create_secure_session(string $user_id): bool
{
    try {
        global $conn;
        $conn->begin_transaction();
        // https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
        $selector = generateToken();
        $validator = generateToken();

        $hashed_validator = password_hash(hash("sha256", $validator), PASSWORD_DEFAULT);
        $currentDate = new DateTime();
        $currentDate->modify('+30 days');

        $stmt = $conn->prepare("
            INSERT INTO user_tokens (selector, hashed_validator, user_id, expiry) VALUES (
                ?, ?, ?, ?
            );
        ");

        $stmt->bind_param("ssss", $selector, $hashed_validator, $user_id, $currentDate->format('Y-m-d'));
        $stmt->execute();

        setcookie("rememberme", "$selector:$validator", time() + 60 * 60 * 24 * 30, '/');
        $conn->commit();
        $stmt->close();
        return isset($_COOKIE["rememberme"]);
    } catch (Exception $e) {
        return false;
    }
}

function getSessionDetails(): ?array
{
    try {
        global $conn;
        $conn->begin_transaction();

        $selector = fetchRememberMeToken()[0];

        $stmt = $conn->prepare("SELECT * FROM user_tokens WHERE selector = ? LIMIT 1");
        $stmt->bind_param("s", $selector);
        $stmt->execute();

        $result = $stmt->get_result();
        $assoc_result = $result->fetch_assoc();

        $conn->commit();
        $stmt->close();
        return $assoc_result;
    } catch (Exception $e) {
        $conn->rollback();
        // Handle and log the exception
        return null;
    }
}

function getUserBySession(): User
{
    global $conn;
    try {
        $conn->begin_transaction();

        $session_details = getSessionDetails();

        if ($session_details === null || empty($session_details)) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::AccountAlreadyExists);
        }

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id = ?;");
        $stmt->bind_param("s", $session_details["user_id"]);
        $stmt->execute();

        $result = $stmt->get_result();
        $assoc_result = $result->fetch_all(MYSQLI_ASSOC)[0];

        if ($result->num_rows <= 0) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::NoAccount);
        }

        $stmt->close();
        $conn->commit();
        return User::from_assoc($assoc_result);
    } catch (Exception $e) {
        $conn->rollback();
        // Handle and log the exception
        return User::raise_error("Error: " . $e->getMessage());
    }
}

function logout($redirect = "index.php")
{
    global $conn;

    try {
        $conn->begin_transaction();
        $selector = fetchRememberMeToken()[0];

        $stmt = $conn->prepare(
            "DELETE FROM user_tokens WHERE selector = ?"
        );

        $stmt->bind_param("s", $selector);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0 && $_COOKIE["rememberme"]) {
            $_COOKIE["rememberme"] = NULL;
        }

        $conn->commit();
        header("Location: $redirect");
    } catch (Exception $e) {
        header("Location: $redirect?err={$e->getMessage()}");
    }
}

function fetchRememberMeToken(): ?array
{
    return explode(":", $_COOKIE["rememberme"]);
}


function verifyRememberMeToken(): bool
{

    global $conn;

    try {
        $conn->begin_transaction();

        if (!isset($_COOKIE["rememberme"])) {
            $conn->commit();
            return false;
        }


        $session_details = getSessionDetails();
        if ($session_details === null || empty($session_details)) {
            $conn->rollback();
            return false;
        }

        if (password_verify(hash("sha256", fetchRememberMeToken()[1]), $session_details["hashed_validator"])) {
            $today = new DateTime();
            $expiry = new DateTime($session_details["expiry"]);
            if ($today >= $expiry) {
                logout();
                return false;
            }
            return true;
        }

        return false;
    } catch (Exception $e) {
        $conn->rollback();
        // Handle and log the exception
        return false;
    }
}

function isVerificationCodeActive(string $user_id): bool
{
    try {
        global $conn;

        $currentDateTime = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("
            SELECT *
            FROM PasswordReset
            WHERE user_id = ? AND expiration >= ?;
        ");

        $stmt->bind_param("ss", $user_id, $currentDateTime);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result->num_rows > 0;
    } catch (Exception $e) {
        return false;
    }
}


function verifyEmail(string $email, string $token): bool
{
    try {
        global $conn;

        $stmt = $conn->prepare("
            SELECT user_id
            FROM PasswordReset
            WHERE reset_token = ? AND expiration >= ?;
        ");

        $expiration = date('Y-m-d H:i:s');
        $stmt->bind_param("ss", $token, $expiration);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            return false;
        }

        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        $stmt = $conn->prepare("
            UPDATE Users
            SET verified = 1
            WHERE email = ?;
        ");

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;

        $stmt = $conn->prepare("
            DELETE FROM PasswordReset
            WHERE user_id = ?;
        ");

        $stmt->bind_param("s", $user_id);
        $stmt->execute();

        $stmt->close();

        return $affectedRows > 0;
    } catch (Exception $e) {
        return false;
    }
}


function generateVerificationToken(string $user_id): ?string
{
    try {
        global $conn;

        $token = generateToken();
        $expiration = date('Y-m-d H:i:s', strtotime('+30 minutes')); // Token expires after 1 day

        $stmt = $conn->prepare("
            INSERT INTO PasswordReset (user_id, reset_token, expiration)
            VALUES (?, ?, ?);
        ");

        $stmt->bind_param("sss", $user_id, $token, $expiration);
        $stmt->execute();

        $stmt->close();

        return $token;
    } catch (Exception $e) {
        // Handle and log the exception
        return null;
    }
}


function sendVerificationEmail(string $email, string $token): bool
{
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply.casaquerencia@gmail.com';
        $mail->Password = 'xdglrnlicmrwqaht';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Sender and recipient
        $mail->setFrom('noreply.casaquerencia@gmail.com', 'Casa Querencia');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "Click the following link to verify your email: <a href=\"localhost/LakbayTek/verify_token.php?token=$token\">Verify Email</a>";

        $mail->send();

        return true;
    } catch (Exception $e) {
        // Handle and log the exception
        return false;
    }
}
