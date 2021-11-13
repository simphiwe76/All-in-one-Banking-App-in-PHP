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

$sql = "SELECT* FROM employee WHERE emp_ID = '$emp_ID';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?php echo " Admin Panel"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" ></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Universal Admin Panel </b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->

                <!--  notification end -->
            </div>
            <div class="top-menu">

            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>

            	</ul>

            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">



              	  <h5 class="centered"><?php echo $row['emp_Name']." ".$row['emp_Surname']; ?></h5>






                  <li class="mt">
                      <a class="active" href="index.php"  >
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a  href="AddEmp.php" >
                          <i class="fa fa-desktop"></i>
                          <span>Manager Employee</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="AddEmp.php">Add Employee</a></li>
                          <li><a  href="viewEmp.php">View Employee</a></li>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Manager User</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="addClient.php">Add Client</a></li>
                          <li><a  href="viewClient.php">View Client</a></li>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a data-toggle="modal" href="#exampleModal" >
                          <i class="fa fa-book"></i>
                          <span>Update Profile</span>
                      </a>

                  </li>



              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">


            <h1 style="text-align:center"><?php echo "Welcome to ".strtoupper($bankN); ?></h1>
            <?php

              if (isset($_SESSION['message'])): ?>
              <div class="alert alert-<?=$_SESSION['msg_type']?>">

                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>

            </div>
          <?php endif ?>

                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">

                      <div class="item active">


                        <?php
                        if ($bankN == "Fnb")
                        {
                          echo '<img src="img/intro/fnb1.jpg" alt="Los Angeles" style="width:100%;">';
                        }
                        elseif ($bankN == "Capitec")
                        {
                                echo '<img src="img/intro/Capitec2.jpg" alt="Los Angeles" style="width:100%;">';
                        }

                        ?>


                      <div class="carousel-caption">

                      </div>
                      </div>

                      <div class="item">
                        <?php
                        if ($bankN == "Fnb")
                        {
                          echo '<img src="img/intro/fnb2.jpg" alt="Los Angeles" style="width:100%;">';
                        }
                        elseif ($bankN == "Capitec")
                        {
                                echo '<img src="img/intro/Capitec3.png" alt="Los Angeles" style="width:100%;">';
                        }

                        ?>
                      <div class="carousel-caption">

                      </div>
                      </div>

                      <div class="item">
                        <?php
                        if ($bankN == "Fnb")
                        {
                          echo '<img src="img/intro/fnb3.jpg" alt="Los Angeles" style="width:100%;">';
                        }
                        elseif ($bankN == "Capitec")
                        {
                                echo '<img src="img/intro/Capitec1.png" alt="Los Angeles" style="width:100%;">';
                        }

                        ?>
                      <div class="carousel-caption">

                      </div>
                      </div>

                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                      </a>
                      </div>








          </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->


  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jjquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <script type="application/javascript">
          $(document).ready(function () {
              $("#date-popover").popover({html: true, trigger: "manual"});
              $("#date-popover").hide();
              $("#date-popover").click(function (e) {
                  $(this).hide();
              });

              $("#my-calendar").zabuto_calendar({
                  action: function () {
                      return myDateFunction(this.id, false);
                  },
                  action_nav: function () {
                      return myNavFunction(this.id);
                  },
                  ajax: {
                      url: "show_data.php?action=1",
                      modal: true
                  },
                  legend: [
                      {type: "text", label: "Special event", badge: "00"},
                      {type: "block", label: "Regular event", }
                  ]
              });
          });


          function myNavFunction(id) {
              $("#date-popover").hide();
              var nav = $("#" + id).data("navigation");
              var to = $("#" + id).data("to");
              console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
          }

          var myCarousel = document.querySelector('#myCarousel')
var carousel = new bootstrap.Carousel(myCarousel)
      </script>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <?php

                if ($bankN == "Fnb")
                {
                  echo '<h5 class="modal-title" id="exampleModalLabel">Update Profile</h5><img src="img/Fnb.png" alt="" class="img-box centered" >';
                }
                elseif ($bankN == "Capitec")
                {
                        echo '<h5 class="modal-title" id="exampleModalLabel">Update Profile</h5><img src="img/Capitec.png" alt="" class="img-box centered" >';
                }



              ?>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
                <form class="form-horizontal templatemo-login-form-2" role="form" action="index.php" method="POST">
                  <div class="row">
                    <div class="col-md-12">

                    </div>
                  </div>
                  <div class="row">
                    <div class="templatemo-one-signin col-md-6">
                      <div class="form-group">
                        <div class="col-md-12">
                          <label for="username" class="control-label">Employee Number</label>
                          <div class="templatemo-input-icon-container">
                            <i class="fa fa-user"></i>
                            <input type="text" class="form-control" value= <?php echo $row['emp_Number']; ?> name="empNum" readonly placeholder="">
                          </div>
                        </div>
                      </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <label for="username" class="control-label">Name</label>
                              <div class="templatemo-input-icon-container">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" value= <?php echo $row['emp_Name']; ?> name="name" readonly placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <label for="password" class="control-label">Surname</label>
                              <div class="templatemo-input-icon-container">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" value= <?php echo $row['emp_Surname']; ?> name="surname" readonly placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <label for="password" class="control-label">Email</label>
                              <div class="templatemo-input-icon-container">
                                <i class="fa fa-envelope"></i>
                                <input type="text" class="form-control" value= <?php echo $row['emp_Email'];  ?> name="email" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <label for="password" class="control-label">Address</label>
                              <div class="templatemo-input-icon-container">
                                <i class="fa fa-map-marker"></i>
                                <input type="text" class="form-control" value= <?php echo $row['emp_Address']; ?> name="address" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <label for="password" class="control-label">Password</label>
                              <div class="templatemo-input-icon-container">
                                <i class="fa fa-map-marker"></i>
                                <input type="password" class="form-control" name="pwd" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <label for="password" class="control-label">Corfirm Password</label>
                              <div class="templatemo-input-icon-container">
                                <i class="fa fa-map-marker"></i>
                                <input type="password" class="form-control" name="pwdC" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12">
                              <div class="checkbox">
                                <li class="fa fa-thumbs-o-up"></li>
                                  <label>

                                    <input type="checkbox"> Agree
                                  </label>
                              </div>
                            </div>
                          </div>

                          </div>

                  </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <button type="submit" name="btnUpdate" class="btn btn-warning ">Save changes</button>
            </div>
          </div>
            </form>
        </div>
      </div>

      <?php


            if (isset($_POST['btnUpdate'])&&isset($emp_ID)&&isset($emp_Number)&&$level == 3 && $stu == "yes")
            {

                        $email = $_POST['email'];
                        $address = ucwords($_POST['address']);
                        $pwd = $_POST['pwd'];
                        $pwdC = $_POST['pwdC'];








                        $email =   mysqli_real_escape_string($conn,$email);
                        $address =   mysqli_real_escape_string($conn,$address);
                        $pwd =   mysqli_real_escape_string($conn,$pwd);
                        $pwdC =   mysqli_real_escape_string($conn,$pwdC);

                        $date = Date('Y-m-d');

                        if (!empty($email))
                        {
                              if (filter_var($email, FILTER_VALIDATE_EMAIL))
                              {
                                        if (!empty($address))
                                        {
                                                if (preg_match("/^[a-zA-Z0-9\s]+$/",$address))
                                                {

                                                           if (!empty($pwd)||!empty($pwdC))
                                                           {
                                                                    if (!empty($pwd))
                                                                    {
                                                                            if (!empty($pwdC))
                                                                            {
                                                                                    if ($pwdC == $pwd)
                                                                                    {
                                                                                              $newPass = password_hash($pwdC,PASSWORD_DEFAULT);




                                                                                              $sql = "UPDATE employee SET emp_Email = '$email',emp_Address = '$address',emp_Password = '$newPass'
                                                                                                    WHERE emp_ID = '$emp_ID';";
                                                                                              mysqli_query($conn,$sql);



                                                                                              $uComm = "Your profile was updated Successfully "."\r\n"."Date on : ".$date."\r\n"."\r\n"." Your new password is : ".$pwdC."\r\n"."\r\n"."Email Address "."\r\n"."\r\n".$email."\r\n"."\r\n"."Regurd ".$bankN;
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




                                                                                              echo '<script>alert("Employee Profile Successfully updated")</script>';
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
                                                                              echo '<script>alert("Password Confirm field is empty")</script>';
                                                                              echo "<script>location.replace('index.php');</script>";
                                                                              exit();
                                                                            }
                                                                    }
                                                                    else
                                                                    {
                                                                      echo '<script>alert("Password field is empty")</script>';
                                                                      echo "<script>location.replace('index.php');</script>";
                                                                      exit();
                                                                    }



                                                           }
                                                           else
                                                           {
                                                                      $newPass = password_hash($pwdC,PASSWORD_DEFAULT);

                                                                      $sql = "UPDATE employee SET emp_Email = '$email',emp_Address = '$address' WHERE emp_ID = '$emp_ID';";
                                                                      mysqli_query($conn,$sql);


                                                                      $uComm = "Your profile was updated Successfully "."\r\n"."Date on : ".$date."\r\n"."\r\n"." Your new password is : ".$pwdC."\r\n"."\r\n"."Email Address "."\r\n"."\r\n".$email."\r\n"."\r\n"."Regurd ".$bankN;
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






                                                                      echo '<script>alert("Employee Profile Successfully updated")</script>';
                                                                      echo "<script>location.replace('index.php');</script>";
                                                                      exit();



                                                           }




                                                }
                                                else
                                                {
                                                  echo '<script>alert("Address field  format is incorrect no Special charecter are allowed example(Flathela 199)")</script>';
                                                  echo "<script>location.replace('index.php');</script>";
                                                  exit();
                                                }
                                        }
                                        else
                                        {
                                          echo '<script>alert("Address field  is  empty")</script>';
                                          echo "<script>location.replace('index.php');</script>";
                                          exit();
                                        }
                              }
                              else
                              {
                                echo '<script>alert("Email field format is incorrect example(simphiwemthanti76@gmail.com)")</script>';
                                echo "<script>location.replace('index.php');</script>";
                                exit();
                              }
                        }
                        else
                        {
                          echo '<script>alert("Email field  is  empty")</script>';
                          echo "<script>location.replace('index.php');</script>";
                          exit();
                        }




            }


      ?>

  </body>
</html>
