<?php 
    include("../../Config/conect.php");

    $id = $_GET['id'];

    $sql="UPDATE `lmleaverequest` SET `Status`= 'Rejected', `Approvedby` = 'Hongly' WHERE `ID` = '$id'";
    $run = $con->query($sql);
    if ($run) {
        echo "success";
    } else {
        echo "error" . $con->error; 
    }
?>