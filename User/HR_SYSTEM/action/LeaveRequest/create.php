<?php
include("../../Config/conect.php");


$empid=$_POST['empCode'];
$leavetype=$_POST['leaveType'];
$fromdate=$_POST['fromDate'];
$todate=$_POST['toDate'];
$reason=$_POST['reason'];
$leaveday=date('d', strtotime($todate) - strtotime($fromdate));


$sql = "INSERT INTO lmleaverequest (EmpCode, LeaveType, FromDate, ToDate, LeaveDay, Reason, Status) 
    VALUES ('$empid', '$leavetype', '$fromdate', '$todate', '$leaveday', '$reason', 'Pending')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../../view/LeaveRequest/index.php");
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

