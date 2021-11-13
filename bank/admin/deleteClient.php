<?php

include_once '../../database/dbConn.php';
session_start();







if (isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&& isset($_GET['id']))
{



  $sql3 = "SELECT acc_Number FROM account WHERE cli_ID = '".$_GET['id']."'";
  $result = mysqli_query($conn,$sql3);

  $row = mysqli_fetch_assoc($result);
  $acc = $row['acc_Number'];


      $sql1 = "DELETE FROM client WHERE cli_ID = '".$_GET['id']."'";
      mysqli_query($conn,$sql1);



      $sql2 = "DELETE FROM account WHERE cli_ID = '".$_GET['id']."'";
      mysqli_query($conn,$sql2);



        $sql = "DELETE FROM transaction WHERE acc_Number = '$acc';";
        mysqli_query($conn,$sql);




      
      echo "<script>location.replace('viewClient.php');</script>";
      exit();
}


?>
