<?php
include('../../Config/conect.php');
include('../../root/Header.php');



if (isset($_POST['btnSubmit'])) {
    $empcode = $_POST['empCode'];
    $empname = $_POST['empName'];
    $empGender = $_POST['gender'];
    $empdob = $_POST['dob'];
    $empsalary = $_POST['salary'];
    $img = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmp_name, "../../assets/images/$img");
    $company = $_POST['company'];
    $department = $_POST['department'];
    $division = $_POST['division'];
    $position = $_POST['position'];
    $level = $_POST['level'];
    $status = $_POST['status'];
    $startdate = $_POST['startDate'];
    $ispro = $_POST['isProb'];
    $probationDate = $_POST['probationDate'];
    $tel = $_POST['telegram'];
    $address= $_POST['address'];
    $number= $_POST['contact'];
    $email= $_POST['email'];




    $sql = "INSERT INTO `hrstaffprofile`
       (`EmpCode`, `EmpName`, `Gender`, `Dob`, `Salary`, `Photo`, `Company`, `Department`, `Division`, `Position`,
        `Level`, `StartDate`, `IsProb`,`ProbationDate`, `Telegram`, `Address`, `Contact`, `Email`, `Status`)
        VALUES 
        ( '$empcode', '$empname', '$empGender', '$empdob', '$empsalary', '$img',
        '$company', '$department', '$division', '$position', '$level', '$startdate', '$ispro','$probationDate', '$tel', '$address', '$number', '$email', '$status');";
    $result = $con->query($sql);
    if ($result) {
        echo "Success";
    } else {
        echo "Can not add" . $con->error;
    }
}
