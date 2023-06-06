<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}
class Package
{
    public string $package_id, $package_name, $description, $location;
    public int $min_capacity, $max_capacity, $price_weekend, $price_weekday;
    public mixed $ERR_CODE;

    public function __construct(
        string $package_id = "",
        string $package_name = "",
        string $description = "",
        int $min_capacity = 0,
        int $max_capacity = 0,
        int $price_weekend = 0,
        int $price_weekday = 0,
        mixed $ERR_CODE = NULL
    ) {

        $this->package_id = $package_id;
        $this->package_name = $package_name;
        $this->description = $description;
        $this->min_capacity = $min_capacity;
        $this->max_capacity = $max_capacity;
        $this->price_weekend = $price_weekend;
        $this->price_weekday = $price_weekday;

        $this->ERR_CODE = $ERR_CODE;
    }

    public function toArray(): array
    {
        return [
            "package_id" => $this->package_id,
            "package_name" => $this->package_name,
            "description" => $this->description,
            "min_capacity" => $this->min_capacity,
            "max_capacity" => $this->max_capacity,
            "price_weekend" => $this->price_weekend,
            "price_weekday" => $this->price_weekday
        ];
    }

    public static function from_assoc(mixed $_obj): Package
    {
        return new Package(
            $_obj["package_id"],
            $_obj["package_name"],
            $_obj["description"],
            $_obj["min_capacity"],
            $_obj["max_capacity"],
            $_obj["price_weekend"],
            $_obj["price_weekday"],
        );
    }

    public static function raise_error(string $err): Package
    {
        return new Package(
            ERR_CODE: $err
        );
    }
}
