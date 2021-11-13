<?php


session_start();
session_destroy();
unset($_SESSION['ID']) ;
unset($_SESSION['empNum']);
unset($_SESSION['bankId']);
 unset($_SESSION['access']);
unset($_SESSION['stutus']) ;

echo '<script>alert("Employee Successfully logout as admin")</script>';
echo "<script>location.replace('../index.html');</script>";
exit();



?>
