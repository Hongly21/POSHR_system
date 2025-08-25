<?php

  include ('../../Config/conect.php');




  if(isset($_POST['action'])){
    if($_POST['action']=='addLeaveType'){
        $code=$_POST['code'];
        $leavetype=$_POST['leavetype'];
        $isprobation=$_POST['isprobation'];
        $isdeduction=$_POST['isdeduction'];
        $isoverbalance=$_POST['isoverbalance'];
        $sql="INSERT INTO `lmleavetype` (`Code`, `LeaveType`, `IsProbation`, `IsDeduct`, `IsOverBalance`) 
        VALUES
         ( '$code', '$leavetype', '$isprobation', '$isdeduction', '$isoverbalance');";
        $result = $con->query($sql);
        if($result){
            echo "Success";
   
        }else{
            echo "Can not add" . $con->error;
        }
    }
  }
?>