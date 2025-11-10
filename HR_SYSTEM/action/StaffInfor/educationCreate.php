<?php
include('../../Config/conect.php');

// INSERT INTO `hreducation` (`Id`, `EmpCode`, `Institution`, `Degree`, `FieldOfStudy`, `StartDate`, `EndDate`) VALUES (NULL, 'M1', 'DD', 'DD', 'DD', '2025-11-04', '2025-11-27');

$empcode = $_POST['empcode'];
$institution = $_POST['institution'];
$degree = $_POST['degree'];
$fieldofstudy = $_POST['fieldOfStudy'];
$startdate = $_POST['startDate'];
$enddate = $_POST['endDate'];

$sql = "INSERT INTO `hreducation` (`EmpCode`, `Institution`, `Degree`, `FieldOfStudy`, `StartDate`, `EndDate`) VALUES ('$empcode', '$institution', '$degree', '$fieldofstudy', '$startdate', '$enddate');";
$run = $con->query($sql);
if ($run) {
    echo 'success';
} else {
    echo 'error' . $con->error;
}
