<?php

include_once '../../database/dbConn.php';
session_start();


    if (isset($_SESSION['ID']) && isset($_POST['payment']) && $_SESSION['userLevel'] == "yes" )
    {

              $acc_num = $_POST['acc_Num'];
              $tran_Type = $_POST['choose'];
              $tran_Amount = $_POST['amount'];
              $bankChoose = $_POST['chooseBn'];

              $sql = "SELECT* FROM account WHERE acc_Number = '$acc_num'";
              $results = mysqli_query($conn,$sql);
              $check = mysqli_num_rows($results);

              if (!empty($acc_num ))
              {
                    if (!preg_match("/^[0-9\d]+$/",$acc_num))
                    {
                      echo '<script>alert("Account Number must consist of 10 Numeric Digit")</script>';
                      echo "<script>location.replace('index.php');</script>";
                      exit();
                    }
                    else
                    {
                              if (!empty($tran_Type))
                              {
                                    if (!empty($tran_Amount) )
                                    {
                                            if (!preg_match("/^[0-9\d]+$/",$acc_num))
                                            {
                                              echo '<script>alert("Amount should be a Digit")</script>';
                                              echo "<script>location.replace('index.php');</script>";
                                              exit();
                                            }
                                            else
                                            {


                                              if ($tran_Amount>= 10)
                                              {
                                                if ($check == 1)
                                                {



                                                          if (!empty($bankChoose))
                                                          {
                                                            $id = $_SESSION['ID'];
                                                            $idNum = $_SESSION['idNum'];
                                                            $sql = "SELECT* FROM account A,client C,branch BR,bank B WHERE BR.bank_ID = B.bank_ID AND B.bank_Name = '$bankChoose'
                                                                    AND BR.branch_ID = A.branch_ID AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '$idNum'";
                                                            $results = mysqli_query($conn,$sql);
                                                            $check = mysqli_num_rows($results);
                                                            $row = mysqli_fetch_assoc($results);
                                                            $balance = $row['acc_Balance'];
                                                            $accNum = $row['acc_Number'];


                                                            if ($balance >= $tran_Amount)
                                                            {


                                                                        if ($accNum != $acc_num)
                                                                        {
                                                                              $bankName = $row['bank_Name'];


                                                                               $tran_Date = date('Y-m-d');

                                                                               $sql = "UPDATE account SET acc_Balance = acc_Balance + '$tran_Amount' WHERE acc_Number = '$acc_num';";
                                                                               mysqli_query($conn,$sql);
                                                                               $sql = "UPDATE account SET acc_Balance = acc_Balance - '$tran_Amount' WHERE acc_Number = '$accNum';";
                                                                               mysqli_query($conn,$sql);

                                                                               if (substr($acc_num,0,4) == "6262" && substr($accNum,0,4) == "6262")
                                                                               {
                                                                                 $trnsType = "EFT from Account No ".$accNum ." Fnb to ".$bankName." Account Number ".$acc_num;

                                                                                 $sql = "INSERT INTO transaction (trans_Type,trans_Amount,acc_Number,trans_Date)  VALUES('$trnsType','$tran_Amount','$accNum','$tran_Date');";
                                                                                 mysqli_query($conn,$sql);
                                                                                 echo '<script>alert("Payment successful made from Fnb to Fnb")</script>';
                                                                                 echo "<script>location.replace('index.php');</script>";
                                                                                 exit();
                                                                               }
                                                                               elseif (substr($acc_num,0,4) == "1818" && substr($accNum,0,4) == "1818")
                                                                               {
                                                                                 $trnsType = "EFT from Account No ".$accNum ." CAPITEC to ".$bankName." Account Number ".$acc_num;

                                                                                 $sql = "INSERT INTO transaction (trans_Type,trans_Amount,acc_Number,trans_Date)  VALUES('$trnsType','$tran_Amount','$accNum','$tran_Date');";
                                                                                 mysqli_query($conn,$sql);
                                                                                 echo '<script>alert("Payment successful made from Capitec to Capitec")</script>';
                                                                                 echo "<script>location.replace('index.php');</script>";
                                                                                 exit();
                                                                               }

                                                                               if (substr($acc_num,0,4) == "1818" && substr($accNum,0,4) == "6262")
                                                                               {
                                                                                 $trnsType = "EFT from Account No ".$accNum ." Fnb to "."Capitec"." Account Number ".$acc_num;

                                                                                 $sql = "INSERT INTO transaction (trans_Type,trans_Amount,acc_Number,trans_Date)  VALUES('$trnsType','$tran_Amount','$accNum','$tran_Date');";
                                                                                 mysqli_query($conn,$sql);
                                                                                 echo '<script>alert("Payment successful made from Fnb to Capitec")</script>';
                                                                                 echo "<script>location.replace('index.php');</script>";
                                                                                 exit();
                                                                               }
                                                                               elseif (substr($acc_num,0,4) == "6262" && substr($accNum,0,4) == "1818")
                                                                               {
                                                                                 $trnsType = "EFT from Account No ".$accNum ." CAPITEC to "."FNB"." Account Number ".$acc_num;

                                                                                 $sql = "INSERT INTO transaction (trans_Type,trans_Amount,acc_Number,trans_Date)  VALUES('$trnsType','$tran_Amount','$accNum','$tran_Date');";
                                                                                 mysqli_query($conn,$sql);

                                                                                 echo '<script>alert("Payment successful made from Capitec to Fnb")</script>';
                                                                                 echo "<script>location.replace('index.php');</script>";
                                                                                 exit();
                                                                               }


                                                                        }
                                                                        else
                                                                        {
                                                                          echo '<script>alert("Transaction cannot be done with same Account numbers")</script>';
                                                                          echo "<script>location.replace('index.php');</script>";
                                                                          exit();
                                                                        }




                                                            }
                                                            else
                                                            {
                                                              echo '<script>alert("Insuffient funds on account")</script>';
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
                                                else
                                                {
                                                        echo '<script>alert("Account Doesnot exist")</script>';
                                                        echo "<script>location.replace('index.php');</script>";
                                                        exit();
                                                }
                                              }
                                              else
                                              {
                                                echo '<script>alert("Minimum transiction amount is R10")</script>';
                                                echo "<script>location.replace('index.php');</script>";
                                                exit();
                                              }


                                            }
                                    }
                                    else
                                    {
                                      echo '<script>alert("Transaction amount field is empty")</script>';
                                      echo "<script>location.replace('index.php');</script>";
                                      exit();
                                    }


                              }
                              else
                              {
                                echo '<script>alert("Account Type field is empty")</script>';
                                echo "<script>location.replace('index.php');</script>";
                                exit();
                              }
                    }
              }
              else
              {
                echo '<script>alert("Account Number is empty")</script>';
                echo "<script>location.replace('index.php');</script>";
                exit();
              }



    }




?>
