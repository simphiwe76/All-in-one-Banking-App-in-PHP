<?php
include_once '../../database/dbConn.php';
session_start();

$emp_ID      = $_SESSION['ID'] ;
$emp_Number  = $_SESSION['empNum'];
$bank_ID     = $_SESSION['bankId'];
$level       = $_SESSION['access'];
$stu         = $_SESSION['stutus'] ;
$braID      = $_SESSION['branchId'];
$bankN       = $_SESSION['bankn'];


if (isset($_POST['addCli']) && $level == 1 &&  $stu == "yes")
{




  $name = ucwords($_POST['Name']);
  $surname = ucwords($_POST['Surname']);
  $address = ucwords($_POST['Address']);
  $cellNo = $_POST['Phone'];
  $email = $_POST['Email'];
  $province = ucwords($_POST['province']);
  $idNo = ucwords($_POST['idNo']);

$name =  ucwords(mysqli_real_escape_string($conn,$name));
$surname =  ucwords(mysqli_real_escape_string($conn,$surname ));
$address =  ucwords(mysqli_real_escape_string($conn,$address));
$cellNo = mysqli_real_escape_string($conn,$cellNo);
$email =  mysqli_real_escape_string($conn,$email);
$province =  ucwords(mysqli_real_escape_string($conn,$province));
$idNo =  mysqli_real_escape_string($conn,$idNo);


  if (!empty($name))
  {
          if (preg_match("/^[a-zA-Z\s]+$/",$name))
          {
                if (!empty($surname))
                {
                      if (preg_match("/^[a-zA-Z]+$/",$surname))
                      {
                            if (!empty($address))
                            {
                                  if (preg_match("/^[a-zA-Z,0-9\s]+$/",$address))
                                  {
                                          if (!empty($cellNo))
                                          {
                                                    if (preg_match("/^[0-9\d]+$/",$cellNo))
                                                    {
                                                          if (strlen($cellNo) >= 10 )
                                                          {
                                                                if (!empty($email))
                                                                {
                                                                      if (filter_var($email, FILTER_VALIDATE_EMAIL))
                                                                      {
                                                                            if (!empty($province))
                                                                            {
                                                                                    if (preg_match("/^[a-zA-Z0-9\s]+$/",$province))
                                                                                    {

                                                                                          if (!empty($idNo))
                                                                                          {
                                                                                            if (preg_match("/^[0-9\d]+$/",$idNo)&& strlen($idNo) == 13)
                                                                                            {

                                                                                            if (!empty($province)&&!empty($email)&&!empty($cellNo)&&!empty($address)&&!empty($surname)&&!empty($name)&&!empty($idNo))
                                                                                            {

                                                                                                          $sql = "SELECT a.branch_ID,a.acc_Number FROM account a ,client c where a.cli_ID = c.cli_ID AND cli_IDNo	 = '$idNo';";
                                                                                                          $result = mysqli_query($conn,$sql);
                                                                                                          $check = mysqli_num_rows($result);
                                                                                                          $row = mysqli_fetch_assoc($result);



                                                                                                          if ($bankN == "Fnb")
                                                                                                          {
                                                                                                            if ($check == 1 && $row['branch_ID'] != 1)
                                                                                                            {
                                                                                                                $found = true;
                                                                                                            }
                                                                                                            else if ($check == 0)
                                                                                                            {
                                                                                                                  $found = true;
                                                                                                            }
                                                                                                            else if ($check > 0)

                                                                                                            {
                                                                                                                  $found = false;
                                                                                                            }

                                                                                                                if ($found)
                                                                                                                {

                                                                                                                  $code = "6262";
                                                                                                                  $randNum = rand(205424,654154);
                                                                                                                  $code = $code.$randNum;


                                                                                                                  if (strlen($code) == 10)
                                                                                                                  {

                                                                                                                            $date = date('Y-m-d');
                                                                                                                            $accType = "Savings";
                                                                                                                            $balance = 50;

                                                                                                                            $clPwd = $randNum.$surname;

                                                                                                                            $newPwd = password_hash($clPwd,PASSWORD_DEFAULT);

                                                                                                                            if ($check == 0)
                                                                                                                            {
                                                                                                                              $sql = "INSERT INTO client(cli_Name, cli_Surname, cli_Address, cli_Phone, cli_Email, cli_Password, cli_Prov, level,cli_IDNo)
                                                                                                                                      VALUES('$name','$surname','$address','$cellNo','$email','$newPwd','$province','2','$idNo');";
                                                                                                                              mysqli_query($conn,$sql);
                                                                                                                            }
                                                                                                                            else if($check == 1)
                                                                                                                            {
                                                                                                                                    $sql = "SELECT* FROM Client WHERE cli_IDNo = '$idNo';";
                                                                                                                                    $result = mysqli_query($conn,$sql);

                                                                                                                                    $row = mysqli_fetch_assoc($result);

                                                                                                                                    $name = $row['cli_Name'];
                                                                                                                                    $surname = $row['cli_Surname'];
                                                                                                                                    $address = $row['cli_Address'];
                                                                                                                                    $cellNo = $row['cli_Phone'];
                                                                                                                                    $email = $row['cli_Email'];
                                                                                                                                    $province = $row['cli_Prov'];
                                                                                                                                    $idNo = $row['cli_IDNo'];

                                                                                                                                    $sql = "INSERT INTO client(cli_Name, cli_Surname, cli_Address, cli_Phone, cli_Email, cli_Password, cli_Prov, level,cli_IDNo)
                                                                                                                                            VALUES('$name','$surname','$address','$cellNo','$email','$newPwd','$province','2','$idNo');";
                                                                                                                                    mysqli_query($conn,$sql);

                                                                                                                            }




                                                                                                                            $id = mysqli_insert_id($conn);

                                                                                                                            $sql = "INSERT INTO account(acc_Number, acc_Type, acc_Date, acc_Balance, cli_ID, branch_ID)
                                                                                                                            VALUES('$code','$accType','$date','$balance','$id','1');";
                                                                                                                            mysqli_query($conn,$sql);


                                                                                                                            $uComm = "You have Successfully created an Account at ".$bankN."\r\r"."Date : ".$date."\r\r"."\r\r"." Your Account number : ".$code."\r\r"."\r\r"."Your Login datails are below "."\r\r"."\r\r"." Username : ".$email."\r\r"." Password : ".$clPwd."\r\r"."\r\r"." Thank you enjoy your banking app";
                                                                                                                            $fromEmail = 'simphiwemthanti76@gmail.com';
                                                                                                                            $toEmail =  $email;
                                                                                                                            $subjectName = $bankN.' Auto reply';
                                                                                                                            $message = $uComm;


                                                                                                                            $to = $toEmail;
                                                                                                                            $subject = $subjectName;
                                                                                                                            $headers = "MIME-Version: 1.0" . "\r\n";
                                                                                                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                                                                                                            $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
                                                                                                                            $message = '<!doctype html>
                                                                                                                            <html lang="en">
                                                                                                                            <head>
                                                                                                                            <meta charset="UTF-8">
                                                                                                                            <meta name="viewport"
                                                                                                                            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                                                                                                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                                                                                                            <title>Document</title>
                                                                                                                            </head>
                                                                                                                            <body>
                                                                                                                            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
                                                                                                                            <div class="container">
                                                                                                                           '.$message.'<br/>
                                                                                                                           Regards<br/>
                                                                                                                           '.$fromEmail.'
                                                                                                                           </div>
                                                                                                                           </body>
                                                                                                                           </html>';
                                                                                                                           $result = @mail($to, $subject, $message, $headers);

                                                                                                                          $_SESSION['message'] = "Client Successfully registerd On FNB";
                                                                                                                          $_SESSION['msg_type'] = "success";
                                                                                                                          echo "<script>location.replace('viewClients.php');</script>";
                                                                                                                          exit();




                                                                                                                  }




                                                                                                              }
                                                                                                              else if (!$found)
                                                                                                              {


                                                                                                                $_SESSION['message'] = "already have an account";
                                                                                                                $_SESSION['msg_type'] = "danger";
                                                                                                                echo "<script>location.replace('viewClients.php');</script>";
                                                                                                                exit();

                                                                                                              }


                                                                                                          }
                                                                                                          else if ($bankN == "Capitec")
                                                                                                          {
                                                                                                            if ($check == 1 && $row['branch_ID'] != 2)
                                                                                                            {
                                                                                                                $found = true;
                                                                                                            }
                                                                                                            else if ($check == 0)
                                                                                                            {
                                                                                                                  $found = true;
                                                                                                            }
                                                                                                            else if ($check > 0)

                                                                                                            {
                                                                                                                  $found = false;
                                                                                                            }


                                                                                                            if ($found)
                                                                                                            {

                                                                                                                          $code = "1818";
                                                                                                                          $randNum = rand(205424,654154);
                                                                                                                          $code = $code.$randNum;


                                                                                                                          if (strlen($code) == 10)
                                                                                                                          {

                                                                                                                            $date = date('Y-m-d');
                                                                                                                            $accType = "Savings";
                                                                                                                            $balance = 50;

                                                                                                                            $clPwd = $randNum.$surname;

                                                                                                                            $newPwd = password_hash($clPwd,PASSWORD_DEFAULT);



                                                                                                                            if ($check == 0)
                                                                                                                            {
                                                                                                                              $sql = "INSERT INTO client(cli_Name, cli_Surname, cli_Address, cli_Phone, cli_Email, cli_Password, cli_Prov, level,cli_IDNo)
                                                                                                                                      VALUES('$name','$surname','$address','$cellNo','$email','$newPwd','$province','2','$idNo');";
                                                                                                                              mysqli_query($conn,$sql);
                                                                                                                            }
                                                                                                                            else if($check == 1)
                                                                                                                            {
                                                                                                                                    $sql = "SELECT* FROM Client WHERE cli_IDNo = '$idNo';";
                                                                                                                                    $result = mysqli_query($conn,$sql);

                                                                                                                                    $row = mysqli_fetch_assoc($result);

                                                                                                                                    $name = $row['cli_Name'];
                                                                                                                                    $surname = $row['cli_Surname'];
                                                                                                                                    $address = $row['cli_Address'];
                                                                                                                                    $cellNo = $row['cli_Phone'];
                                                                                                                                    $email = $row['cli_Email'];
                                                                                                                                    $province = $row['cli_Prov'];
                                                                                                                                    $idNo = $row['cli_IDNo'];

                                                                                                                                    $sql = "INSERT INTO client(cli_Name, cli_Surname, cli_Address, cli_Phone, cli_Email, cli_Password, cli_Prov, level,cli_IDNo)
                                                                                                                                            VALUES('$name','$surname','$address','$cellNo','$email','$newPwd','$province','2','$idNo');";
                                                                                                                                    mysqli_query($conn,$sql);

                                                                                                                            }


                                                                                                                            $id = mysqli_insert_id($conn);

                                                                                                                            $sql = "INSERT INTO account(acc_Number, acc_Type, acc_Date, acc_Balance, cli_ID, branch_ID)
                                                                                                                            VALUES('$code','$accType','$date','$balance','$id','2');";
                                                                                                                            mysqli_query($conn,$sql);


                                                                                                                            $uComm = "You have Successfully created an Account at ".$bankN."\r\r"."Date : ".$date."\r\r"."\r\r"." Your Account number : ".$code."\r\r"."\r\r"."Your Login datails are below "."\r\r"."\r\r"." Username : ".$email."\r\r"." Password : ".$clPwd."\r\r"."\r\r"." Thank you enjoy your banking app";
                                                                                                                            $fromEmail = 'simphiwemthanti76@gmail.com';
                                                                                                                            $toEmail =  $email;
                                                                                                                            $subjectName = $bankN.' Auto reply';
                                                                                                                            $message = $uComm;


                                                                                                                            $to = $toEmail;
                                                                                                                            $subject = $subjectName;
                                                                                                                            $headers = "MIME-Version: 1.0" . "\r\n";
                                                                                                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                                                                                                            $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
                                                                                                                            $message = '<!doctype html>
                                                                                                                            <html lang="en">
                                                                                                                            <head>
                                                                                                                            <meta charset="UTF-8">
                                                                                                                            <meta name="viewport"
                                                                                                                            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                                                                                                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                                                                                                            <title>Document</title>
                                                                                                                            </head>
                                                                                                                            <body>
                                                                                                                            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
                                                                                                                            <div class="container">
                                                                                                                           '.$message.'<br/>
                                                                                                                           Regards<br/>
                                                                                                                           '.$fromEmail.'
                                                                                                                           </div>
                                                                                                                           </body>
                                                                                                                           </html>';
                                                                                                                           $result = @mail($to, $subject, $message, $headers);

                                                                                                                          $_SESSION['message'] = "Client Successfully registerd On CAPITEC";
                                                                                                                          $_SESSION['msg_type'] = "success";
                                                                                                                          echo "<script>location.replace('viewClients.php');</script>";
                                                                                                                          exit();





                                                                                                                          }


                                                                                                            }
                                                                                                            else if(!$found)
                                                                                                            {


                                                                                                                $_SESSION['message'] = "already have an account";
                                                                                                                $_SESSION['msg_type'] = "danger";
                                                                                                                echo "<script>location.replace('viewClients.php');</script>";
                                                                                                                exit();

                                                                                                            }

                                                                                                          }









                                                                                            }
                                                                                            else
                                                                                            {

                                                                                              $_SESSION['message'] = "Fill in all field";
                                                                                              $_SESSION['msg_type'] = "danger";
                                                                                              echo "<script>location.replace('#addClent');</script>";
                                                                                              exit();
                                                                                            }

                                                                                            }
                                                                                            else
                                                                                            {

                                                                                              $_SESSION['message'] = "ID Number field should be 13 RSA Digit";
                                                                                              $_SESSION['msg_type'] = "danger";
                                                                                              echo "<script>location.replace('#addClent');</script>";
                                                                                              exit();
                                                                                            }
                                                                                          }
                                                                                          else
                                                                                          {

                                                                                            $_SESSION['message'] = "ID Number field is empty";
                                                                                            $_SESSION['msg_type'] = "danger";
                                                                                            echo "<script>location.replace('index.php');</script>";
                                                                                            exit();
                                                                                          }

                                                                                    }
                                                                                    else
                                                                                    {

                                                                                      $_SESSION['message'] = "Provine field must be character";
                                                                                      $_SESSION['msg_type'] = "danger";
                                                                                      echo "<script>location.replace('index.php');</script>";
                                                                                      exit();
                                                                                    }
                                                                            }
                                                                            else
                                                                            {

                                                                              $_SESSION['message'] = "province field is empty";
                                                                              $_SESSION['msg_type'] = "danger";
                                                                              echo "<script>location.replace('index.php');</script>";
                                                                              exit();
                                                                            }
                                                                      }
                                                                      else
                                                                      {

                                                                        $_SESSION['message'] = "Email format is invalid";
                                                                        $_SESSION['msg_type'] = "danger";
                                                                        echo "<script>location.replace('index.php');</script>";
                                                                        exit();
                                                                      }
                                                                }
                                                                else
                                                                {

                                                                  $_SESSION['message'] = "Email address field is empty";
                                                                  $_SESSION['msg_type'] = "danger";
                                                                  echo "<script>location.replace('index.php');</script>";
                                                                  exit();
                                                                }
                                                          }
                                                          else
                                                          {

                                                            $_SESSION['message'] = "Cell number doesnot exist";
                                                            $_SESSION['msg_type'] = "danger";
                                                            echo "<script>location.replace('index.php');</script>";
                                                            exit();
                                                          }
                                                    }
                                                    else
                                                    {

                                                      $_SESSION['message'] = "Cell number must contain digit only start with 0";
                                                      $_SESSION['msg_type'] = "danger";
                                                      echo "<script>location.replace('index.php');</script>";
                                                      exit();
                                                    }
                                          }
                                          else
                                          {

                                            $_SESSION['message'] = "Cell number field is empty";
                                            $_SESSION['msg_type'] = "danger";
                                            echo "<script>location.replace('index.php');</script>";
                                            exit();
                                          }
                                  }
                                  else
                                  {

                                    $_SESSION['message'] = "Address field cannot contain special characters";
                                    $_SESSION['msg_type'] = "danger";
                                    echo "<script>location.replace('index.php');</script>";
                                    exit();
                                  }
                            }
                            else
                            {

                              $_SESSION['message'] = "Address field is empty";
                              $_SESSION['msg_type'] = "danger";
                              echo "<script>location.replace('index.php');</script>";
                              exit();
                            }
                      }
                      else
                      {

                        $_SESSION['message'] = "Surname field must be characters";
                        $_SESSION['msg_type'] = "danger";
                        echo "<script>location.replace('index.php');</script>";
                        exit();
                      }
                }
                else
                {

                  $_SESSION['message'] = "Surname field is empty";
                  $_SESSION['msg_type'] = "danger";
                  echo "<script>location.replace('index.php');</script>";
                  exit();
                }
          }
          else
          {

            $_SESSION['message'] = "Name field must be characters";
            $_SESSION['msg_type'] = "danger";
            echo "<script>location.replace('index.php');</script>";
            exit();
          }
  }
  else
  {

    $_SESSION['message'] = "Name field is empty";
    $_SESSION['msg_type'] = "danger";
    echo "<script>location.replace('index.php');</script>";
    exit();
  }

}

?>
