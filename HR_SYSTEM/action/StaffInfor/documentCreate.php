<?php
include('../../Config/conect.php');

// INSERT INTO `hrstaffdocument` (`EmpCode`, `DocType`, `Description`, `Photo`) VALUES ('M1', 'DD', 'DD', 'sdd');
$empcode = $_POST['empcodedoc'];
$doctype = $_POST['docType'];
$description = $_POST['description'];

$docfile = $_FILES['docFile']['name'];
$target_dir = "../../assets/documents/";
$target_file = $target_dir . basename($docfile);
move_uploaded_file($_FILES["docFile"]["tmp_name"], $target_file);


$sql = "INSERT INTO `hrstaffdocument` (`EmpCode`, `DocType`, `Description`, `Photo`) VALUES ('$empcode', '$doctype', '$description', '$docfile')";
if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error: " . $sql . "<br>" . $con->error;
}
