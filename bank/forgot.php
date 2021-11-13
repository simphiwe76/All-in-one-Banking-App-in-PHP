<?php
      include_once '../database/dbConn.php';
      if (isset($_POST['btn_forget']))
      {


              $email = $_POST['email'];

              $email =  mysqli_real_escape_string($conn,$email);

              if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
              {

                $sql = "SELECT* FROM employee WHERE emp_Email = '$email' OR emp_Number = '$email';";
                $result = mysqli_query($conn,$sql);
                $numRow = mysqli_num_rows($result);


                if ($numRow == 1)
                {

                  function gen_Pwd()
                  {
                      $str = "VI!lJEu@Ln1jd2SJLR@kr5bZDL03iAc4Mvs5L1l6zM7fxVf8O%VO9oOjPL";
                      $randStr = substr(str_shuffle($str),0,8);
                      return $randStr;

                  }

                  $newGen = gen_Pwd();
                  $newGen =  mysqli_real_escape_string($conn,$newGen);
                  $newPwd = password_hash($newGen,PASSWORD_DEFAULT);
                  
                  $sql = "UPDATE employee SET emp_Password = '$newPwd' WHERE  emp_Email = '$email' OR emp_Number = '$email';";
                  mysqli_query($conn,$sql);


                  $uComm = "You have successFully Reset your password  "."\r\n"."\r\r"."Email : ".$email."\r\r"."\r\n"."Password : ".$newGen;
                  $fromEmail = 'Admin_ubs@ubsystem.co.za';
                  $toEmail =  $email;
                  $subjectName = 'Password Successful Recovered';
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


                  echo '<script>alert("Password successFully Resetted check email for logins")</script>';
                  echo "<script>location.replace('index.html');</script>";
                  exit();
                }
                else
                {
                  echo '<script>alert("User doesnot  exist")</script>';
                  echo "<script>location.replace('../index.html');</script>";
                  exit();
                }

              }
               else if(empty($email))
              {
                echo '<script>alert("Fill in  there email")</script>';
                echo "<script>location.replace('index.html');</script>";
                exit();
              }
              if(!filter_var($email, FILTER_VALIDATE_EMAIL))
              {

                echo '<script>alert("Invalid Email")</script>';
                echo "<script>location.replace('index.html');</script>";
                exit();
              }





          }






?>
