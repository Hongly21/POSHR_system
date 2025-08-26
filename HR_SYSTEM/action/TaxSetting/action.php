<?php   
include('../../Config/conect.php');

// Delete TaxRate
if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        $id = $_GET['Code'];
        $sql = "DELETE FROM prtaxrate WHERE id = '$id'";
        $result = $con->query($sql);
        if($result){
            echo "Success";
        }
    }
}

// Add TaxRate
if(isset($_POST['action'])){
    if($_POST['action'] == 'add'){
        $afrom=$_POST['amountform'];
        $ato=$_POST['amountto'];
        $rate=$_POST['rate'];
        $status=$_POST['status'];
        $sql="INSERT INTO `prtaxrate` (`AmountFrom`, `AmountTo`, `rate`, `status`) VALUES ( '$afrom', '$ato', '$rate','$status');";
        $result = $con->query($sql);
        if($result){
            echo "Success";
        }else{
            echo "Can not add";
        }
    }
}   

//Update TaxRate
if(isset($_POST['action'])){
    if($_POST['action'] == 'update'){
        $id = $_POST['id'];
        $afrom=$_POST['amountfrom'];
        $ato=$_POST['amountto'];
        $rate=$_POST['rate'];
        $status=$_POST['status'];
        $sql="UPDATE `prtaxrate` SET `AmountFrom` = '$afrom', `AmountTo` = '$ato', `rate` = '$rate', `status` = '$status' WHERE `prtaxrate`.`id` = $id;";
        $result = $con->query($sql);
        if($result){
            echo "Success";
        }else{
            echo "Can not update";
        }
    }
}
