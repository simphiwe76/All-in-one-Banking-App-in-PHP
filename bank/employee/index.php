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



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $bankN; ?></title>
  <link href="favicon.png" rel="icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<style media="screen">
  .modal{
  .modal-content.form-wrapper{
    width: 100%;
    height: 470px;
    position: relative;
    background: #f2f3f5;
    .icon-box{
      height: 50px;
      width: 50px;
      background: #007bff;
      color: #f2f3f5;
      margin: 0 auto;
      position: absolute;
      top: -4%;
      left: -2%;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .close-box{
      height: 50px;
      width: 50px;
      background: #f00;
      color: #f2f3f5;
      margin: 0 auto;
      position: absolute;
      top: -4%;
      right: -2%;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      cursor: pointer;
    }
    .btn-info{
      transition: all 500ms;
      background: #007bff;
      color: #fff;
      &:hover{
        background: transparent;
        border-color: #007bff;
        color: #007bff;
      }
    }
    .social-login{
      a{
        transition: all 500ms;
        display: inline-block;
        height: 40px;
        width: 40px;
        margin: 0 auto;
        background: #007bff;
        color: #fff;
        border-radius: 50%;
        margin: 0 auto;
        padding-top: 7px;
        border: 1px solid transparent;
        &.google{
          background: #db4437;
          &:hover{
            border-color: #db4437;
            color: #db4437;
            background: transparent;
          }
        }
        &.facebook{
          background: #4267b2;
          &:hover{
            border-color: #4267b2;
            color: #4267b2;
            background: transparent;
          }
        }
        &.twitter{
          background: #1da1f2;
          &:hover{
            border-color: #1da1f2;
            color: #1da1f2;
            background: transparent;
          }
        }
        &.github{
          background: #24292e;
          &:hover{
            border-color: #24292e;
            color: #24292e;
            background: transparent;
          }
        }
      }
    }
  }
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>



  <section id="about">
    <div class="container">

        <br>

        <div class="container-md">

        <div class="">
            <?php

              if ($bankN == "Fnb")
              {
                echo '<img src="img/Fnb.png" alt="">';
              }
              elseif ($bankN == "Capitec")
              {
                      echo '<img src="img/Capitec.png" alt="">';
              }



            ?>
        </div>

        </div>
        <br>
        <br>
        <br>
        <br>

        <div class="row">
              <div class="col">
                <div class="">
                  <h6><?php echo "Bank name : ".$bankN;   ?></h6>
                  <h6><?php echo "Employee Number : ".$emp_Number;   ?></h6>
                  <h6><?php echo "Employee Name : ".$row['emp_Name'];   ?></h6>
                </div>
              </div>
        </div>
        <br>
        <br>
        <br>

        <br>
<div class="container-md">
  <div class="row">

         <div class="col">

            <a href="#addClent" class="nav-link" data-toggle="modal"><i class="fa fa-plus" style="font-size:40px;"></i></a>
            <h6>ADD CLIENT</h6>
         </div>
         <div class="col">
            <a href="viewClients.php"><i class="fa fa-eye" style="font-size:36px;"></i></a>
              <h6>VIEW CLIENTS</h6>
         </div>

         <div class="col">
                <a href="#update" class="nav-link" data-toggle="modal"><i class="fa fa-pencil" style="font-size:36px;"></i></a>
                <h6>UPDATE PROFILE</h6>

         </div>

  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<a href="logout.php"><i class="fa fa-sign-out" style="font-size:36px;"></i></a>
<h6>LOGOUT</h6>


  </section><!-- #about -->


  <!-- Add client -->
  <div class="modal fade" id="addClent">

    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content form-wrapper">
        <div class="close-box" data-dismiss="modal">
          <i class="fa fa-times fa-2x"></i>
        </div>
        <div class="container-fluid mt-5">

          <form action="addClient.php" method="post" id="LoginForm">
            <div class="form-group text-center">
              <h4>Add client</h4>
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
            <div class="form-group" style="position: relative;">
              <label for="l_email">Name</label>
              <input type="text" id="l_email" class="form-control mb-1" name="Name">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Surname</label>
              <input type="text" id="l_email" class="form-control mb-1" name="Surname">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">ID Number</label>
              <input type="text" id="l_email" class="form-control mb-1" name="idNo">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Address</label>
              <input type="text" id="l_email" class="form-control mb-1" name="Address">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Cell Number</label>
              <input type="text" id="l_email" class="form-control mb-1" name="Phone">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Email</label>
              <input type="text" id="l_email" class="form-control mb-1" name="Email">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Provine</label>
              <div class="form-group" style="width: 291px;">
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
            <div class="modal-footer">
              <button class="btn btn-primary btn-block" name="addCli">Add Client</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- update profile Modal -->
  <div class="modal fade" id="update">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content form-wrapper">
        <div class="close-box" data-dismiss="modal">
          <i class="fa fa-times fa-2x"></i>
        </div>
        <div class="container-fluid mt-5">
          <form action="update.php" method="post" id="LoginForm">
            <div class="form-group text-center">
              <h4>Update</h4>
            </div>
              <div class="form-group" style="position: relative;">
                <label for="l_email">Name</label>
                <input type="text" id="l_email"  class="form-control mb-1" value="<?php echo $row['emp_Name'];  ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Surname</label>
              <input type="text" id="l_email" class="form-control mb-1" value="<?php echo $row['emp_Surname'] ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Address</label>
              <input type="text" id="l_email" class="form-control mb-1" value="<?php echo $row['emp_Address'] ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Email</label>
              <input type="text" id="l_email" class="form-control mb-1" name="email" value="<?php echo $row['emp_Email'] ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Password</label>
              <input type="password" id="l_email" class="form-control mb-1" name="pwd" value="" >
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Confirm password</label>
              <input type="password" id="l_email" class="form-control mb-1" name="pwdC" value="" >
            </div>



            <div class="modal-footer">
              <button class="btn btn-primary btn-block" name="save">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

</body>
</html>
