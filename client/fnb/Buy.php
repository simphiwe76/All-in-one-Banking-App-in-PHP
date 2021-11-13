<?php

include_once '../../database/dbConn.php';
session_start();


    if (isset($_SESSION['ID']) && isset($_POST['Buy']) && $_SESSION['userLevel'] == "yes" )
    {

              $cellNo = $_POST['cellNo'];
              $tran_Type = $_POST['choose'];
              $tran_Amount = $_POST['amount'];
              $bankChoose = $_POST['chooseBn'];


              if (!empty($cellNo))
              {
                    if (!preg_match("/^[0-9\d]+$/",$cellNo)||$cellNo[0]!="0"||strlen($cellNo)<10)
                    {
                      echo '<script>alert("Cell phone Number must consist of 10 or more Numeric Digit(e.g 0724283941 or 0824283941052)")</script>';
                      echo "<script>location.replace('index.php');</script>";
                      exit();
                    }
                    else
                    {
                              if (!empty($tran_Type))
                              {
                                    if (!empty($tran_Amount) )
                                    {
                                            if (!preg_match("/^[0-9.\d]+$/",$tran_Amount))
                                            {
                                              echo '<script>alert("Amount should be a Digit")</script>';
                                              echo "<script>location.replace('index.php');</script>";
                                              exit();
                                            }
                                            else
                                            {

                                                  if (!empty($bankChoose))
                                                  {


                                                    if ($tran_Amount>= 5)
                                                    {

                                                            $id = $_SESSION['ID'];
                                                            $idNum = $_SESSION['idNum'];
                                                            $sql = "SELECT* FROM account A,client C,branch BR,bank B WHERE BR.bank_ID = B.bank_ID AND B.bank_Name = '$bankChoose'
                                                                    AND BR.branch_ID = A.branch_ID AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '$idNum'";
                                                            $results = mysqli_query($conn,$sql);
                                                            $check = mysqli_num_rows($results);
                                                            $row = mysqli_fetch_assoc($results);
                                                            $balance = $row['acc_Balance'];

                                                            


                                                    if ($tran_Amount>$balance )
                                                    {
                                                      echo '<script>alert("You have Insuffient fund on Account")</script>';
                                                      echo "<script>location.replace('index.php');</script>";
                                                      exit();
                                                    }
                                                    else
                                                    {


                                                            $tran_Date = date('Y-m-d');
                                                            $bankName = $_SESSION['bank'];
                                                            $logAcc = $row['acc_Number'];


                                                            if ($bankChoose == "Fnb")
                                                            {
                                                              $trnsType = "Airtime from Account No $logAcc "." Fnb to "." Cell Phone ".$cellNo." ".$tran_Type." R".$tran_Amount;

                                                              $sql = "UPDATE account SET acc_Balance = acc_Balance - '$tran_Amount' WHERE acc_Number = '$logAcc';";
                                                              mysqli_query($conn,$sql);
                                                              $sql = "INSERT INTO transaction (trans_Type,trans_Amount,acc_Number,trans_Date)  VALUES('$trnsType','$tran_Amount','$logAcc','$tran_Date');";
                                                              mysqli_query($conn,$sql);

                                                              echo '<script>alert("Transaction successful made from Fnb Account")</script>';
                                                              echo "<script>location.replace('index.php');</script>";
                                                              exit();
                                                            }
                                                            elseif ($bankChoose == "Capitec")
                                                            {
                                                              $trnsType = "Airtime from Account No $logAcc "." Capitec to "." Cell Phone ".$cellNo." ".$tran_Type." R".$tran_Amount;

                                                              $sql = "UPDATE account SET acc_Balance = acc_Balance - '$tran_Amount' WHERE acc_Number = '$logAcc';";
                                                              mysqli_query($conn,$sql);
                                                              $sql = "INSERT INTO transaction (trans_Type,trans_Amount,acc_Number,trans_Date)  VALUES('$trnsType','$tran_Amount','$logAcc','$tran_Date');";
                                                              mysqli_query($conn,$sql);

                                                              echo '<script>alert("Transaction successful made from Capitec Account")</script>';
                                                              echo "<script>location.replace('index.php');</script>";
                                                              exit();
                                                            }





                                                     }

                                      }
                                      else
                                      {
                                        echo '<script>alert("Minmum transiction amount is R5")</script>';
                                        echo "<script>location.replace('index.php');</script>";
                                        exit();
                                      }


                                                  }
                                                  else
                                                  {
                                                    echo '<script>alert("Bank Account is not selected")</script>';
                                                    echo "<script>location.replace('index.php');</script>";
                                                    exit();
                                                  }



                                              }


                                            }
                                    }
                                    else
                                    {
                                      echo '<script>alert("Network field is empty")</script>';
                                      echo "<script>location.replace('index.php');</script>";
                                      exit();
                                    }


                              }

                    }
              }
              else
              {
                echo '<script>alert("Cell Number is empty")</script>';
                echo "<script>location.replace('index.php');</script>";
                exit();
              }








?>
