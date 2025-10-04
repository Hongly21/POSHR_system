<?php   
  include ('../../Config/conect.php');


  if(isset($_POST['action']) && $_POST['action'] == 'add') {
      $code = $_POST['code'];
      $description = $_POST['description'];
      $rate = $_POST['rate'];
        $sql = "INSERT INTO protrate  (Code, Des, Rate) VALUES ('$code', '$description', '$rate')";
        $run=$con->query($sql);
        if($run){
            echo "success";
        }else{
            echo "error";
        }
  }


  if(isset($_GET['action']) && $_GET['action'] == 'delete') {
      $code = $_GET['code'];
      $sql = "DELETE FROM protrate WHERE Code = '$code'";
      $run = $con->query($sql);
      if($run){
          echo "success";
      }else{
          echo "error";
      }
  }


  if(isset($_POST['action']) && $_POST['action'] == 'update') {
      $code = $_POST['code'];
      $des = $_POST['des'];
      $rate = $_POST['rate'];
        $sql = "UPDATE protrate SET Des = '$des', Rate = '$rate' WHERE Code = '$code'";
        $run=$con->query($sql);
        if($run){
            echo "success";
        }else{
            echo "error";
        }
  }

?>