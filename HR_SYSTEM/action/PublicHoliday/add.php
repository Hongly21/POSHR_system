<?php
include('../../Config/conect.php');

if (isset($_POST['action']) && $_POST['action'] == 'btnsave') {

    $holidayName = $_POST['holidayName'];
    $description = $_POST['description'];
    $holidayDate = $_POST['holidayDate'];

    $sql = "INSERT INTO `public_holidays` (`id`, `holiday_name`, `holiday_date`, `description`, `created_at`, `updated_at`) VALUES (NULL, '$holidayName', '$holidayDate', '$description', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
    $result = $con->query($sql);
    if ($result) {
        echo "Success";
    } else {
        echo "Can not add" . $con->error;
    }
}
