<?php   include('../../Config/conect.php');

$empcode = $_POST['empcode'];
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
    $sql = "INSERT INTO provertime (Empcode, OTType, OTDate, FromTime, ToTime, hour, Reason) 
            VALUES ('$empcode', '$ottype', '$otdate', '$fromtime', '$totime', '$hour', '$reason')";

    $run = $con->query($sql);
    if ($run) {
        echo "success";
        header("Location: ../../view/PROvertime/index.php");
    } else {
        echo "error" . $con->error;
    }
}