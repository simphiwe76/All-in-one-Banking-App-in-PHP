<?php
include_once '../../database/dbConn.php';
session_start();





if (isset($_SESSION['ID']) && isset($_POST['save']) && $_SESSION['stutus'] == "yes")
{
  $emp_ID      = $_SESSION['ID'] ;
  $emp_Number  = $_SESSION['empNum'];
  $bank_ID     = $_SESSION['bankId'];
  $level       = $_SESSION['access'];
  $stu         = $_SESSION['stutus'] ;
  $braID      = $_SESSION['branchId'];
  $bankN       = $_SESSION['bankn'];

  $pwd = $_POST['pwd'];
  $pwdC = $_POST['pwdC'];

if (!empty($pwd))
{
      if (!empty($pwdC))
      {
            if ($pwdC == $pwd)
            {
                $newPass = password_hash($pwdC,PASSWORD_DEFAULT);
                  $sql = "UPDATE employee SET emp_Password = '$newPass' WHERE emp_Number = '$emp_Number';";
                  mysqli_query($conn,$sql);
                  echo '<script>alert("Employee password Successfully updated")</script>';
                  echo "<script>location.replace('index.php');</script>";
                  exit();
            }
            else
            {
              echo '<script>alert("Password does not match")</script>';
              echo "<script>location.replace('index.php');</script>";
              exit();
            }
      }
      else
      {
        echo '<script>alert("Password Confirm field  is empty")</script>';
        echo "<script>location.replace('index.php');</script>";
        exit();
      }
}
else
{
  echo '<script>alert("Password field  is empty")</script>';
  echo "<script>location.replace('index.php');</script>";
  exit();
}



}

?>
