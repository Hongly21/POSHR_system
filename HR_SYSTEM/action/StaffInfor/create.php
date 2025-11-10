<?php
include('../../Config/conect.php');

$empcode = $_POST['empcode'];
$relationname = $_POST['relationname'];
$relationtype = $_POST['relationtype'];
$relationgender = $_POST['relationgender'];
$istax = $_POST['istax'];


$sql = "INSERT INTO `hrfamily` (`EmpCode`, `RelationName`, `RelationType`, `Gender`, `IsTax`) VALUES ('$empcode', '$relationname', '$relationtype', '$relationgender', '$istax');";
$run = $con->query($sql);
if ($run) {
    echo 'success';
} else {
    echo 'error' . $con->error;
}
