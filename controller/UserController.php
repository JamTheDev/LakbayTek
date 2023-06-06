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

function get_user(string $user_id): User
{
    if (!verifyRememberMeToken()) return User::raise_error(AuthenticationErrors::ExpiredSessionID);

    global $conn;

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare(
            "SELECT * FROM Users WHERE user_id = ? LIMIT 1"
        );

        $stmt->bind_param("s", $user_id);
        $result = $stmt->get_result();

        if ($result->num_rows < 0) return User::raise_error(AuthenticationErrors::NoAccount);
        $assoc_result = $result->fetch_assoc();
        $stmt->free_result();

        return User::from_assoc($assoc_result);
    } catch (Exception $e) {
    }
}
