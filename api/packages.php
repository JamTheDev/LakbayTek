<?php
include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

include("types/AuthTypes.php");
include("../types/AuthTypes.php");

include("types/ReservationType.php");
include("../types/ReservationType.php");
include("../types/PackageType.php");

include("../controller/PackagesController.php");
include("controller/PackagesController.php");
header("Content-Type: application/json");

echo json_encode(get_all_packages());