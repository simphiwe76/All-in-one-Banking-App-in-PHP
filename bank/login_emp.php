<?php

include_once '../database/dbConn.php';
session_start();


  if (isset($_POST['emp_Log']))
  {

        $email = $_POST['email'];
        $password = $_POST['pwd'];

       $email =   mysqli_real_escape_string($conn,$email);
       $password = mysqli_real_escape_string($conn,$password);


        if (!empty($email))
        {
              if (!preg_match("/^[a-zA-Z0-9@.\s]+$/",$email))
              {
                echo '<script>alert("Email  is incorrect")</script>';
                echo "<script>location.replace('index.html');</script>";
                exit();
              }
              else
              {
                          if (!empty($password))
                          {

                                  $sql = "SELECT* FROM employee WHERE emp_Number = '$email' OR emp_Email = '$email'; ";
                                  $result = mysqli_query($conn,$sql);
                                  $check = mysqli_num_rows($result);


                                  if ($check == 1)
                                  {
                                        $row = mysqli_fetch_assoc($result);
                                        $pwd = $row['emp_Password'];

                                        if (password_verify($password,$pwd))
                                        {

                                            $_SESSION['ID'] = $row['emp_ID'];
                                            $_SESSION['empNum'] = $row['emp_Number'];
                                            $_SESSION['bankId'] = $row['bank_ID'];
                                            $_SESSION['access'] = $row['level'];
                                            $_SESSION['stutus'] = "yes";

                                            $bID = $_SESSION['bankId'];

                                            $level = $_SESSION['access'];
                                            $sql = "SELECT* FROM bank WHERE bank_ID = '$bID'; ";
                                            $result = mysqli_query($conn,$sql);
                                            $row = mysqli_fetch_assoc($result);

                                            $bankN = $row['bank_Name'];

                                            $sql = "SELECT* FROM branch WHERE bank_ID = '$bID'; ";
                                            $result = mysqli_query($conn,$sql);
                                            $row = mysqli_fetch_assoc($result);

                                            $branch = $row['branch_ID'];

                                            $_SESSION['branchId'] = $branch ;
                                            $_SESSION['bankn'] = $bankN;



                                            if ($level == 1 && $bankN == "Fnb")
                                            {




                                              $_SESSION['message'] = "Successfully login as employee";
                                              $_SESSION['msg_type'] = "success";
                                              echo "<script>location.replace('employee/index.php');</script>";
                                              exit();
                                            }
                                            else if ($level == 1 && $bankN == "Capitec")
                                            {

                                              $_SESSION['message'] = "Successfully login as employee";
                                              $_SESSION['msg_type'] = "success";
                                              echo "<script>location.replace('employee/index.php');</script>";
                                              exit();
                                            }
                                            else if ($level == 3 && $bankN == "Fnb")
                                            {





                                              $_SESSION['message'] = "Successfully login as Admin employee";
                                              $_SESSION['msg_type'] = "success";
                                              echo "<script>location.replace('admin/index.php');</script>";
                                              exit();
                                            }
                                            else if ($level == 3 && $bankN == "Capitec")
                                            {

                                              $_SESSION['message'] = "Successfully login as Admin employee";
                                              $_SESSION['msg_type'] = "success";
                                              echo "<script>location.replace('admin/index.php');</script>";
                                              exit();
                                            }




                                        }
                                        else
                                        {
                                          echo '<script>alert("Incorrect password")</script>';
                                          echo "<script>location.replace('index.html');</script>";
                                          exit();
                                        }


                                  }
                                  else
                                  {
                                    echo '<script>alert("Employee or Admin credinials doesnot exist")</script>';
                                    echo "<script>location.replace('index.html');</script>";
                                    exit();
                                  }






                          }
                          else
                          {
                            echo '<script>alert("Password is empty")</script>';
                            echo "<script>location.replace('index.html');</script>";
                            exit();
                          }
              }
        }
        else
        {
          echo '<script>alert("Email field is empty")</script>';
          echo "<script>location.replace('index.html');</script>";
          exit();

        }







  }







?>
