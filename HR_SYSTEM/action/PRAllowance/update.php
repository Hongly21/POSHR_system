<?php
include('../../Config/conect.php');

$empcode = $_POST['EmpCode'];
$allowancetype = $_POST['AllowanceType'];
$amount = $_POST['Amount'];
$remark = $_POST['Remark'];
$description = $_POST['Description'];
$fromdate = $_POST['FromDate'];
$todate = $_POST['ToDate'];
$status = $_POST['Status'];
$id = $_POST['id'];



// $sql = "INSERT INTO `prallowance` (`EmpCode`, `AllowanceType`, `Description`, `FromDate`, `ToDate`, `Amount`, `Status`, `Remark`)
//  VALUES ('$empcode', '$allowancetype', '$description', '$fromdate', '$todate', '$amount', '$status', '$remarks');";

$sql = "UPDATE `prallowance` SET `EmpCode`='$empcode',`AllowanceType`='$allowancetype',`Description`='$description',`FromDate`='$fromdate',`ToDate`='$todate',`Amount`='$amount',`Status`='$status',`Remark`='$remark' WHERE `ID`='$id'";
$run = $con->query($sql);
if ($run) {
    echo "<script>
    alert('Data Updated Successfully');
    window.location.href = '../../view/PRAllowance/index.php';
    </script>";
} else {
    echo "<script>
    alert('Data Not Updated');
    window.location.href = '../../view/PRAllowance/edit.php?id=$id';
    </script>" . $con->error;
}