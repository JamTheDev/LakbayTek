<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}

include "enums/Statuses.php";
include "../enums/Statuses.php";

class Reservation
{
    public mixed $reservation_id;
    public mixed $package_id;
    public mixed $user_id;
    public mixed $reservation_status;
    public mixed $payment_status;
    public mixed $check_in_date;
    public mixed $check_out_date;

    public mixed $ERR_CODE;

    public function __construct(
        mixed $reservation_id = NULL,
        mixed $package_id  = NULL,
        mixed $user_id = NULL,
        mixed $reservation_status  = 0,
        mixed $payment_status = 0,
        mixed $check_in_date = NULL,
        mixed $check_out_date = NULL,
        mixed $ERR_CODE  = NULL
    ) {
        $this->reservation_id = $reservation_id;
        $this->package_id = $package_id;
        $this->user_id = $user_id;
        $this->reservation_status = 0;
        $this->payment_status = 0;
        $this->ERR_CODE = $ERR_CODE;
        $this->check_in_date = $check_in_date;
        $this->check_out_date = $check_out_date;
    }

    public function fetch_user()
    {
    }

    public function fetch_package()
    {
    }

    public static function create_empty()
    {
        return new Reservation(
            NULL,
            NULL,
            NULL,
            NULL,
            NULL,
            new DateTime(),
            new DateTime(),
            NULL
        );
    }

    public static function from_assoc(mixed $_obj)
    {
        return new Reservation(
            $_obj["reservation_id"],
            $_obj["package_id"],
            $_obj["user_id"],
            $_obj["reservation_status"],
            $_obj["payment_status"],
            $_obj["check_in_date"],
            $_obj["check_out_date"],
            NULL
        );
    }

    public function update_reservation(Reservation $r)
    {
        $this->reservation_id = $r->reservation_id ?? $this->reservation_id;
        $this->package_id = $r->package_id ?? $this->package_id;
        $this->user_id = $r->user_id ?? $this->user_id;
        $this->reservation_status = $r->reservation_status ?? $this->reservation_status;
        $this->payment_status = $r->payment_status ?? $this->payment_status;
        $this->check_in_date = $r->check_in_date ?? $this->check_in_date ?? new DateTime();
        $this->check_out_date = $r->check_out_date ?? $this->check_out_date ?? new DateTime();

        return [
            "reservation_id" => $this->reservation_id,
            "package_id" => $this->package_id,
            "user_id" => $this->user_id,
            "reservation_status" => $this->reservation_status,
            "payment_status" => $this->payment_status,
            "check_in_date" => $this->check_in_date,
            "check_out_date" => $this->check_out_date,
        ];
    }


    public static function raise_error(string $err)
    {
        return new Reservation(
            "",
            "",
            "",
            "",
            "",
            new DateTime(),
            new DateTime(),
            $err
        );
    }
}
