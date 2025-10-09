<?php

include('../../Config/conect.php');


$id = $_POST['id'];
$empcode = $_POST['empCode'];
$deducttype = $_POST['deductType'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$status = $_POST['status'];
$remark = $_POST['remark'];
$formdate = $_POST['fromDate'];
$todate = $_POST['toDate'];

$sql = "UPDATE prdeduction SET EmpCode='$empcode',DeductType='$deducttype',Amount='$amount',Description='$description',Status='$status',Remark='$remark',FromDate='$formdate',ToDate='$todate' WHERE ID=$id";
$run = $con->query($sql);
if ($run) {
    echo "success";
} else {
    echo "error" . $con->error;
}
