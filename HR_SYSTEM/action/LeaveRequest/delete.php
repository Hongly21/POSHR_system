<?php
include("../../Config/conect.php");

$id = $_GET['id'];

$sql = "DELETE FROM lmleaverequest WHERE ID=$id";
$run = $con->query($sql);
if ($run) {
    echo "delete success";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}