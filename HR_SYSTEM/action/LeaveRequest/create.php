<?php
include("../../Config/conect.php");

$empid = $_POST['empcode'];
$leavetype = $_POST['leaveType'];
$fromdate = $_POST['fromDate'];
$todate = $_POST['toDate'];
$reason = $_POST['reason'];

$diff = strtotime($todate) - strtotime($fromdate);
$leaveday = ($diff / (60 * 60 * 24)) + 1; // Include both start & end days

if ($empid && $leavetype && $fromdate && $todate && $reason && $leaveday) {

    $sql = "INSERT INTO lmleaverequest (EmpCode, LeaveType, FromDate, ToDate, LeaveDay, Reason, Status) 
        VALUES ('$empid', '$leavetype', '$fromdate', '$todate', '$leaveday', '$reason', 'Pending')";

    $run = $con->query($sql);
    if ($run) {
        echo "success";
    } else {
        echo "error" . $con->error;
    }
} else {
    echo "All fields are required";
}

