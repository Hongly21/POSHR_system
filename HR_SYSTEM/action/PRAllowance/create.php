<?php
include('../../Config/conect.php');



$empcode = $_POST['empcode'];
$allowancetype = $_POST['allowanceType'];
$amount = $_POST['amount'];
$remarks = $_POST['remark'];
$description = $_POST['description'];
$fromdate = $_POST['fromDate'];
$todate = $_POST['toDate'];
$status = $_POST['status'];


if ($empcode && $allowancetype && $amount && $fromdate && $todate && $description && $status) {
    $sql = "INSERT INTO `prallowance` (`EmpCode`, `AllowanceType`, `Description`, `FromDate`, `ToDate`, `Amount`, `Status`, `Remark`)
 VALUES ('$empcode', '$allowancetype', '$description', '$fromdate', '$todate', '$amount', '$status', '$remarks');";
    $run = $con->query($sql);
    if ($run) {
        echo "success";
    } else {
        echo "error";
    }
}else {
    echo "errorfield";
}
