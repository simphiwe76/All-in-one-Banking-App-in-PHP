<?php


session_start();
unset($_SESSION['ID']) ;
unset($_SESSION['userLevel']);
unset($_SESSION['status']);
 unset($_SESSION['access']);
unset($_SESSION['bank']) ;
unset($_SESSION['acc']) ;
session_destroy();




echo '<script>alert("Client Successfully logout")</script>';
echo "<script>location.replace('../Login.html');</script>";
exit();



?>
