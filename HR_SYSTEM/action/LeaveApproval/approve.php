<?php
include("../../Config/conect.php");

$id = $_POST['id'];

$sql = "UPDATE `lmleaverequest` SET `Status`= 'Approved', `Approvedby` = 'Hongly' WHERE `ID` = '$id'";
$run = $con->query($sql);
if ($run) {
   echo "success";
} else {
   echo "error" . $con->error;
}
