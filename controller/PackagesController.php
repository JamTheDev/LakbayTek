<?php


include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

include("types/AuthTypes.php");
include("../types/AuthTypes.php");

include("types/PackageType.php");
include("../types/PackageType.php");


function get_all_packages(): array
{
    global $conn;
    $pkg_arr = array();
    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("SELECT * FROM Packages");
        $stmt->execute();

        $packages = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->free_result();
        $conn->commit();

        foreach ($packages as $package) {
            $pkg_arr[] = Package::from_assoc($package);
        }

        return $pkg_arr;
    } catch (Exception $e) {
        $conn->rollback();
        error_log($e->getMessage());
        return [Package::raise_error("Error: {$e->getMessage()}")];
    }
}
