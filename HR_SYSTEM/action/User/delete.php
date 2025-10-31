<?php
include('../../Config/conect.php');
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM hrusers WHERE UserID = '$id'";
    $run = $con->query($sql);
    if ($run) {
        echo "success";
    } else {
        echo "failed";
    }
}
