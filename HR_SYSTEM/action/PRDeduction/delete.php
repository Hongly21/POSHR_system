<?php   
   include ('../../Config/conect.php');


   $id=$_GET['Code'];
   $sql = "DELETE FROM prdeduction WHERE ID = '$id'";
   $run = $con->query($sql);
   if ($run) {
      echo "success";
   } else {
      echo "Can not delete" . $con->error;
   }
?>