<?php
include('../../root/Header.php');
include('../../Config/conect.php');

if (isset($_GET['Code'])) {
    $code = $_GET['Code'];
    $sql = "DELETE FROM prpaypolicy WHERE id='$code'";
    $result = $con->query($sql);
}
