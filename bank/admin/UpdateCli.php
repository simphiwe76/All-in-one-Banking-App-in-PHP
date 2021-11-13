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

    <title><?php echo $bankN." Admin Panel"; ?></title>

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
            <a href="index.php" class="logo"><b><?php echo $bankN." "."Admin Panel" ?></b></a>
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

                <?php

                  if ($bankN == "Fnb")
                  {
                    echo '<img src="img/Fnb.png" alt="" class="img-box centered" >';
                  }
                  elseif ($bankN == "Capitec")
                  {
                          echo '<img src="img/Capitec.png" alt="" class="img-box centered" >';
                  }



                ?>

              	  <h5 class="centered"><?php echo $row['emp_Name']." ".$row['emp_Surname']; ?></h5>

                  <li class="mt">
                      <a  href="index.php"  >
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
                  



              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php

      $cli_ID = "";
      $cli_Name = "";
      $cli_Surname = "";
      $cli_IDNo = "";
      $cli_Email = "";
      $cli_Address = "";

      if (isset($_GET['type']))
      {

        if ($_GET['type'] == "update")
        {
          $sql = "SELECT* FROM client WHERE cli_ID = '".$_GET['id']."'";
          $result = mysqli_query($conn,$sql);
          if (mysqli_num_rows($result) == 1)
          {

            $return = mysqli_fetch_assoc($result);
            $cli_ID = $return['cli_ID'];
            $cli_Name = $return['cli_Name'];
            $cli_Surname = $return['cli_Surname'];
            $cli_IDNo = $return['cli_IDNo'];
            $cli_Email = $return['cli_Email'];
            $cli_Address = $return['cli_Address'];

          }
        }


      }


      ?>
      <section id="main-content">
          <section class="wrapper">
      		<div class="row mt">
            <div class="container">
<div class="col-md-12">

  <h4>UPDATE Client Details</h4>
  <?php

    if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">

      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      ?>

  </div>
<?php endif ?>
  <form class="form-horizontal templatemo-create-account templatemo-container" role="form" action="UpdateCli.php" method="post">
    <div class="form-inner">
          <div class="form-group">
            <div class="col-md-4">
              <label for="first_name" class="control-label">Client ID</label>
              <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
              <input type="text" name="clID" value= "<?php  echo $cli_ID; ?>" class="form-control" readonly id="first_name" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="username" class="control-label">Name</label>
              <i class="fa fa-user" aria-hidden="true"></i>
              <input type="text" name="name" value="<?php echo $cli_Name;?>" class="form-control" readonly id="first_name" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="password" class="control-label">Surname</label>
              <i class="fa fa-user" aria-hidden="true"></i>
              <input type="text" value="<?php echo $cli_Surname; ?>"  name="surname"class="form-control" readonly id="first_name" placeholder="">
            </div>

          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="password" class="control-label">ID Number</label>
              <i class="fa fa-user" aria-hidden="true"></i>
              <input type="text" value="<?php echo $cli_IDNo;?>" name="idNo"class="form-control" readonly id="first_name" placeholder="">
            </div>

          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="password" class="control-label">Email</label>
              <i class="fa fa-envelope-o" aria-hidden="true"></i>
              <input type="email" value="<?php echo $cli_Email; ?>" name="email" class="form-control" id="email" placeholder="">
            </div>

          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="password" class="control-label">Address</label>
              <i class="fa fa-location-arrow" aria-hidden="true"></i>
              <td></td>
              <input type="text" value="<?php echo $cli_Address; ?>" name="address" class="form-control" id="first_name" placeholder="">
            </div>

          </div>

          <div class="form-group">
            <div class="col-md-4">
              <label for="password" class="control-label">Password</label>
              <i class="fa fa-unlock" aria-hidden="true"></i>
              <input type="password" name="pwd" class="form-control" id="password" placeholder="">
            </div>

          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="password" class="control-label">Confirm Password</label>
              <i class="fa fa-unlock" aria-hidden="true"></i>
              <input type="password" name="pwdC" class="form-control" id="password" placeholder="">
            </div>

          </div>
          <div class="form-group">
            <div class="col-md-12">
              <label><input type="checkbox">I agree to  <a  data-toggle="modal" data-target="#templatemo_modal">Update</a> The <a >Client Details</a></label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">

              <button type="submit" class="btn btn-info" name="updateE">Save</button>

            </div>
          </div>
    </div>
      </form>
</div>
</div>
      			<div class="col-lg-6 col-md-6 col-sm-12">
      			</div><!-- /col-lg-6 -->

      		</div><!--/ row -->
          </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->


  </section>

  <?php


        if (isset($_POST['updateE'])&&isset($emp_ID)&&isset($emp_Number)&&$level == 3 && $stu == "yes")
        {

                    $email = $_POST['email'];
                    $address = ucwords($_POST['address']);
                    $pwd = $_POST['pwd'];
                    $pwdC = $_POST['pwdC'];
                    $cID = $_POST['clID'];







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
                                            if (preg_match("/^[a-zA-Z,0-9\s]+$/",$address))
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



                                                                                          $sql = "UPDATE client SET cli_Email = '$email',cli_Address = '$address',cli_Password = '$newPass'
                                                                                                WHERE cli_ID= '$cID';";
                                                                                          mysqli_query($conn,$sql);



                                                                                          $uComm = "Your profile was updated Successfully by admin "."\r\n"."Date on : ".$date."\r\n"."\r\n"." Your new password is : ".$pwdC."\r\n"."\r\n"."Email Address "."\r\n"."\r\n".$email."\r\n"."\r\n"."Regurd ".$bankN;
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



                                                                                          $_SESSION['message'] = "Client Profile Successfully updated";
                                                                                          $_SESSION['msg_type'] = "success";
                                                                                          echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                                                                          exit();

                                                                                }
                                                                                else
                                                                                {

                                                                                  $_SESSION['message'] = "Password doesnot match";
                                                                                  $_SESSION['msg_type'] = "danger";
                                                                                  echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                                                                  exit();
                                                                                }
                                                                        }
                                                                        else
                                                                        {

                                                                          $_SESSION['message'] = "Password Confirm field is empty";
                                                                          $_SESSION['msg_type'] = "danger";
                                                                          echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                                                          exit();
                                                                        }
                                                                }
                                                                else
                                                                {

                                                                  $_SESSION['message'] = "Password field is empty";
                                                                  $_SESSION['msg_type'] = "danger";
                                                                  echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                                                  exit();
                                                                }



                                                       }
                                                       else
                                                       {
                                                                  $newPass = password_hash($pwdC,PASSWORD_DEFAULT);

                                                                  $sql = "UPDATE client SET cli_Email = '$email',cli_Address = '$address' WHERE cli_ID = '$cID'";
                                                                  mysqli_query($conn,$sql);

                                                                  $uComm = "Your profile was updated Successfully by Admin "."\r\n"."Date on : ".$date."\r\n"."\r\n"." Your new password is : ".$pwdC."\r\n"."\r\n"."Email Address "."\r\n"."\r\n".$email."\r\n"."\r\n"."Regurd ".$bankN;
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







                                                                  $_SESSION['message'] = "Client Profile Successfully updated";
                                                                  $_SESSION['msg_type'] = "success";
                                                                  echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                                                  exit();



                                                       }




                                            }
                                            else
                                            {

                                              $_SESSION['message'] = "Address field  format is incorrect no Special charecter are allowed example(Flathela 199)";
                                              $_SESSION['msg_type'] = "danger";
                                              echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                              exit();
                                            }
                                    }
                                    else
                                    {

                                      $_SESSION['message'] = "Address field  is  empty";
                                      $_SESSION['msg_type'] = "danger";
                                      echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                                      exit();
                                    }
                          }
                          else
                          {

                            $_SESSION['message'] = "Email field format is incorrect example(simphiwemthanti76@gmail.com)";
                            $_SESSION['msg_type'] = "danger";
                            echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                            exit();
                          }
                    }
                    else
                    {

                      $_SESSION['message'] = "Email field  is  empty";
                      $_SESSION['msg_type'] = "danger";
                      echo "<script>location.replace('UpdateCli.php?type=update&id=".$cID."');</script>";
                      exit();
                    }




        }


  ?>

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
      </script>
  </body>
</html>
