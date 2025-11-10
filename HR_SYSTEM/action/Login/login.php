<?php
include('../../Config/conect.php');
if (isset($_POST['action']) && $_POST['action'] == 'adminSMS') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM hrusers WHERE Username = '$username' AND Password = '$password'";
    $result = $con->query($sql);
    if ($result && $result->num_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'userSMS') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM hrusers WHERE Username = '$username' OR Email = '$username' AND Password = '$password'";
    $result = $con->query($sql);
    if ($result && $result->num_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }
}
