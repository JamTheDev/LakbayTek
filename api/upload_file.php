<?php

require("../utils/idgen.php");

if (isset($_POST["submit"])) {

    $folder = $_POST["folder"] ?? "";
    $folder = ltrim($folder, '/');

    $fileName = $_POST["fileName"] ?? genid(24) ;

    $targetDirectory = "uploads/" . $folder; // Directory where uploaded files will be stored
    $targetFile = $targetDirectory . basename($fileName);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    // Allow only specific file types (e.g., jpg, png, pdf)
    if ($fileType !== "jpg" && $fileType !== "png" && $fileType !== "pdf") {
        echo "Only JPG, PNG, and PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk === 0) {
        echo "File was not uploaded.";
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo $targetDirectory . "/" . $fileName;
        } else {
            echo "An error occurred during file upload.";
        }
    }
}
