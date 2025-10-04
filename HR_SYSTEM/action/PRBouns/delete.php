<?php
include('../../Config/conect.php');
$code = $_GET['Code'];
$sql = "DELETE FROM `prbonus` WHERE `ID`='$code'";
$run = $con->query($sql);
if ($run) {
    echo "success";
} else {
    echo "Can not delete" . $con->error;
}
