<?php
   include('../../../Config/conect.php');


   if(isset($_POST['action'])){
    if($_POST['action'] == 'btnsave'){
        $Dcode=$_POST['Dcode'];
        $Dname=$_POST['Dname'];
        $Dstatus=$_POST['Dstatus'];

        $sql="INSERT INTO `hrdepartment` (`Code`, `Description`, `Status`) VALUES ( '$Dcode', '$Dname', '$Dstatus');";
        $result = $con->query($sql);
        if($result){
            echo "Success";
   
        }else{
            echo "Can not add";
        }
    }
   }

