<?php

include('../../Config/conect.php');

$empcode = $_POST['empcode'];
$bounustype = $_POST['bonustype'];
$amount = $_POST['amount'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$description = $_POST['description'];
$status = $_POST['status'];
$remark = $_POST['remark'];


if ($empcode && $bounustype && $amount && $fromdate && $todate && $status) {

    $sql = "INSERT INTO prbonus (EmpCode, BonusType, Amount, FromDate, ToDate, Description, Status, Remark)
    VALUES ('$empcode', '$bounustype', '$amount', '$fromdate', '$todate', '$description', '$status', '$remark')";

    $run = $con->query($sql);

    if ($run) {
        echo "success";
    } else {
        echo "error" . $con->error;
    }
}else {
    echo "errorfield";
}
