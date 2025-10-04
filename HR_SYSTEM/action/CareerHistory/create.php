<?php include('../../Config/conect.php');

if(isset($_POST['action'])&& $_POST['action'] == 'create'){
    $empCode = $_POST['empID'];
    $company= $_POST['company'];
    $position= $_POST['position'];
    $startDate= $_POST['startDate'];
    $endDate= $_POST['endDate'];
    $increase= $_POST['increase'];
    $careerCode= $_POST['careerCode'];
    $remark= $_POST['remark'];
    $department= $_POST['department'];
    $division= $_POST['division'];
    $level= $_POST['level'];


    $sql = "INSERT INTO `careerhistory` (`ID`, `CareerHistoryType`, `EmployeeID`, `Company`, `Division`, `PositionTitle`, `Department`, `StartDate`, `EndDate`, `Remark`, `Increase`) 
    VALUES 
    (NULL, '$careerCode', '$empCode', '$company', '$division', '$position', '$department', '$startDate', '$endDate', '$remark', '$increase');";

    $run = $con->query($sql);
    if($run){
        echo 'success';

    } else {
        echo 'error';
    }

}

?>