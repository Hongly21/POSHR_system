<?php

include("../../Config/conect.php");

$id = $_POST['id'];

$sql = "UPDATE lmleaverequest SET Status = 'Rejected' , Rejectedby = 'Hongly' WHERE ID = $id";
$result = $con->query($sql);

if ($result) {
    echo "success";
} else {
    echo "error" . $con->error;
}
