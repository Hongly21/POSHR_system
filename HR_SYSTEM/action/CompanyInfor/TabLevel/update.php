<?php

include('../../../Config/conect.php');



if(isset($_GET['action'])){
    if($_GET['action'] == 'btnupdate2'){
        $DiCode = $_GET['DiCode'];
        $DiName = $_GET['DiName'];
        $DiStatus = $_GET['DiStatus'];

        $sql="UPDATE `hrlevel` SET `Description`='$DiName',`Status`='$DiStatus' WHERE `Code`='$DiCode'";
        $result = $con->query($sql);
        if($result){
            echo "Success Update";
        }else{
            echo "Can not update";
        }
    }
   
}
