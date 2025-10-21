<?php  
   include("../../Config/conect.php");

   $id = $_GET['id'];

   $sql="UPDATE `lmleaverequest` SET `status`= 'Approved', `Approvedby` = 'Hongly' WHERE `ID` = '$id'";
   $run = $con->query($sql);
   if ($run) {
      echo "success";
   } else {
      echo "error" . $con->error; 
   }
 

?>
