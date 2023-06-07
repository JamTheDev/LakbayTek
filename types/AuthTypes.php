<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}

include("../enums/ErrorEnums.php");
include("enums/ErrorEnums.php");

class User
{
    public mixed $user_id;
    public mixed $username;
    public mixed $email;
    public mixed $address;
    public mixed $gender;
    public mixed $date;
    public mixed $password;
    public mixed $verified;

    public mixed $ERR_CODE = AuthenticationErrors::None;

    public function __construct(
        mixed $user_id = NULL,
        mixed $username = NULL,
        mixed $email = NULL,
        mixed $address = NULL,
        mixed $gender = NULL,
        mixed $date = NULL,
        mixed $password = NULL,
        mixed $verified = NULL,
        mixed $ERR_CODE = AuthenticationErrors::None
    ) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->gender = $gender;
        $this->date = $date;
        $this->password = $password;
        $this->verified = $verified;
        $this->ERR_CODE = $ERR_CODE;
    }

    public function is_null(): bool {
        return is_null($this->user_id); 
    }

    public static function raise_error(mixed $err): User
    {
        return new self(NULL, NULL, NULL, NULL, NULL, NULL, NULL,  NULL, $err);
    }

    public static function from_assoc(mixed $_obj): User
    {
        return new self(
            $_obj["user_id"],
            $_obj["username"],
            $_obj["email"],
            $_obj["address"],
            $_obj["gender"],
            $_obj["birthdate"],
            $_obj["password"],
            $_obj["verified"],
        );
    }
}
