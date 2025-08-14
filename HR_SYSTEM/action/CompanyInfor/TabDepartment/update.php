<?php

include('../../../Config/conect.php');



if(isset($_GET['action'])){
    if($_GET['action'] == 'btnupdate1'){
        $DCode = $_GET['Dcode'];
        $DName = $_GET['Dname'];
        $DStatus = $_GET['Dstatus'];

        $sql="UPDATE `hrdepartment` SET `Description`='$DName',`Status`='$DStatus' WHERE Code = '$DCode'";

        $result = $con->query($sql);
        if($result){
            echo "Success Update";
        }else{
            echo "Can not update";
        }
    }
   
}
