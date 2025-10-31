<?php
include('../../Config/conect.php');

if (isset($_POST['action']) && $_POST['action'] == 'btnsave') {
    $code = $_POST['code'];
    $description = $_POST['description'];
    $workday = $_POST['workday'];
    $hourperday = $_POST['hourperday'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];


    $mon = $_POST['mon'];
    $tues = $_POST['tues'];
    $wed = $_POST['wed'];
    $thur = $_POST['thur'];
    $fri = $_POST['fri'];
    $sat = $_POST['sat'];
    $sun = $_POST['sun'];

    $monHours = $_POST['monHours'];
    $tuesHours = $_POST['tuesHours'];
    $wedHours = $_POST['wedHours'];
    $thurHours = $_POST['thurHours'];
    $friHours = $_POST['friHours'];
    $satHours = $_POST['satHours'];
    $sunHours = $_POST['sunHours'];
    $hourperweek = $monHours + $tuesHours + $wedHours + $thurHours + $friHours + $satHours + $sunHours;


    // Build SQL query
    $sql = "INSERT INTO `prpaypolicy` (
        `id`, 
        `code`, 
        `description`,
        `workday`,
        `hourperday`,
        `hourperweek`, 
        `fromdate`, 
        `todate`, 
        `mon`,
        `monhours`,
        `tues`, 
        `tueshours`,
        `wed`,
        `wedhours`,
        `thur`, 
        `thurhours`,
        `fri`, 
        `frihours`,
        `sat`,
        `sathours`,
        `sun`, 
        `sunhours`
    ) VALUES (
        NULL,
        '$code',
        '$description',
        '$workday',
        '$hourperday',
        '$hourperweek',
        '$fromdate',
        '$todate',
        '$mon',
        '$monHours',
        '$tues',
        '$tuesHours',
        '$wed',
        '$wedHours',
        '$thur',
        '$thurHours',
        '$fri',
        '$friHours',
        '$sat',
        '$satHours',
        '$sun',
        '$sunHours'
    )";

    // Execute query
    $run = $con->query($sql);
    if ($run) {
        echo "Payroll policy added.";
    } else {
        echo "Fail: " . $con->error;
    }
}
