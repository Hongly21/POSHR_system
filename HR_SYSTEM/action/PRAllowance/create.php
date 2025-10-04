<?php
include('../../Config/conect.php');



$empcode = $_POST['EmpCode'];
$allowancetype = $_POST['AllowanceType'];
$amount = $_POST['Amount'];
$remark = $_POST['Remark'];
$description = $_POST['Description'];
$fromdate = $_POST['FromDate'];
$todate = $_POST['ToDate'];
$status = $_POST['Status'];
$remarks = $_POST['Remark'];

// $sql = "INSERT INTO `prallowance` (`ID`, `EmpCode`, `AllowanceType`, `Description`, `FromDate`, `ToDate`, `Amount`, `Status`, `Remark`)
//  VALUES ('1', 'M1', 'RESS', 'DD', '2025-10-01', '2025-10-31', '200', 'Active', 'DES');";

$sql = "INSERT INTO `prallowance` (`EmpCode`, `AllowanceType`, `Description`, `FromDate`, `ToDate`, `Amount`, `Status`, `Remark`)
 VALUES ('$empcode', '$allowancetype', '$description', '$fromdate', '$todate', '$amount', '$status', '$remarks');";
$run = $con->query($sql);
if ($run) {
    echo "<script>
    alert('Data Inserted Successfully');
    window.location.href = '../../view/PRAllowance/index.php';
    </script>";
} else {
    echo "<script>
    alert('Data Not Inserted');
    window.location.href = '../../view/PRAllowance/create.php';
    </script>";
}
