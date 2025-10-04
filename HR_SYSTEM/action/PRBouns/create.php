<?php   

include('../../Config/conect.php');

$empcode= $_POST['EmpCode'];
$bounustype = $_POST['BonusType'];
$amount = $_POST['Amount'];
$fromdate = $_POST['FromDate'];
$todate = $_POST['ToDate'];
$description = $_POST['Description'];
$status = $_POST['Status'];
$remark = $_POST['Remark'];


$sql = "INSERT INTO prbonus (EmpCode, BonusType, Amount, FromDate, ToDate, Description, Status, Remark)
    VALUES ('$empcode', '$bounustype', '$amount', '$fromdate', '$todate', '$description', '$status', '$remark')";

$run= $con->query($sql);

if($run){
    echo "success";
}else{
    echo "error" . $con->error;
}

?>