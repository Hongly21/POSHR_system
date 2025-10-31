<?php 
   include ('../../Config/conect.php');

   
   $id=$_GET['id'];
   $inmonth=$_GET['InMonth'];

   $sql="UPDATE `prapprovesalary` SET `status`= 'Rejected', `Actionby` = 'Hongly' WHERE `ID` = '$id'";
   $result=$con->query($sql);
   if($result){
    echo "success";
    header("location:../../view/PRApproveSalary/index.php?rejectedsuccess=$id & monthrejected=$inmonth");
   }
   else{
    echo "failed" . $con->error; 
   }
 
?>