<?php include('../../Config/conect.php');

if (isset($_GET['Code'])) {
  $code = $_GET['Code'];

  $sql1 = "DELETE FROM hrstaffprofile WHERE EmpCode = '$code'";
  $run1 = $con->query($sql1);
  $sql = "DELETE FROM `careerhistory` WHERE `EmployeeID` = '$code'";
  $run = $con->query($sql);
  if ($run) {
    echo 'success';
  } else {
    echo 'error';
  }
}
