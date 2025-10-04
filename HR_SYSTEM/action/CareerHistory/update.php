<?php 
    include('../../Config/conect.php');

    $empid = $_GET['employeeID'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $increase = $_GET['increase'];
    $careerCode = $_GET['careerCode'];
    $remark = $_GET['remark'];

    $sql = "UPDATE `careerhistory` SET `StartDate`='$startDate', `EndDate`='$endDate', `Increase`='$increase', `CareerHistoryType`='$careerCode', `Remark`='$remark' WHERE `EmployeeID`='$empid'";
    $run = $con->query($sql);
    if($run){
        echo 'success';
        header("Location: ../../view/CareerHistory/index.php");
    } else {
        echo 'error';
    }

?>