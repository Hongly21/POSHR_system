<?php
   include('../../../Config/conect.php');


   if(isset($_POST['action'])){
    if($_POST['action'] == 'btnsave'){
        $DiCode=$_POST['DiCode'];
        $DiName=$_POST['DiName'];
        $DiStatus=$_POST['DiStatus'];

        $sql="INSERT INTO `hrdivision` (`Code`, `Description`, `Status`) VALUES ( '$DiCode', '$DiName', '$DiStatus');";
        $result = $con->query($sql);
        if($result){
            echo "Success";
   
        }else{
            echo "Can not add";
        }
    }
   }

