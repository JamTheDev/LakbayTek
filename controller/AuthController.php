<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}

include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

include("types/AuthTypes.php");
include("../types/AuthTypes.php");


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

        $id = genid(16, 4);
        $hashed_password = password_hash(base64_encode(hash("sha256", $password, true)), PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $conn->prepare(
            "
            INSERT INTO Users 
            (user_id, username, email, gender, birthdate, address, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssssss", $id, $username, $email, $gender, $bday, $address, $hashed_password);
        $stmt->execute();

        $conn->commit();

        if ($stmt->get_result()) {
            return new User($id, $username, $email, $gender, $bday, $address, $hashed_password);
        }

        return User::raise_error("Ewan ko mhie");
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

function findUserBySession(): User
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
