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
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

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
                  <div class="fa fa-bars tooltips" data-placement="right"></div>
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
                      <a  href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="AddEmp.php" >
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
      <section id="main-content">
          <section class="wrapper">
      		<div class="row mt">

            <div class="container" style="position: relative;">
  <div class="col-md-12">
    <form class="form-horizontal templatemo-login-form-2" role="form" action="AddEmp.php" method="POST">
      <div class="row">
        <div class="col-md-12">
          <h3>Add employee</h3>
          <?php

            if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">

              <?php
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
              ?>

          </div>
        <?php endif ?>

        </div>
      </div>
      <div class="row">
        <div class="templatemo-one-signin col-md-6">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="username" class="control-label">Name</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="name"  placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Surname</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="surname" placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Email</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-envelope"></i>
                    <input type="text" class="form-control" name="Email" placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Address</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-map-marker"></i>
                    <input type="text" class="form-control" name="address" placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Province Name</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-location-arrow"></i>
                    <select name="province" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                              <option value="">Select</option>
                              <option value="Eastern Cape">Eastern Cape</option>
                              <option value="Free State">Free State</option>
                              <option value="Gauteng">Gauteng</option>
                              <option value="KwaZulu Natal">KwaZulu-Natal</option>
                              <option value="Limpopo">Limpopo</option>
                              <option value="Mpumalanga">Mpumalanga</option>
                              <option value="North West">North West</option>
                              <option value="Northern Cape">Northern Cape</option>
                              <option value="Western Cape">Western Cape</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Choose Access Level</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-user"></i>
                    <select name="level" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                              <option value="">Select</option>
                              <option value="3">Admin</option>
                              <option value="1">Employee</option>
                    </select>
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
              <div class="form-group">
                <div class="col-md-12">
                      <button type="submit" class="btn btn-warning" name="empBtn">ADD EMPLOYEE</button>
                </div>
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
      if (isset($_POST['empBtn'])&&isset($emp_ID)&&isset($emp_Number)&&$level == 3 && $stu == "yes"&&$bankN == "Fnb")
      {
                $name = ucwords($_POST['name']);
                $surname = ucwords($_POST['surname']);
                $Email = $_POST['Email'];
                $address = ucwords($_POST['address']);
                $provName = $_POST['province'];




                $name =   mysqli_real_escape_string($conn,$name);
                $surname = mysqli_real_escape_string($conn,$surname);

                $address = mysqli_real_escape_string($conn,$address);
                $provName =   mysqli_real_escape_string($conn,$provName);



                          if (!empty($name))
                          {
                                  if (preg_match("/^[a-zA-Z\s]+$/",$name))
                                  {
                                          if (!empty($surname))
                                          {
                                                  if (preg_match("/^[a-zA-Z]+$/",$surname))
                                                  {
                                                          if (!empty($Email))
                                                          {
                                                                  if (filter_var($Email, FILTER_VALIDATE_EMAIL))
                                                                  {
                                                                            if (!empty($address))
                                                                            {
                                                                                    if (preg_match("/^[a-z,A-Z0-9\s]+$/",$address))
                                                                                    {
                                                                                                if (!empty($provName))
                                                                                                {
                                                                                                          $digit = 92;
                                                                                                          $bankID = 1;
                                                                                                          $level = 1;
                                                                                                          $date = Date('Y-m-d');
                                                                                                          $sha = str_shuffle("dadaBomaSuiphoabcddefZYASDHEsk246#$#@%qSzmag");

                                                                                                          $pwd = substr($sha,0,8);
                                                                                                          $pwd =   mysqli_real_escape_string($conn,$pwd);



                                                                                                          $newPass = password_hash($pwd,PASSWORD_DEFAULT);
                                                                                                          $randNum = rand(2054289,4541545);
                                                                                                          $empnNum = $digit.$randNum;

                                                                                                          $empnNum =   mysqli_real_escape_string($conn,$empnNum);

                                                                                                          $sql = "SELECT* FROM employee WHERE  emp_Email = '$Email';";

                                                                                                          $result = mysqli_query($conn,$sql);
                                                                                                          $check = mysqli_num_rows($result);

                                                                                                          $Email =   mysqli_real_escape_string($conn,$Email);





                                                                                                          if ($check == 0)
                                                                                                          {



                                                                                                                    if (!empty($_POST['level']))
                                                                                                                    {
                                                                                                                      $level = $_POST['level'];
                                                                                                                      $level =   mysqli_real_escape_string($conn,$level);
                                                                                                                      $sql = "INSERT INTO employee ( emp_Name, emp_Surname, emp_Number, emp_Email, emp_Address, emp_Password, bank_ID, emp_Prov, level)
                                                                                                                             VALUES('$name','$surname','$empnNum','$Email','$address','$newPass','$bankID','$provName','$level');";
                                                                                                                      mysqli_query($conn,$sql);









                                                                                                                      $uComm = "You login Details as Employee ".$bankN." is"."\n"."\nDate registered : ".$date."\n"."\n"."\n Your Employee number : ".$empnNum."\n"."\n"."\nEmail Address "."\n"."\n".$Email."\n"."\n".
                                                                                                                      "\nYour login detail are below"."\n"."\n"."\nEmployee number or Email "."\n"."\nPassword : ".$pwd."\n"."\n"."\nRegurd FNB ";
                                                                                                                      $fromEmail = 'simphiwemthanti76@gmail.com';
                                                                                                                      $toEmail =  $Email;
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


                                                                                                                            if($_POST['level'] == 3)
                                                                                                                             {

                                                                                                                                $_SESSION['message'] = "Admin have been Successfully added check email for login details";
                                                                                                                             		$_SESSION['msg_type'] = "success";
                                                                                                                                 echo "<script>location.replace('viewEmp.php');</script>";
                                                                                                                                 exit();
                                                                                                                             }
                                                                                                                             else if($_POST['level'] == 1)
                                                                                                                             {

                                                                                                                                 $_SESSION['message'] = "Employee have been Successfully added check email for login details";
                                                                                                                                 $_SESSION['msg_type'] = "success";
                                                                                                                                 echo "<script>location.replace('viewEmp.php');</script>";
                                                                                                                                 exit();
                                                                                                                             }

                                                                                                                    }
                                                                                                                    else
                                                                                                                    {

                                                                                                                      $_SESSION['message'] = "Employee access is not selected";
                                                                                                                      $_SESSION['msg_type'] = "danger";
                                                                                                                      echo "<script>location.replace('AddEmp.php');</script>";
                                                                                                                      exit();
                                                                                                                    }


                                                                                                          }
                                                                                                          else
                                                                                                          {

                                                                                                            $_SESSION['message'] = "Email  already exist";
                                                                                                            $_SESSION['msg_type'] = "danger";
                                                                                                            echo "<script>location.replace('AddEmp.php');</script>";
                                                                                                            exit();
                                                                                                          }





                                                                                                }
                                                                                                else
                                                                                                {

                                                                                                  $_SESSION['message'] = "Province name was not selected";
                                                                                                  $_SESSION['msg_type'] = "danger";
                                                                                                  echo "<script>location.replace('AddEmp.php');</script>";
                                                                                                  exit();
                                                                                                }
                                                                                    }
                                                                                    else
                                                                                    {

                                                                                      $_SESSION['message'] = "Address field  format is incorrect no Special charecter are allowed example(Flathela 199)";
                                                                                      $_SESSION['msg_type'] = "danger";
                                                                                      echo "<script>location.replace('AddEmp.php');</script>";
                                                                                      exit();
                                                                                    }
                                                                            }
                                                                            else
                                                                            {

                                                                              $_SESSION['message'] = "Address field  is  empty";
                                                                              $_SESSION['msg_type'] = "danger";
                                                                              echo "<script>location.replace('AddEmp.php');</script>";
                                                                              exit();
                                                                            }
                                                                  }
                                                                  else
                                                                  {

                                                                    $_SESSION['message'] = "Email field format is incorrect example(simphiwemthanti76@gmail.com)";
                                                                    $_SESSION['msg_type'] = "danger";
                                                                    echo "<script>location.replace('AddEmp.php');</script>";
                                                                    exit();
                                                                  }
                                                          }
                                                          else
                                                          {

                                                            $_SESSION['message'] = "Email field  is  empty";
                                                            $_SESSION['msg_type'] = "danger";
                                                            echo "<script>location.replace('AddEmp.php');</script>";
                                                            exit();
                                                          }
                                                  }
                                                  else
                                                  {

                                                    $_SESSION['message'] = "Surname field format is incorrect it must contain character";
                                                    $_SESSION['msg_type'] = "danger";
                                                    echo "<script>location.replace('AddEmp.php');</script>";
                                                    exit();
                                                  }
                                          }
                                          else
                                          {

                                            $_SESSION['message'] = "Surname field  is it empty";
                                            $_SESSION['msg_type'] = "danger";
                                            echo "<script>location.replace('AddEmp.php');</script>";
                                            exit();
                                          }
                                  }
                                  else
                                  {

                                    $_SESSION['message'] = "Name field format is incorrect it must contain character";
                                    $_SESSION['msg_type'] = "danger";
                                    echo "<script>location.replace('AddEmp.php');</script>";
                                    exit();
                                  }
                          }
                          else
                          {

                            $_SESSION['message'] = "Name field is empty";
                            $_SESSION['msg_type'] = "danger";
                            echo "<script>location.replace('AddEmp.php');</script>";
                            exit();
                          }









      }
       else if (isset($_POST['empBtn'])&&isset($emp_ID)&&isset($emp_Number)&&$level == 3 && $stu == "yes"&&$bankN == "Capitec")
      {

        $name = ucwords($_POST['name']);
        $surname = ucwords($_POST['surname']);
        $Email = $_POST['Email'];
        $address = ucwords($_POST['address']);
        $provName = $_POST['province'];


        $name =   mysqli_real_escape_string($conn,$name);
        $surname = mysqli_real_escape_string($conn,$surname);
        $Email =   mysqli_real_escape_string($conn,$Email);
        $address = mysqli_real_escape_string($conn,$address);
        $provName =   mysqli_real_escape_string($conn,$provName);



                  if (!empty($name))
                  {
                          if (preg_match("/^[a-zA-Z\s]+$/",$name))
                          {
                                  if (!empty($surname))
                                  {
                                          if (preg_match("/^[a-zA-Z]+$/",$surname))
                                          {
                                                  if (!empty($Email))
                                                  {
                                                          if (filter_var($Email, FILTER_VALIDATE_EMAIL))
                                                          {
                                                                    if (!empty($address))
                                                                    {
                                                                            if (preg_match("/^[a-z,A-Z0-9\s]+$/",$address))
                                                                            {
                                                                                        if (!empty($provName))
                                                                                        {
                                                                                                  $digit = 72;
                                                                                                  $bankID = 2;
                                                                                                  $level = 1;
                                                                                                  $date = Date('Y-m-d');
                                                                                                  $sha = str_shuffle("dadaBomaSuiphoabcddefZYASDHEsk246#$#@%qSzmag");

                                                                                                  $pwd = substr($sha,0,8);
                                                                                                  $pwd =   mysqli_real_escape_string($conn,$pwd);


                                                                                                  $newPass = password_hash($pwd,PASSWORD_DEFAULT);
                                                                                                  $randNum = rand(4054289,6041545);
                                                                                                  $empnNum = $digit.$randNum;
                                                                                                  $empnNum =   mysqli_real_escape_string($conn,$empnNum);

                                                                                                  $sql = "SELECT* FROM employee WHERE  emp_Email = '$Email';";

                                                                                                  $result = mysqli_query($conn,$sql);
                                                                                                  $check = mysqli_num_rows($result);

                                                                                                  $Email =   mysqli_real_escape_string($conn,$Email);

                                                                                                  if ($check == 0)
                                                                                                  {



                                                                                                            if (!empty($_POST['level']))
                                                                                                            {
                                                                                                              $level = $_POST['level'];
                                                                                                              $level =   mysqli_real_escape_string($conn,$level);
                                                                                                              $sql = "INSERT INTO employee ( emp_Name, emp_Surname, emp_Number, emp_Email, emp_Address, emp_Password, bank_ID, emp_Prov, level)
                                                                                                                     VALUES('$name','$surname','$empnNum','$Email','$address','$newPass','$bankID','$provName','$level');";
                                                                                                              mysqli_query($conn,$sql);









                                                                                                              $uComm = "You login Details as Employee ".$bankN." is"."\r\nDate registered : ".$date."\r\n Your Employee number : ".$empnNum."\r\nEmail Address ".$Email.
                                                                                                                      "\r\nYour login detail are below"."\r\nEmployee number or Email "."\r\nPassword : ".$pwd."\r\nRegurd CAPITEC ";
                                                                                                              $fromEmail = 'simphiwemthanti76@gmail.com';
                                                                                                              $toEmail =  $Email;
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

                                                                                                             if($_POST['level'] == 3)
                                                                                                             {

                                                                                                                 $_SESSION['message'] = "Admin have been Successfully added check email for login details";
                                                                                                                 $_SESSION['msg_type'] = "success";
                                                                                                                 echo "<script>location.replace('viewEmp.php');</script>";
                                                                                                                 exit();
                                                                                                             }
                                                                                                             else if($_POST['level'] == 1)
                                                                                                             {

                                                                                                                 $_SESSION['message'] = "Employee have been Successfully added check email for login details";
                                                                                                                 $_SESSION['msg_type'] = "success";
                                                                                                                 echo "<script>location.replace('viewEmp.php');</script>";
                                                                                                                 exit();
                                                                                                             }




                                                                                                            }
                                                                                                            else
                                                                                                            {

                                                                                                              $_SESSION['message'] = "Employee access is not seletecd";
                                                                                                              $_SESSION['msg_type'] = "danger";
                                                                                                              echo "<script>location.replace('AddEmp.php');</script>";
                                                                                                              exit();
                                                                                                            }


                                                                                                  }
                                                                                                  else
                                                                                                  {

                                                                                                    $_SESSION['message'] = "Email  already exist";
                                                                                                    $_SESSION['msg_type'] = "danger";
                                                                                                    echo "<script>location.replace('AddEmp.php');</script>";
                                                                                                    exit();
                                                                                                  }





                                                                                        }
                                                                                        else
                                                                                        {

                                                                                          $_SESSION['message'] = "Province name was not selected";
                                                                                          $_SESSION['msg_type'] = "danger";
                                                                                          echo "<script>location.replace('AddEmp.php');</script>";
                                                                                          exit();
                                                                                        }
                                                                            }
                                                                            else
                                                                            {

                                                                              $_SESSION['message'] = "Address field  format is incorrect no Special charecter are allowed example(Flathela 199)";
                                                                              $_SESSION['msg_type'] = "danger";
                                                                              echo "<script>location.replace('AddEmp.php');</script>";
                                                                              exit();
                                                                            }
                                                                    }
                                                                    else
                                                                    {

                                                                      $_SESSION['message'] = "Address field  is  empty";
                                                                      $_SESSION['msg_type'] = "danger";
                                                                      echo "<script>location.replace('AddEmp.php');</script>";
                                                                      exit();
                                                                    }
                                                          }
                                                          else
                                                          {


                                                            $_SESSION['message'] = "Email field format is incorrect example(simphiwemthanti76@gmail.com)";
                                                            $_SESSION['msg_type'] = "danger";
                                                            echo "<script>location.replace('AddEmp.php');</script>";
                                                            exit();
                                                          }
                                                  }
                                                  else
                                                  {

                                                    $_SESSION['message'] = "Email field  is  empty";
                                                    $_SESSION['msg_type'] = "danger";
                                                    echo "<script>location.replace('AddEmp.php');</script>";
                                                    exit();
                                                  }
                                          }
                                          else
                                          {

                                            $_SESSION['message'] = "Surname field format is incorrect it must contain character";
                                            $_SESSION['msg_type'] = "danger";
                                            echo "<script>location.replace('AddEmp.php');</script>";
                                            exit();
                                          }
                                  }
                                  else
                                  {

                                    $_SESSION['message'] = "Surname field  is it empty";
                                    $_SESSION['msg_type'] = "danger";
                                    echo "<script>location.replace('AddEmp.php');</script>";
                                    exit();
                                  }
                          }
                          else
                          {

                            $_SESSION['message'] = "Name field format is incorrect it must contain character";
                            $_SESSION['msg_type'] = "danger";
                            echo "<script>location.replace('AddEmp.php');</script>";
                            exit();
                          }
                  }
                  else
                  {

                    $_SESSION['message'] = "Name field is empty";
                    $_SESSION['msg_type'] = "danger";
                    echo "<script>location.replace('AddEmp.php');</script>";
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
