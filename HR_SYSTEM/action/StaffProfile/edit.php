<?php
include('../../Config/conect.php');

if (isset($_POST['empcode'])) {
   $empcode = $_POST['empcode'];
   $empname = $_POST['empname'];
   $gender = $_POST['gender'];
   $address = $_POST['address'];
   $dob = $_POST['dob'];
   $salary = $_POST['salary'];
   $company = $_POST['company'];
   $department = $_POST['department'];
   $position = $_POST['position'];
   $division = $_POST['division'];
   $level = $_POST['level'];
   $startDate = $_POST['startDate'];
   $isProb = $_POST['isProb'];
   $email = $_POST['email'];
   $contact = $_POST['contact'];
   $payParamter = $_POST['payParamter'];
   $status = $_POST['status'];
   $startdate = $_POST['startdate'];
   $telegram = $_POST['telegram'];
   $lineManager = $_POST['lineManager'];
   $hod = $_POST['hod'];
   $probationDate = $_POST['probationDate'];


   // $photoName = null;
   // if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
   //    $targetDir = "../../assets/images/";
   //    $photoName = basename($_FILES['photo']['name']);
   //    $targetFilePath = $targetDir . $photoName;
   //    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

   //    // $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
   //    // if (in_array(strtolower($fileType), $allowTypes)) {
   //    //    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
   //    //    } else {
   //    //       echo 'Error uploading file';
   //    //       exit;
   //    //    }
   //    // } else {
   //    //    echo 'Invalid file type';
   //    //    exit;
   //    // }
   // }

   $photoName = '';
   if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
      $photoName = $_FILES['photo']['name'];
      $tmp_name = $_FILES['photo']['tmp_name'];
      move_uploaded_file($tmp_name, "../../assets/images/$photoName");
   }


   if ($photoName) {
      $sql = "UPDATE hrstaffprofile SET 
            EmpName='$empname', 
            Gender='$gender',
            Dob='$dob', 
            Position='$position',
            Department='$department',
            Company='$company',
            Level='$level',
            Division='$division',
            StartDate='$startDate',
            IsProb='$isProb',
            Email='$email',
            Contact='$contact',
            Address='$address', 
            PayParameter='$payParamter', 
            Status='$status',
            Telegram='$telegram', 
            LineManager='$lineManager', 
            Hod='$hod', 
            ProbationDate='$probationDate',
            Salary='$salary',
            Photo='$photoName'
            WHERE EmpCode='$empcode'";
   } else {
      // no photo update
      $sql = "UPDATE hrstaffprofile SET 
            EmpName='$empname', 
            Gender='$gender',
            Dob='$dob', 
            Position='$position',
            Department='$department',
            Company='$company',
            Level='$level',
            Division='$division',
            StartDate='$startDate',
            IsProb='$isProb',
            Email='$email',
            Contact='$contact',
            Address='$address', 
            PayParameter='$payParamter', 
            Status='$status',
            Telegram='$telegram', 
            LineManager='$lineManager', 
            Hod='$hod', 
            ProbationDate='$probationDate',
            Salary='$salary'
            WHERE EmpCode='$empcode'";
   }

   $result = $con->query($sql);
   if ($result) {
      echo 'success';
   } else {
      echo 'Can not update: ' . $con->error;
   }
} else {
   echo 'error';
}
