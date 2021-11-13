<?php
include_once '../../database/dbConn.php';
session_start();





if (isset($_SESSION['ID']) && isset($_POST['save']) && $_SESSION['userLevel'] == "yes")
{
            $cli_id = $_SESSION['ID'];
            $email = $_POST['email'];
            $mobile = $_POST['cellNo'];
            $pwd = $_POST['pwd'];
            $pwdC = $_POST['pwdC'];

            $idNum = $_SESSION['idNum'];

            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {

                    if (preg_match("/^[0-9\d]+$/",$mobile) &&  strlen($mobile) == 10)
                    {
                              if (!empty($pwd) && !empty($pwdC))
                              {
                                      if ($pwdC == $pwd)
                                      {

                                        $newPwd = password_hash($pwdC,PASSWORD_DEFAULT);



                                        $sql = "SELECT* FROM client WHERE cli_ID = '$cli_id';";
                                        $results = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_assoc($results);


                                        if ($email == $row['cli_Email'] && $mobile == $row['cli_Phone'])
                                        {
                                          $sql = "UPDATE client SET cli_Phone = '$mobile',cli_Password = '$newPwd', cli_Email = '$email' WHERE cli_ID = '$cli_id'; ";
                                          mysqli_query($conn,$sql);
                                        }
                                        else if($email != $row['cli_Email'] && $mobile == $row['cli_Phone'])
                                        {
                                          $sql = "UPDATE client SET cli_Phone = '$mobile',cli_Password = '$newPwd', cli_Email = '$email' WHERE cli_ID = '$cli_id'; ";
                                          mysqli_query($conn,$sql);

                                          $sql = "UPDATE client SET  cli_Email = '$email' WHERE cli_IDNo = '$idNum'; ";
                                          mysqli_query($conn,$sql);


                                        }
                                        else if($email == $row['cli_Email'] && $mobile != $row['cli_Phone'])
                                        {
                                          $sql = "UPDATE client SET cli_Phone = '$mobile',cli_Password = '$newPwd', cli_Email = '$email' WHERE cli_ID = '$cli_id'; ";
                                          mysqli_query($conn,$sql);

                                          $sql = "UPDATE client SET  cli_Phone = '$mobile' WHERE cli_IDNo = '$idNum'; ";
                                          mysqli_query($conn,$sql);

                                        }
                                        elseif ($email != $row['cli_Email'] && $mobile != $row['cli_Phone'])
                                        {
                                          $sql = "UPDATE client SET cli_Phone = '$mobile',cli_Password = '$newPwd', cli_Email = '$email' WHERE cli_ID = '$cli_id'; ";

                                          mysqli_query($conn,$sql);

                                          $sql = "UPDATE client SET   cli_Email = '$email',cli_Phone = '$mobile' WHERE cli_IDNo = '$idNum'; ";
                                          mysqli_query($conn,$sql);

                                        }


                                        echo '<script>alert("Profile successful updated")</script>';
                                        echo "<script>location.replace('index.php');</script>";
                                        exit();


                                      }
                                      else
                                      {
                                        echo '<script>alert("Password doesnot match")</script>';
                                        echo "<script>location.replace('index.php');</script>";
                                        exit();
                                      }
                              }
                              else
                              {
                                        $sql = "UPDATE client SET cli_Phone = '$mobile', cli_Email = '$email' WHERE cli_IDNo = '$idNum'; ";
                                        mysqli_query($conn,$sql);
                                        echo '<script>alert("Profile successful updated")</script>';
                                        echo "<script>location.replace('index.php');</script>";
                                        exit();

                              }
                    }
                    else
                    {
                      echo '<script>alert("Cell number is not valid")</script>';
                      echo "<script>location.replace('index.php');</script>";
                      exit();
                    }
            }
            else
            {
              echo '<script>alert("Email is not valid")</script>';
              echo "<script>location.replace('index.php');</script>";
              exit();
            }



}








?>
