<?php 
include '../../Config/conect.php';

if(isset($_POST)){
    if($_POST['action'] == 'updateLeaveType'){
        $code=$_POST['code'];
        $leavetype=$_POST['leavetype'];
        $isprobation=$_POST['isprobation'];
        $isdeduction=$_POST['isdeduction'];
        $isoverbalance=$_POST['isoverbalance'];
        $sql="UPDATE `lmleavetype` SET `LeaveType`='$leavetype',`IsProbation`='$isprobation',`IsDeduct`='$isdeduction',`IsOverBalance`='$isoverbalance' WHERE Code = '$code'";
        $result = $con->query($sql);
        if($result){
            echo "Success";
   
        }else{
            echo "Can not update" . $con->error;
        }
    }
}
?>