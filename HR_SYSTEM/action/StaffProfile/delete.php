<?php 

include('../../Config/conect.php');


if(isset($_GET['Code'])){
    $code = $_GET['Code'];
    $sql = "DELETE FROM hrstaffprofile WHERE EmpCode='$code'";
    $result = $con->query($sql);

}
?>