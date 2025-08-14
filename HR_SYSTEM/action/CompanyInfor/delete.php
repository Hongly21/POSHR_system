<?php

include('../../Config/conect.php');
include ('../../root/Header.php');




if (isset($_GET['Code'])) {
    $Code = $_GET['Code'];


    $sql = "DELETE FROM hrcompany WHERE Code = '$Code'";
    $result = $con->query($sql);
    if ($result) {
        echo "Success";
    }
    } else {
        echo "Fail";
    }
    ?>
