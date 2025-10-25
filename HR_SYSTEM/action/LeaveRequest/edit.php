<?php
include("../../Config/conect.php");

if (isset($_POST['action']) && $_POST['action'] == 'btnupdate') {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $reason = $_POST['reason'];
    $id = $_POST['id'];

    // ✅ Correct variable names
    $diff = strtotime($toDate) - strtotime($fromDate);
    $leaveDay = ($diff / (60 * 60 * 24)) + 1;

    // ✅ Check status first
    $sql1 = "SELECT Status FROM lmleaverequest WHERE ID = $id";
    $run1 = $con->query($sql1);
    $row1 = $run1->fetch_assoc();

    if ($row1 && $row1['Status'] == "Pending") {
        $sql = "UPDATE lmleaverequest 
                SET LeaveDay='$leaveDay', FromDate='$fromDate', ToDate='$toDate', Reason='$reason' 
                WHERE ID=$id";
        $run = $con->query($sql);
        if ($run) {
            echo "success";
        } else {
            echo "error " . $con->error;
        }
    } else {
        echo "Already Approved or Rejected";
    }
} else {
    echo "Not received data";
}
