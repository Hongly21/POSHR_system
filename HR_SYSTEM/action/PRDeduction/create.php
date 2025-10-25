<?php
include('../../Config/conect.php');



$empcode = $_POST['EmpCode'];
$deductiontype = $_POST['deductType'];
$amount = $_POST['Amount'];
$fromdate = $_POST['FromDate'];
$todate = $_POST['ToDate'];
$remark = $_POST['Remark'];
$description = $_POST['Description'];
$status = $_POST['Status'];

if ($empcode && $deductiontype && $amount && $fromdate && $todate && $status) {
    $sql = "INSERT INTO prdeduction (EmpCode, DeductType, Amount, FromDate, ToDate, Description, Status, Remark)
   VALUES ('$empcode', '$deductiontype', '$amount', '$fromdate', '$todate', '$description', '$status', '$remark')";
    $run = $con->query($sql);
    if ($run) {
        echo "success";
    } else {
        echo "error" . $con->error;
    }
}else {
    echo "errorfield";
}
