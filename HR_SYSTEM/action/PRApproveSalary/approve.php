<?php  
  include '../../Config/conect.php';

  $id=$_GET['id'];
  $inmonth=$_GET['InMonth'];
  
  $sql="UPDATE `prapprovesalary` SET `status`= 'Approved', `Actionby` = 'Hongly' WHERE `ID` = '$id'";
  $run = $con->query($sql);
  if ($run) {
    echo "success";
    header("location:../../view/PRApproveSalary/index.php?approvedsuccess=$id &inmonthapprove=$inmonth");
  } else {
    echo "error" . $con->error; 
  }

?>