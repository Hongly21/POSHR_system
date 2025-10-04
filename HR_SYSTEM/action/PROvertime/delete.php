<?php
include('../../Config/conect.php');


$empcode = $_GET['id'];

$sql = "DELETE FROM provertime WHERE ID = '$empcode'";
$run = $con->query($sql);
if ($run) {
    echo "success";
    header("Location: ../../view/PROvertime/index.php");
} else {
    echo "Can not delete" . $con->error;
}
