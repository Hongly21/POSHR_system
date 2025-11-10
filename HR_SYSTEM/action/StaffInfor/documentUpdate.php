<?php
include('../../Config/conect.php');

$empcode = $_POST['empcodedoc'];
$doctype = $_POST['docType'];
$description = $_POST['description'];
$dcsforupdate = $_POST['dcsforupdate'];

$docfile = '';
if (isset($_FILES['docFile']) && $_FILES['docFile']['error'] == 0) {
    $docfile = $_FILES['docFile']['name'];
    $target_dir = "../../assets/documents/";
    $target_file = $target_dir . basename($docfile);

    if (move_uploaded_file($_FILES["docFile"]["tmp_name"], $target_file)) {
    } else {
        echo "error: failed to upload file";
        exit;
    }

    $sql = "UPDATE `hrstaffdocument` SET 
            `EmpCode` = '$empcode',
            `DocType` = '$doctype',
            `Description` = '$description',
            `Photo` = '$docfile' 
            WHERE `Description` = '$dcsforupdate'";
} else {
    $sql = "UPDATE `hrstaffdocument` SET 
            `EmpCode` = '$empcode',
            `DocType` = '$doctype',
            `Description` = '$description' 
            WHERE `Description` = '$dcsforupdate'";
}

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error: " . $con->error;
}
