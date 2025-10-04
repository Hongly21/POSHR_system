<?php include('../../Config/conect.php');

$empid = $_POST['empcode'];
$id = $_POST['id'];
$ottype = $_POST['ottype'];
$otdate = $_POST['otdate'];
$fromtime = $_POST['fromtime'];
$totime = $_POST['totime'];
$reason = $_POST['reason'];

if ($fromtime >= $totime) {
    echo "
    <script>alert('From Time must be less than To Time');</script>";
    //after alert it still stay on the same page
    echo "<script>window.history.back();</script>";
} elseif ($fromtime < $totime) {
    $hour = (strtotime($totime) - strtotime($fromtime)) / 3600;
    $sql = "UPDATE provertime SET OTType='$ottype', OTDate='$otdate', FromTime='$fromtime', ToTime='$totime', hour='$hour', Reason='$reason' WHERE ID='$id'";

    $run = $con->query($sql);
    if ($run) {
        echo "success";
    } else {
        echo "error" . $con->error;
    }
}
