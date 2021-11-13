<?php

          
          
          include_once 'database/dbConn.php';


          if (isset($_POST['sub_Msg']))
          {
                $name = ucwords($_POST['name']);
                $email = $_POST['email'];
                $subject = $_POST['subject'];
                $message = $_POST['message'];




                  if (!empty($name))
                  {
                          if (preg_match("/^[a-zA-Z\s]+$/",$name))
                          {
                                if (!empty($email))
                                {
                                  if (filter_var($email, FILTER_VALIDATE_EMAIL))
                                  {
                                        if (!empty($subject))
                                        {
                                              if (preg_match("/^[a-zA-Z\s]+$/",$subject))
                                              {
                                                      if (!empty($message))
                                                      {
                                                              if (preg_match("/^[a-zA-Z\s]+$/",$message))
                                                              {

                                                                
                                                                
                                                                $dateMsg = date("Y/m/d");

                                                                        
                                                                        
                                                                    
                                                                      $sql = "INSERT INTO feedback(feed_Name,feed_Email,feed_Subject,feed_Message,feed_Date)
                                                                              VALUES('$name','$email','$subject','$message','$dateMsg');";
                                                                        mysqli_query($conn,$sql);


                                                                  $uComm = "You have successFully sent a feedback ".$name."\r\n"."Date : ".$dateMsg;
                                                                  $fromEmail = 'simphiwemthanti76@gmail.com';
                                                                  $toEmail =  $email;
                                                                  $subjectName = 'Contact Auto reply';
                                                                  $message = 'Admin will follow up on a commect';

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

                                                                  echo '<script>alert("Admin message has be sent successfully thank you")</script>';
                                                                  echo "<script>location.replace('index.html');</script>";
                                                                  exit();



                                                              }
                                                              else
                                                              {
                                                                echo '<script>alert("Messege field should be characters")</script>';
                                                                echo "<script>location.replace('index.html');</script>";
                                                                exit();
                                                              }
                                                      }
                                                      else
                                                      {
                                                        echo '<script>alert("Messege field is empty")</script>';
                                                        echo "<script>location.replace('index.html');</script>";
                                                        exit();
                                                      }
                                              }
                                              else
                                              {
                                                echo '<script>alert("Subject format is should be characters")</script>';
                                                echo "<script>location.replace('index.html');</script>";
                                                exit();
                                              }
                                        }
                                        else
                                        {
                                          echo '<script>alert("Subject field is empty")</script>';
                                          echo "<script>location.replace('index.html');</script>";
                                          exit();
                                        }
                                  }
                                  else
                                  {
                                    echo '<script>alert("Email is incorrect")</script>';
                                    echo "<script>location.replace('index.html');</script>";
                                    exit();
                                  }
                                }
                                else
                                {
                                  echo '<script>alert("Email field is empty")</script>';
                                  echo "<script>location.replace('index.html');</script>";
                                  exit();
                                }
                          }
                          else
                          {
                            echo '<script>alert("Name field format is incorrect")</script>';
                            echo "<script>location.replace('index.html');</script>";
                            exit();
                          }
                  }
                  else
                  {
                    echo '<script>alert("Name field is empty")</script>';
                    echo "<script>location.replace('index.html');</script>";
                    exit();
                  }




            }


    ?>
