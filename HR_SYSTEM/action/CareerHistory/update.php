<?php
include('../../Config/conect.php');

$empid = $_GET['employeeID'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$increase = $_GET['increase'];
$careerCode = $_GET['careerCode'];
$remark = $_GET['remark'];

if (!empty($endDate) || $careerCode == 'RESIGN') {
    $sql1 = "UPDATE hrstaffprofile SET Status = 'Inactive' WHERE EmpCode = '$empid'";
    $con->query($sql1);
} elseif (in_array($careerCode, ['NEW', 'PROMOTE', 'INCREASE', 'TRANSFER'])) {
    $sql1 = "UPDATE hrstaffprofile SET Status = 'Active' WHERE EmpCode = '$empid'";
    $con->query($sql1);
}

$sql = "UPDATE careerhistory SET StartDate='$startDate', EndDate='$endDate', `Increase`='$increase', CareerHistoryType='$careerCode', Remark='$remark' WHERE EmployeeID='$empid'";
$run = $con->query($sql);

if ($run) {
    echo "success";
} else {
    echo "error " . $con->error;
}
