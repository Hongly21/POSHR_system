<?php 
include('../../Config/conect.php');
$code = $_GET['Code'];
$sql = "DELETE FROM `prallowance` WHERE `ID`='$code'";
$run = $con->query($sql);
if ($run) {
    echo "success";
    header("Location: ../../view/PRAllowance/index.php");
} else {
    echo "Can not delete" . $con->error;
}

  
?>