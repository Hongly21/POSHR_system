<?php
   include('../../../Config/conect.php');


   if(isset($_POST['action'])){
    if($_POST['action'] == 'btnsave'){
        $comCode = $_POST['comCode'];
        $comName = $_POST['comName'];
        $comStatus = $_POST['comStatus'];


        $sql="INSERT INTO `hrdepartment` (`Code`, `Description`, `Status`) VALUES ( '$comCode', '$comName', '$comStatus');";
        $result = $con->query($sql);
        if($result){
            echo "Success";
   
        }else{
            echo "Can not add";
        }
    }
   }

