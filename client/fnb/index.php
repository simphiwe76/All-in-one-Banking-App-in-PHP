<?php

include_once '../../database/dbConn.php';
session_start();

$ID = $_SESSION['ID'];
$sql = "SELECT C.cli_Name,C.cli_Surname,C.cli_Address,C.cli_Phone,C.cli_Email,A.acc_Number,A.acc_Type,A.acc_Date,A.acc_Balance
        FROM client C ,account A WHERE C.cli_ID = '$ID' AND  C.cli_ID = A.cli_ID;";
$results = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($results);

$name = $row['cli_Name'];
$surname = $row['cli_Surname'];
$address = $row['cli_Address'];
$mobile = $row['cli_Phone'];
$email = $row['cli_Email'];
$acc = $row['acc_Number'];
$acc_type = $row['acc_Type'];
$balance = "R".$row['acc_Balance'];
$acc_date = $row['acc_Date'];
$bankN = $_SESSION['bank'];

$names = $name." ".$surname;
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $bankN; ?></title>
  <link href="img/favicon.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

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




      <div class="container">



        <div class="row about-cols">

          <div class="col-md-4 wow fadeInUp">
            <div class="about-col">
              <div class="img">
                <img src="img/icon/pay.jpg" alt="" class="img-fluid">
                <div class="icon">
                  <a href="#payment" class="nav-link" data-toggle="modal"><i class="ion-social-usd"></i></a>
                </div>
              </div>




              <p>
                PAYMENT
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="img/icon/buy.jpg" alt="" class="img-fluid">
                <div class="icon">
                  <a href="#Buy" class="nav-link" data-toggle="modal"><i class="ion-ios-cart"></i></a>
                </div>
              </div>

              <p>
                BUY


              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="img/icon/bal.jpg" alt="" class="img-fluid">
                <div class="icon">
                  <a href="#Balance" class="nav-link" data-toggle="modal"><i class="ion-ios-paper-outline"></i></a>
                </div>
              </div>

              <p>
                VIEW BALANCE


              </p>
            </div>
          </div>
            <br>
            <br>
            <br>
            <br>
            <br>


          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="img/icon/viewS.jpg" alt="" class="img-fluid">
                <div class="icon">

                  <a href="statement.php"><i class="ion-eye" style="font-size:36px;"></i></a>
                </div>
              </div>

              <p>
                VIEW STATEMENT


              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="img/icon/update.png" alt="" class="img-fluid">
                <div class="icon">
                  <a href="#update" class="nav-link" data-toggle="modal"><i class="ion-ios-compose-outline"></i></a>
                </div>
              </div>

              <p>
                UPDATE PROFILE


              </p>
            </div>
          </div>
        </div>
        <br>
        <br>


        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
          <div class="about-col">
            <div class="img">
              <img src="img/icon/logout.jpg" alt="" class="img-fluid">
              <div class="icon">
                <a href="logout.php"><i class="ion-android-exit" style="font-size:36px;"></i></a>

              </div>
            </div>

            <p>
              LOGOUT


            </p>
          </div>
        </div>

      </div>




</section><!-- #about -->



  <!-- Balance Modal -->
  <div class="modal fade" id="Balance">
    <div class="modal-dialog mw-100 w-75 modal-dialog-centered" role="document">
      <div class="modal-content form-wrapper">


        <div class="container-fluid mt-20">

          <div class="card">
            <div class="card-body">

              <?php
                    $IDNUM = $_SESSION['idNum'];
                    $sql = "SELECT A.acc_Number,A.acc_Type,A.acc_Balance,.B.bank_Name
                            FROM client C ,bank B ,branch BR,account A
                            WHERE C.cli_IDNo = '$IDNUM' AND C.cli_ID = A.cli_ID
                            AND BR.bank_ID = B.bank_ID AND A.branch_ID = BR.branch_ID";

                    $results = mysqli_query($conn,$sql);
              ?>
              <table class="table table-dark">
                <div class="card">
                  <div class="card-body">
                    <h6 class="modal-title"><?php echo "Account Holder : ".$row['cli_Name']." ".$row['cli_Surname']; ?></h6>

                  </div>

                </div>
                  <thead>
                  <tr>
                  <th scope="col"></th>
                  <th scope="col">Account Number</th>
                  <th scope="col">Account Type</th>
                  <th scope="col">Account Balance</th>
                  <th scope="col">Bank Name</th>
                  </tr>
                  </thead>

                  <?php
                        if ($results)
                        {
                            foreach ($results as $row)
                            {
                    ?>
                  <tbody>
                  <tr>
                  <th scope="row"><?php

                  $bankN = $row['bank_Name'];
                  if ($bankN == "Fnb")
                  {
                    echo '<img src="img/Fnb.png"   alt="">';
                  }
                  elseif ($bankN == "Capitec")
                  {
                          echo '<img src="img/Capitec.png" alt="">';
                  }
                  ?></th>
                  <td><?php echo $row['acc_Number']; ?></td>
                  <td><?php echo strtoupper($row['acc_Type']); ?></td>
                  <td><?php echo "R".$row['acc_Balance']; ?></td>
                  <td><?php echo strtoupper($row['bank_Name']); ?></td>
                  </tr>
                  </tbody>
                  <?php
                            }
                        }

                  ?>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <!-- Make payment Modal -->
  <div class="modal fade" id="payment">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content form-wrapper">
        <div class="close-box" data-dismiss="modal">
          <i class="fa fa-times fa-2x"></i>
        </div>
        <div class="container-fluid mt-5">
          <?php

            if ($bankN == "Fnb")
            {
              echo '<img  src="img/pay.jpg" style="margin-top: -30px;width: 316px;margin-right: -34px;padding: 0px;padding-right: -21px;padding-left: -1px;margin-left: 58px;margin-bottom: 51px;height: 164px;">';
            }
            elseif ($bankN == "Capitec")
            {
                  echo '<img  src="img/pay.jpg" style="margin-top: -30px;width: 316px;margin-right: -34px;padding: 0px;padding-right: -21px;padding-left: -1px;margin-left: 58px;margin-bottom: 51px;height: 164px;">';
            }
          ?>
          <form action="payment.php" method="post" id="LoginForm">
            <div class="form-group text-center">
              <h4>Payment</h4>

            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Account Number</label>
              <input type="text" id="l_email" class="form-control mb-1" value="" name="acc_Num">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Bank Account</label>
              <div class="form-group" style="width: 291px;">
                <select name="chooseBn" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                          <option value="">Select</option>
                          <?php
                                $IDNUM = $_SESSION['idNum'];
                                $sql = "SELECT A.acc_Number,A.acc_Type,A.acc_Balance,.B.bank_Name
                                        FROM client C ,bank B ,branch BR,account A
                                        WHERE C.cli_IDNo = '$IDNUM' AND C.cli_ID = A.cli_ID
                                        AND BR.bank_ID = B.bank_ID AND A.branch_ID = BR.branch_ID";

                                $results = mysqli_query($conn,$sql);

                                if ($results)
                                {
                                  foreach ($results as $row)
                                  {
                                          $bname = $row['bank_Name'];
                                          $n = strtoupper($bname);
                                          echo "<option value='$bname'>$n</option>";
                                  }
                                }
                          ?>

                </select>
              </div>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Account Type</label>
              <div class="form-group" style="width: 291px;">
                <select name="choose" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                          <option value="">Select</option>
                          <option value="Saving">SAVINGS</option>
                          <option value="Debit">DEBIT</option>
                </select>
              </div>
            </div>

            <div class="form-group" style="position: relative;">
              <label for="l_email">Amount</label>
              <input type="amount" id="l_email" class="form-control mb-1" name="amount">
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary btn-block" name="payment">Pay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Make Buy Modal -->
  <div class="modal fade" id="Buy">

    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content form-wrapper">
        <div class="close-box" data-dismiss="modal">
          <i class="fa fa-times fa-2x"></i>
        </div>
        <div class="container-fluid mt-5">
          <?php

            if ($bankN == "Fnb")
            {
              echo '<img  src="img/buyAirtime.jpg" style="margin-top: -30px;width: 316px;margin-right: -34px;padding: 0px;padding-right: -21px;padding-left: -1px;margin-left: 58px;margin-bottom: 51px;height: 164px;">';
            }
            elseif ($bankN == "Capitec")
            {
                  echo '<img  src="img/buyAirtime.jpg" style="margin-top: -30px;width: 316px;margin-right: -34px;padding: 0px;padding-right: -21px;padding-left: -1px;margin-left: 58px;margin-bottom: 51px;height: 164px;">';
            }


          ?>
          <form action="Buy.php" method="post" id="LoginForm">
            <div class="form-group text-center">
              <h4>Buy</h4>

            </div>

            <div class="form-group" style="position: relative;">
              <label for="l_email">Airtime</label>
              <div class="form-group" style="width: 291px;">
                <select name="choose" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                          <option value="">Select Network</option>
                          <option value="VODACOM">VODACOM</option>
                          <option value="MTN">MTN</option>
                          <option value="CELLC">CELLC</option>
                          <option value="TELKOM">TELKOM</option>
                </select>

              </div>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Bank Account</label>
              <div class="form-group" style="width: 291px;">
                <select name="chooseBn" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                          <option value="">Select</option>
                          <?php
                                $IDNUM = $_SESSION['idNum'];
                                $sql = "SELECT A.acc_Number,A.acc_Type,A.acc_Balance,.B.bank_Name
                                        FROM client C ,bank B ,branch BR,account A
                                        WHERE C.cli_IDNo = '$IDNUM' AND C.cli_ID = A.cli_ID
                                        AND BR.bank_ID = B.bank_ID AND A.branch_ID = BR.branch_ID";

                                $results = mysqli_query($conn,$sql);

                                if ($results)
                                {
                                  foreach ($results as $row)
                                  {
                                          $bname = $row['bank_Name'];
                                          $n = strtoupper($bname);
                                          echo "<option value='$bname'>$n</option>";
                                  }
                                }
                          ?>

                </select>
              </div>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Cell Number</label>
              <input type="text" id="l_email" class="form-control mb-1" name="cellNo">
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Amount</label>
              <input type="text" id="l_email" class="form-control mb-1" name="amount">
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary btn-block" name="Buy">Buy</button>
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
                <input type="text" id="l_email" class="form-control mb-1" value="<?php echo $name; ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Surname</label>
              <input type="text" id="l_email" class="form-control mb-1" value="<?php echo $surname; ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Address</label>
              <input type="text" id="l_email" class="form-control mb-1" value="<?php echo $address; ?>" readonly>
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Email</label>
              <input type="text" id="l_email" class="form-control mb-1" name="email" value="<?php echo $email; ?>" >
            </div>
            <div class="form-group" style="position: relative;">
              <label for="l_email">Cell number</label>
              <input type="text" id="l_email" class="form-control mb-1" name="cellNo" value="<?php echo $mobile; ?>" >
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
<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="js/main.js"></script>
</body>
</html>
