<?php
include('../../Config/conect.php');



if (isset($_GET['action'])) {
    if (isset($_GET['action']) == 'update') {
        $id = $_GET['id'];
        $code = $_GET['code'];
        $description = $_GET['Description'];
        $workday = $_GET['WorkDay'];
        $hourperday = $_GET['HourPerDay'];
        $fromdate = $_GET['FromDate'];
        $todate = $_GET['ToDate'];
        $mon = $_GET['Mon'];
        $tues = $_GET['Tues'];
        $wed = $_GET['Wed'];
        $thur = $_GET['Thur'];
        $fri = $_GET['Fri'];
        $sat = $_GET['Sat'];
        $sun = $_GET['Sun'];
        $monhours = $_GET['MonHours'];
        $tueshours = $_GET['TuesHours'];
        $wedhours = $_GET['WedHours'];
        $thurhours = $_GET['ThurHours'];
        $frihours = $_GET['FriHours'];
        $sathours = $_GET['SatHours'];
        $sunhours = $_GET['SunHours'];

        $sql = "UPDATE `prpaypolicy` SET
        `description` = '$description',
        `workday` = '$workday',
        `hourperday` = '$hourperday',
        `fromdate` = '$fromdate',
        `todate`= '$todate',
        `mon`= '$mon',
         `tues` = '$tues',
          `wed` = '$wed',
           `thur` = '$thur',
            `fri` = '$fri',
             `sat` = '$sat',
              `sun` = '$sun',
        `monhours` = '$monhours',
         `tueshours` = '$tueshours',
          `wedhours` = '$wedhours',
           `thurhours` = '$thurhours',
            `frihours` = '$frihours',
             `sathours` = '$sathours',
              `sunhours` = '$sunhours' WHERE `prpaypolicy`.`id` = $id;";


        $reult = $con->query($sql);

        if ($reult) {
            echo "success";
        } else {
            echo "fail";  $con->error;
        }

        // $sql = "UPDATE `prpaypolicy` SET 
        // `description` = 'Junion1',
        // `workday` = '5',
        // `hourperday` = '8',
        // `fromdate` = '2022-01-01',
        // `todate`= '2022-12-31',
        // `mon`= '1',
        //  `tues` = '1',
        //   `wed` = '1',
        //    `thur` = '1',
        //     `fri` = '1',
        //      `sat` = '1',
        //       `sun` = '1',
        //  `monhours` = '8',
        //   `tueshours` = '5',
        //    `wedhours` = '8',
        //     `thurhours` = '8',
        //      `frihours` = '5', 
        //      `sathours` = '4', 
        //      `sun` = '0' WHERE `prpaypolicy`.`code` = $code;";
    }
}
