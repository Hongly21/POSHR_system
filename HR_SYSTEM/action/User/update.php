<?php

include("../../Config/conect.php");

if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['role']) && isset($_POST['status'])) {
    $id = trim($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $status = trim($_POST['status']);


    //check password true or not 
    if ($password) {
        $sqlpwd = "SELECT * FROM hrusers WHERE UserID = '$id' AND Password = '$password'";
        $resultpwd = $con->query($sqlpwd);

        if ($resultpwd && $resultpwd->num_rows > 0) {

            $sql = "UPDATE hrusers SET Username = '$username', Email = '$email', Role = '$role', Status = '$status' WHERE UserID = '$id'";
            $run = $con->query($sql);

            if ($run) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "passwordnotmatch";
        }
    } else {
        echo "enterpassword";
    }
}
