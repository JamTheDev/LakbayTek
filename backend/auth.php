<?php
include("bootstrap.php");
include("../bootstrap.php");
include("utils/idgen.php");
include("../utils/idgen.php");


function login(string $email, string $password, bool $_persist): int
{
    global $conn;

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

function register(string $username, string $email, string $password, string $confirm_password, string $gender, mixed $bday, string $address): int
{
    global $conn;
    // check if account already exists
    $result = $conn->query("
        SELECT *
        FROM Users
        WHERE email = '$email';
    ");

    $data = json_encode(
        array(
            'email' => $email,
            'username' => $username,
        )
    );

    if ($result && $result->num_rows > 0) {
        return 2;
    }

    if ($password != $confirm_password) {
        return 3;
    }

    $id = genid(16, 4);
    $hashed_password = password_hash(base64_encode(hash("sha256", $password, true)), PASSWORD_DEFAULT);

    // insert to database
    $res = $conn->query("
        INSERT INTO Users (user_id, username, email, gender, birthdate, address, password) VALUES (
            '$id',
            '$username',
            '$email',
            '$gender',
            '$bday',
            '$address',
            '$hashed_password'
        );
    ");

    if ($res) return 0;
    return 1;
}

function create_secure_session(string $user_id): bool
{
    global $conn;
    // https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
    $selector = generateToken();
    $validator = generateToken();

    $hashed_validator = password_hash(hash("sha256", $validator), PASSWORD_DEFAULT);
    $currentDate = new DateTime();
    $currentDate->modify('+30 days');

    // insert natin token sa database
    $conn->query("
            INSERT INTO user_tokens (selector, hashed_validator, user_id, expiry) VALUES (
                '$selector',
                '$hashed_validator',
                '$user_id',
                '{$currentDate->format('Y-m-d')}'
            );
        ");

    setcookie("rememberme", "$selector:$validator", time() + 60 * 60 * 24 * 30, '/');
    return true;
}

function finduserbysession(): mixed
{
    global $conn;

    $__login_cookie = explode(":", $_COOKIE["rememberme"]);
    $selector = $__login_cookie[0];

    $exec = $conn->query(
        "SELECT * FROM user_tokens WHERE selector = '$selector' LIMIT 1"
    );

    $exec2 = $conn->query("SELECT * FROM Users WHERE user_id = '{$exec->fetch_assoc()['user_id']}' LIMIT 1;");

    return $exec2->fetch_assoc();
}

function logout($redirect = "index.php")
{
    global $conn;

    $__login_cookie = explode(":", $_COOKIE["rememberme"]);
    $selector = $__login_cookie[0];

    $exec = $conn->query(
        "DELETE FROM user_tokens WHERE selector = '$selector'"
    );

    if ($exec && $_COOKIE["rememberme"]) {
        $_COOKIE["rememberme"] = NULL;
    }

    header("Location: $redirect");
}


function autologin(): bool
{
    if (!isset($_COOKIE["rememberme"])) return false;

    global $conn;

    $__login_cookie = explode(":", $_COOKIE["rememberme"]);
    $selector = $__login_cookie[0];
    $validator = $__login_cookie[1];

    $exec = $conn->query(
        "SELECT * FROM user_tokens WHERE selector = '$selector' LIMIT 1"
    );

    $result = $exec->fetch_assoc();
    if ($result && $exec->num_rows <= 0) return false;
    if (password_verify(hash("sha256", $validator), $result["hashed_validator"])) {
        $today = new DateTime();
        if ($today >= new DateTime($result["birthdate"])) {
            logout();
            return false;
        }
        return true;
    }

    return false;
}
