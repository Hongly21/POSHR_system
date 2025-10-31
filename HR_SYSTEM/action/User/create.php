<?php
include("../../Config/conect.php");

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role']) && isset($_POST['status'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $status = trim($_POST['status']);

    $sqlname = "SELECT * FROM hrusers WHERE Username = '$username'";
    $sqlemail = "SELECT * FROM hrusers WHERE Email = '$email'";
    $sqlpdw= "SELECT * FROM hrusers WHERE Password = '$password'";

    $resultname = $con->query($sqlname);
    $resultemail = $con->query($sqlemail);
    $resultpwd=$con->query($sqlpdw);


    if ($resultname && $resultname->num_rows > 0) {
        echo "nameexists";
    } else if ($resultemail && $resultemail->num_rows > 0) {
        echo "mailexists";
    } else if($resultpwd && $resultpwd->num_rows > 0){
        echo "cannotuse";

    } else {


        $sql = "INSERT INTO hrusers (Username, Email, Password, Role, Status)
                VALUES ('$username', '$email', '$password', '$role', '$status')";

        $run = $con->query($sql);

        if ($run) {
            echo "success";
        } else {
            echo "error: " . $con->error;
        }
    }
}
