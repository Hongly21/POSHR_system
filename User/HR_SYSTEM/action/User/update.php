<?php

include("../../Config/conect.php");

$newpas = $_POST['newpwd'];
$username = $_POST['usernameforupdate'];

if (strlen($newpas) < 8) {
    echo "pwdnotshort";
} else {
    // check new pass exit or not 
    $sql = "SELECT Password FROM hrusers WHERE Password = '$newpas'";
    $run = $con->query($sql);
    if ($run->num_rows > 0) {
        echo 'cannotuse';
        exit;
    } else {
        $sql = "UPDATE hrusers SET Password = '$newpas' WHERE Username = '$username'";
        $run = $con->query($sql);
        if ($run) {
            echo 'success';
        } else {
            echo 'error' . $con->error;
        }
    }
}
