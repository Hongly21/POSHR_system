<?php
include("../../Config/conect.php");



$formDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$leaveDay = $_POST['leaveDay'];
$reason = $_POST['reason'];
$id = $_POST['id'];


$sql1="SELECT Status FROM lmleaverequest WHERE ID=$id";
$run1=$con->query($sql1);
$row1=$run1->fetch_assoc();
if($row1['Status']=="Pending"){

    $sql = "UPDATE lmleaverequest SET LeaveDay='$leaveDay', FromDate='$formDate', ToDate='$toDate', Reason='$reason' WHERE ID=$id";
    $run = $con->query($sql);
    if ($run) {
        echo "update success";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}else{
    echo "Error: Can not update data has been approved or rejected for HR";
}


