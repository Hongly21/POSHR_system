<?php
include('../../Config/conect.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $holidayname = $_GET['holidayName'];
    $holidaydate = $_GET['holidayDate'];
    $description = $_GET['description'];

    $sql = "UPDATE public_holidays SET holiday_name = '$holidayname', holiday_date = '$holidaydate', description = '$description' WHERE id = '$id'";
    $result = $con->query($sql);
    if ($result) {
        echo "Success";
    } else {
        echo "Can not update" . $con->error;
    }
}
