<?php
include('../../Config/conect.php');

$id = $_POST['id'];

$sql = "DELETE FROM `hrfamily` WHERE `RelationName` = '$id';";
$run = $con->query($sql);
if ($run) {
    echo 'success';
} else {
    echo 'error' . $con->error;
}
