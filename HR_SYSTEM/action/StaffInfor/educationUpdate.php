<?php
include('../../Config/conect.php');

$id = $_POST['id'];
$degree = $_POST['degree'];
$institute = $_POST['institution'];
$fieldofstudy = $_POST['fieldOfStudy'];
$startdate = $_POST['startDate'];
$enddate = $_POST['endDate'];

$sql = "UPDATE `hreducation` SET `Degree`='$degree', `Institution`='$institute', `FieldOfStudy`='$fieldofstudy', `StartDate`='$startdate', `EndDate`='$enddate' WHERE `Id`='$id';";
$run = $con->query($sql);
if ($run) {
    echo 'success';
} else {
    echo 'error' . $con->error;
}

?>