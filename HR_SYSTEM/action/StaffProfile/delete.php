<?php 

include('../../Config/conect.php');


if(isset($_GET['Code'])){
    $code = $_GET['Code'];
    $sql = "DELETE FROM hrstaffprofile WHERE EmpCode='$code'";
    $sqlfamily = "DELETE FROM hrfamily WHERE EmpCode='$code'";
    $sqleducation = "DELETE FROM hreducation WHERE EmpCode='$code'";
    $sqldocument = "DELETE FROM hrstaffdocument WHERE EmpCode='$code'";

    $result = $con->query($sql);
    $resultfamily = $con->query($sqlfamily);
    $resulteeducation = $con->query($sqleducation);
    $resultdocument = $con->query($sqldocument);


}
?>