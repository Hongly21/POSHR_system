<?php 
include('../../Config/conect.php');

  if(isset($_GET['Code'])){
    $code = $_GET['Code'];
    $sql = "DELETE FROM lmleavetype WHERE Code = '$code'";
    $result = $con->query($sql);
    if($result){
      echo "Success";
    }else{
      echo "Can not delete" . $con->error;
    }

  }
?>