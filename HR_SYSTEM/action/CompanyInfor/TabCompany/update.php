<?php

include('../../../Config/conect.php');



if(isset($_GET['action'])){
    if($_GET['action'] == 'btnupdate'){
        $comCode = $_GET['ComCode'];
        $comName = $_GET['ComName'];
        $comStatus = $_GET['ComStatus'];

        $sql="UPDATE `hrcompany` SET `Description`='$comName',`Status`='$comStatus' WHERE Code = '$comCode'"; 

        $result = $con->query($sql);
        if($result){
            echo "Success Update";
        }else{
            echo "Can not update";
        }
    }
   
}
