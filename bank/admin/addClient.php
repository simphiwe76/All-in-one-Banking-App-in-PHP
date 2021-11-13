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

    <title<?php echo $bankN." Admin Panel"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

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
                  <div class="fa fa-bars tooltips" data-placement="right" ></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b><?php echo $bankN." "."Admin Panel" ?></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->





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
                      <a  href="viewEmp.php" >
                          <i class="fa fa-desktop"></i>
                          <span>Manager Employee</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="AddEmp.php">Add Employee</a></li>
                          <li><a  href="viewEmp.php">View Employee</a></li>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="addClient.php" >
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
    <form class="form-horizontal templatemo-login-form-2 was-validated" role="form" action="addClient.php" method="POST">
      <div class="row">
        <div class="col-md-12">
          <h3>Add Client</h3>
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
        <div class="templatemo-one-signin col-md-4">
              <div class="form-group">
                <div class="col-md-12 mb-3">
                  <label for="username" class="control-label">Name</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control " name="Name"  id="validationCustomUsername" placeholder="" >
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Surname</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="Surname" placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="username" class="control-label">ID Number</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="idNo"  placeholder="">
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
                  <label for="password" class="control-label">Phone Number</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-envelope"></i>
                    <input type="text" class="form-control" name="Phone" placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="password" class="control-label">Address</label>
                  <div class="templatemo-input-icon-container">
                    <i class="fa fa-map-marker"></i>
                    <input type="text" class="form-control" name="Address" placeholder="">
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
                      <button type="submit" class="btn btn-info" name="clientBtn">ADD Client</button>
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


if (isset($_POST['clientBtn'])&& isset($emp_ID) && $level == 3 &&  $stu == "yes")
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
                                                                                                                                echo "<script>location.replace('viewClient.php');</script>";
                                                                                                                                exit();




                                                                                                                        }




                                                                                                                    }
                                                                                                                    else if (!$found)
                                                                                                                    {


                                                                                                                      $_SESSION['message'] = "already have an account";
                                                                                                                      $_SESSION['msg_type'] = "danger";
                                                                                                                      echo "<script>location.replace('addClient.php');</script>";
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
                                                                                                                                echo "<script>location.replace('viewClient.php');</script>";
                                                                                                                                exit();





                                                                                                                                }


                                                                                                                  }
                                                                                                                  else if(!$found)
                                                                                                                  {


                                                                                                                      $_SESSION['message'] = "already have an account";
                                                                                                                      $_SESSION['msg_type'] = "danger";
                                                                                                                      echo "<script>location.replace('addClient.php');</script>";
                                                                                                                      exit();

                                                                                                                  }

                                                                                                                }









                                                                                                  }
                                                                                                  else
                                                                                                  {

                                                                                                    $_SESSION['message'] = "Fill in all field";
                                                                                                    $_SESSION['msg_type'] = "danger";
                                                                                                    echo "<script>location.replace('addClient.php');</script>";
                                                                                                    exit();
                                                                                                  }

                                                                                                  }
                                                                                                  else
                                                                                                  {

                                                                                                    $_SESSION['message'] = "ID Number field should be 13 RSA Digit";
                                                                                                    $_SESSION['msg_type'] = "danger";
                                                                                                    echo "<script>location.replace('addClient.php');</script>";
                                                                                                    exit();
                                                                                                  }
                                                                                                }
                                                                                                else
                                                                                                {

                                                                                                  $_SESSION['message'] = "ID Number field is empty";
                                                                                                  $_SESSION['msg_type'] = "danger";
                                                                                                  echo "<script>location.replace('addClient.php');</script>";
                                                                                                  exit();
                                                                                                }

                                                                                          }
                                                                                          else
                                                                                          {

                                                                                            $_SESSION['message'] = "Provine field must be character";
                                                                                            $_SESSION['msg_type'] = "danger";
                                                                                            echo "<script>location.replace('addClient.php');</script>";
                                                                                            exit();
                                                                                          }
                                                                                  }
                                                                                  else
                                                                                  {

                                                                                    $_SESSION['message'] = "province field is empty";
                                                                                    $_SESSION['msg_type'] = "danger";
                                                                                    echo "<script>location.replace('addClient.php');</script>";
                                                                                    exit();
                                                                                  }
                                                                            }
                                                                            else
                                                                            {

                                                                              $_SESSION['message'] = "Email format is invalid";
                                                                              $_SESSION['msg_type'] = "danger";
                                                                              echo "<script>location.replace('addClient.php');</script>";
                                                                              exit();
                                                                            }
                                                                      }
                                                                      else
                                                                      {

                                                                        $_SESSION['message'] = "Email address field is empty";
                                                                        $_SESSION['msg_type'] = "danger";
                                                                        echo "<script>location.replace('addClient.php');</script>";
                                                                        exit();
                                                                      }
                                                                }
                                                                else
                                                                {

                                                                  $_SESSION['message'] = "Cell number doesnot exist";
                                                                  $_SESSION['msg_type'] = "danger";
                                                                  echo "<script>location.replace('addClient.php');</script>";
                                                                  exit();
                                                                }
                                                          }
                                                          else
                                                          {

                                                            $_SESSION['message'] = "Cell number must contain digit only start with 0";
                                                            $_SESSION['msg_type'] = "danger";
                                                            echo "<script>location.replace('addClient.php');</script>";
                                                            exit();
                                                          }
                                                }
                                                else
                                                {

                                                  $_SESSION['message'] = "Cell number field is empty";
                                                  $_SESSION['msg_type'] = "danger";
                                                  echo "<script>location.replace('addClient.php');</script>";
                                                  exit();
                                                }
                                        }
                                        else
                                        {

                                          $_SESSION['message'] = "Address field cannot contain special characters";
                                          $_SESSION['msg_type'] = "danger";
                                          echo "<script>location.replace('addClient.php');</script>";
                                          exit();
                                        }
                                  }
                                  else
                                  {

                                    $_SESSION['message'] = "Address field is empty";
                                    $_SESSION['msg_type'] = "danger";
                                    echo "<script>location.replace('addClient.php');</script>";
                                    exit();
                                  }
                            }
                            else
                            {

                              $_SESSION['message'] = "Surname field must be characters";
                              $_SESSION['msg_type'] = "danger";
                              echo "<script>location.replace('addClient.php');</script>";
                              exit();
                            }
                      }
                      else
                      {

                        $_SESSION['message'] = "Surname field is empty";
                        $_SESSION['msg_type'] = "danger";
                        echo "<script>location.replace('addClient.php');</script>";
                        exit();
                      }
                }
                else
                {

                  $_SESSION['message'] = "Name field must be characters";
                  $_SESSION['msg_type'] = "danger";
                  echo "<script>location.replace('addClient.php');</script>";
                  exit();
                }
        }
        else
        {

          $_SESSION['message'] = "Name field is empty";
          $_SESSION['msg_type'] = "danger";
          echo "<script>location.replace('addClient.php');</script>";
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

  <script>
      //custom select box
      (function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
