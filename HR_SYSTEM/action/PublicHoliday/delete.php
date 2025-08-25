<?php 

include('../../Config/conect.php');

if(isset($_GET['Code'])){
    $id = $_GET['Code'];
    $sql = "DELETE FROM public_holidays WHERE id = '$id'";
    $result = $con->query($sql);
    if($result){
        echo "Success";
    }else{
        echo "Can not delete" . $con->error;
    }
}
?>