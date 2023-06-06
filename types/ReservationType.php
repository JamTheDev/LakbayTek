<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}
class Reservation
{
    public string $reservation_id;
    public string $package_id;
    public string $user_id;
    public ReservationStatus $reservation_status;
    public PaymentStatus $payment_status;
    public DateTime $date;

    public string $ERR_CODE;

    public function __construct(
        mixed $reservation_id = NULL,
        mixed $package_id  = NULL,
        mixed $user_id = NULL,
        mixed $reservation_status  = NULL,
        mixed $payment_status = NULL,
        DateTime $date,
        mixed $ERR_CODE
    ) {
        $this->reservation_id = $reservation_id;
        $this->package_id = $package_id;
        $this->user_id = $user_id;
        $this->reservation_status = ReservationStatus::from($reservation_status);
        $this->payment_status = PaymentStatus::from($payment_status);
        $this->date = $date;
        $this->ERR_CODE = $ERR_CODE;
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
            "",
            "",
            "",
            "",
            "",
            new DateTime(),
            ""
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
            $_obj["date"],
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
        $this->date = $r->date ?? $this->date ?? new DateTime();

        return [
            "reservation_id" => $this->reservation_id,
            "package_id" => $this->package_id,
            "user_id" => $this->user_id,
            "reservation_status" => $this->reservation_status,
            "payment_status" => $this->payment_status,
            "date" => $this->date,
        ];
    }


    public static function is_empty(Reservation $_x)
    {
        return $_x->user_id == "" || $_x->reservation_id == "" || $_x->package_id == "" ||
            $_x->reservation_status == "" || $_x->payment_status == "" || $_x->date == "";
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
            $err
        );
    }
}
