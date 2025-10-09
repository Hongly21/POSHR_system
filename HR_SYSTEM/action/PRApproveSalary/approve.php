<?php  
  include '../../Config/conect.php';

  $id=$_GET['id'];
  
  $sql="UPDATE `prapprovesalary` SET `status`= 'Approved', `Actionby` = 'Hongly' WHERE `ID` = '$id'";
  $run = $con->query($sql);
  if ($run) {
    echo "success";
    // header("Location: ../../view/PRApproveSalary/index.php");
  } else {
    echo "error" . $con->error; 
  }

?>