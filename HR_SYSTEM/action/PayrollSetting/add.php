<?php
include('../../Config/conect.php');

if (isset($_POST['action']) && $_POST['action'] == 'btnsave') {
    $code = $_POST['code'];
    $description = $_POST['description'];
    $workday = $_POST['workday'];
    $hourperday = $_POST['hourperday'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $hourperweek = $workday * $hourperday;

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

    // Get day values (0 if unchecked, 1 if checked)
    // $mon  = isset($_POST['mon'])  ? 1 : 0;
    // $tues = isset($_POST['tues']) ? 1 : 0;
    // $wed  = isset($_POST['wed'])  ? 1 : 0;
    // $thur = isset($_POST['thur']) ? 1 : 0;
    // $fri  = isset($_POST['fri'])  ? 1 : 0;
    // $sat  = isset($_POST['sat'])  ? 1 : 0;
    // $sun  = isset($_POST['sun'])  ? 1 : 0;

    // // Get hours for each day
    // $monHours  = $mon  ? floatval($_POST['monHours'])  : 0;
    // $tuesHours = $tues ? floatval($_POST['tuesHours']) : 0;
    // $wedHours  = $wed  ? floatval($_POST['wedHours'])  : 0;
    // $thurHours = $thur ? floatval($_POST['thurHours']) : 0;
    // $friHours  = $fri  ? floatval($_POST['friHours'])  : 0;
    // $satHours  = $sat  ? floatval($_POST['satHours'])  : 0;
    // $sunHours  = $sun  ? floatval($_POST['sunHours'])  : 0;

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
