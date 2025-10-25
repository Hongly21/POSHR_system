<?php 
   include ('../../Config/conect.php');

   
   $id=$_POST['id'];
   $sql="UPDATE `prapprovesalary` SET `status`= 'Rejected', `Actionby` = 'Hongly' WHERE `ID` = '$id'";
   $result=$con->query($sql);
   if($result){
    echo "success";
    header("location:../../view/PRApproveSalary/index.php?rejectedsuccess=$id");
   }
   else{
    echo "failed" . $con->error; 
   }
 
?>