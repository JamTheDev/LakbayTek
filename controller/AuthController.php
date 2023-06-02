<?php
include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");


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
        $result = $stmt->get_result();
        $assoc_result = $result->fetch_assoc();

        if ($result->num_rows < 0) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::NoAccount);
        }

        if (password_verify(base64_encode(hash($password, true)), $assoc_result["password"])) {
            $conn->commit();
            return User::from_assoc($assoc_result);
        }

        return User::raise_error(AuthenticationErrors::WrongPassword);
    } catch (Exception $e) {
        $conn->rollback();
        return User::raise_error("Error: {$e->getMessage()}");
    }

    // then query it
    $result = $conn->query("
        SELECT *
        FROM Users
        WHERE email = '$email';
    ");

    $exec = $result->fetch_assoc();
    if ($exec && $result->num_rows == 0) return 2;
    if (password_verify(base64_encode(hash("sha256", $password, true)), $exec["password"])) {
        if ($_persist) {
            create_secure_session($exec["user_id"]);
        }
        return 1;
    }

    return 0;
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

        $id = genid(16, 4);
        $hashed_password = password_hash(base64_encode(hash("sha256", $password, true)), PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $conn->prepare(
            "
            WITH inserted_user AS (
            INSERT INTO Users 
            (user_id, username, email, gender, birthdate, address, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
            RETURNING *
            ) SELECT * FROM inserted_user LIMIT 1"
        );
        $stmt->bind_param("sssssss", $id, $username, $email, $gender, $bday, $address, $hashed_password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $conn->commit();
            return User::from_assoc($stmt->get_result()->fetch_assoc());
        } else {
            $conn->rollback();
            return User::raise_error("Failed to insert user!");
        }
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        return User::raise_error("Error: " . $e->getMessage());
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
                '$selector',
                '$hashed_validator',
                '$user_id',
                '{}'
            );
        ");

        $stmt->bind_param("ssss", $selector, $hashed_validator, $user_id, $currentDate->format('Y-m-d'));
        $stmt->execute();

        setcookie("rememberme", "$selector:$validator", time() + 60 * 60 * 24 * 30, '/');
        $conn->commit();
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
        return $assoc_result;
    } catch (Exception $e) {
        $conn->rollback();
        // Handle and log the exception
        return null;
    }
}

function findUserBySession(): User
{
    try {
        global $conn;
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
        $assoc_result = $result->fetch_assoc();

        if ($result->num_rows <= 0) {
            $conn->rollback();
            return User::raise_error(AuthenticationErrors::NoAccount);
        }

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

    $selector = fetchRememberMeToken()[0];

    $exec = $conn->query(
        "DELETE FROM user_tokens WHERE selector = '$selector'"
    );

    if ($exec && $_COOKIE["rememberme"]) {
        $_COOKIE["rememberme"] = NULL;
    }

    header("Location: $redirect");
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