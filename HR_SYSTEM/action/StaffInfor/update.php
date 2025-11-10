<?php
include('../../Config/conect.php');
$nameforupdate = $_POST['nameforupdate'];
$relationname = $_POST['relationname'];
$relationtype = $_POST['relationtype'];
$relationgender = $_POST['relationgender'];
$istax = $_POST['istax'];
$sql = "UPDATE `hrfamily` SET `RelationName`='$relationname', `RelationType`='$relationtype', `Gender`='$relationgender', `IsTax`='$istax' WHERE `RelationName`='$nameforupdate';";
$run = $con->query($sql);
if ($run) {
    echo 'success';
} else {
    echo 'error' . $con->error;
}
