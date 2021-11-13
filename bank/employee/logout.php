<?php


session_start();
unset($_SESSION['ID']) ;
unset($_SESSION['empNum']);
unset($_SESSION['bankId']);
 unset($_SESSION['access']);
unset($_SESSION['stutus']) ;
session_destroy();

echo '<script>alert("Employee Successfully logout")</script>';
echo "<script>location.replace('../index.html');</script>";
exit();



?>
