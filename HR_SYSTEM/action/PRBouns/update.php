<?php   
  include('../../Config/conect.php');


  $ID = $_POST['ID'];
  $empcode = $_POST['EmpCode'];
  $bonustype = $_POST['BonusType'];
  $description = $_POST['Description'];
  $fromdate = $_POST['FromDate'];
  $todate = $_POST['ToDate'];
  $amount = $_POST['Amount'];
  $status = $_POST['Status'];
  $remark = $_POST['Remark'];

$sql="UPDATE prbonus SET BonusType='$bonustype',Description='$description',FromDate='$fromdate',ToDate='$todate',Amount='$amount',Status='$status',Remark='$remark' WHERE ID=$ID";
$run = $con->query($sql);

if ($run){
    echo "success";
}else{
    echo "error" . $con->error;
}
?>