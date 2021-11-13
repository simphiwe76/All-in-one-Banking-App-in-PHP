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



if (isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&& isset($_GET['id']))
{

      $sql3 = "SELECT* FROM account WHERE cli_ID = '".$_GET['id']."'";
      $result = mysqli_query($conn,$sql3);
      $check = mysqli_num_rows($result);

      $sql1 = "DELETE FROM client WHERE cli_ID = '".$_GET['id']."'";
      mysqli_query($conn,$sql1);

      $sql2 = "DELETE FROM account WHERE cli_ID = '".$_GET['id']."'";
      mysqli_query($conn,$sql2);

      if ($check > 0)
      {
        $row = mysqli_fetch_assoc($result);
        $acc = $row['acc_Number'];

        $sql = "DELETE FROM transaction WHERE acc_Number = '$acc';";
        mysqli_query($conn,$sql);
      }




      $_SESSION['message'] = "Client was Successfully deteted";
      $_SESSION['msg_type'] = "warning";
      echo "<script>location.replace('viewClient.php');</script>";
      exit();
}



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
    <link href="assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

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
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Manager Employee</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="AddEmp.php">Add Employee</a></li>
                          <li><a  href="viewEmp.php">View Employee</a></li>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="viewClient.php" >
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
            <!--Table-->
            <div class="card-body">
              <h3 class="card-title" my-5 text-center><?php echo "Registered ".strtoupper($bankN)." Clients" ?></h3>

              <blockquote class="blockquote mb-0">
                <form class="" action="viewClient.php" method="post">
                  <div class="input-group">
                <div class="form-outline">
                  <label class="form-label" for="form1">Search</label>
                  <input type="search" name="search" id="form1" class="form-control" />

                </div>
                <br>

                <div class="form-outline">
                  <h4>Order By</h4>
                  <select name="order" class="form-control" style="padding-left: 9px;padding-right: 9px;margin-left: -2px;margin-bottom: 14px;width: 224px;">
                            <option value="">Select</option>
                            <option value="cli_ID">Client ID</option>
                            <option value="cli_Name">Name</option>
                            <option value="cli_Surname">Surname</option>
                            <option value="cli_Email">Email Address</option>
                  </select>
                </div>




                <div class="form-outline">
                  <input type="radio" id="form1" name="sort" value="ASC">
                  <label for="form1">ascending</label><br>
                  <input type="radio" id="form1" name="sort" value="DESC">
                  <label for="form1">descending</label><br>
                </div>
                <button type="submit" name="client_search" class="btn btn-primary">
                <i class="fa fa-search"></i>
                </button>
                </div>
                </form>

              </blockquote>
              <blockquote class="blockquote">
                <?php

                    if (isset($_POST['sort'])&&isset($_POST['client_search'])&&isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes" && isset($_SESSION['bankn']))
                    {
                          $search = $_POST['search'];

                          if (isset($_POST['sort'])&&isset($_POST['order']))
                          {
                            $sort = $_POST['sort'];
                            $order = $_POST['order'];


                            $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                    FROM  client c,bank b,branch br,account a
                                    WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                    AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                    AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%$search%' ORDER BY  ".$order.' '.$sort;

                                    $result = mysqli_query($conn,$sql);
                                    $check = mysqli_num_rows($result);

                                    if ($check>0)
                                    {
                                      echo "<a class='btn btn-warning' href='pdf.php?type=PdfSearch&empID=".$emp_ID."&bankID=".$bank_ID."&search=".$search."&sort=".$sort."&order=".$order."'><span ' class='fa fa-file-pdf-o' style='font-size:24px'></span>PRINT CLIENT PDF</a>";
                                      echo "<a class='btn btn-info' href='csv.php?type=CsvSearch&empID=".$emp_ID."&bankID=".$bank_ID."&search=".$search."&sort=".$sort."&order=".$order."'><span ' class='fa fa-file-excel-o' style='font-size:24px'></span>PRINT CLIENT CSV</a>";
                                    }



                          }
                    }
                    else if(isset($_POST['client_search'])&&isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes" && isset($_SESSION['bankn']))
                    {
                      $search = $_POST['search'];

                      $sql = "select c.cli_ID, c.cli_Name,a.acc_Number, c.cli_Surname,c.cli_Address,c.cli_IDNo ,c.cli_Phone, c.cli_Email,b.bank_Name
                              FROM  client c,bank b,branch br,account a
                              WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                              AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                              AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%$search%';";

                              $result = mysqli_query($conn,$sql);
                              $check = mysqli_num_rows($result);

                              if ($check>0)
                              {

                                        echo "<a class='btn btn-info' href='pdf.php?type=PdfSearchO&empID=".$emp_ID."&bankID=".$bank_ID."&search=".$search."'><span ' class='fa fa-file-pdf-o' style='font-size:24px'></span>PRINT CLIENT PDF</a>";
                                        echo "<a class='btn btn-warning' href='csv.php?type=CsvSearchOnly&empID=".$emp_ID."&bankID=".$bank_ID."&search=".$search."'><span ' class='fa fa-file-excel-o' style='font-size:24px'></span>PRINT CLIENT CSV</a>";
                              }

                    }
                    else
                    {

                      $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                              FROM  client c,bank b,branch br,account a
                              WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                              AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID";
                      $result = mysqli_query($conn,$sql);
                      $check = mysqli_num_rows($result);

                      if ($check>0)
                      {

                      echo "<a class='btn btn-warning' href='pdf.php?type=PdfAll&empID=".$emp_ID."&bankID=".$bank_ID."'><span ' class='fa fa-file-pdf-o' style='font-size:24px'></span>PRINT ALL CLIENTS PDF</a>";
                      echo "<a class='btn btn-info' href='csv.php?type=CsvAll&empID=".$emp_ID."&bankID=".$bank_ID."'><span ' class='fa fa-file-excel-o' style='font-size:24px'></span>PRINT ALL CLIENTS EXCEL</a>";

                    }
                    }


                ?>
              </blockquote>

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


                        <table class="table table-striped w-auto">
                          <tr>

                              <th scope="col">Client ID</th>
                              <th scope="col">Name</th>
                              <th scope="col">Surname</th>
                              <th scope="col">ID Number</th>
                              <th scope="col">Email Address</th>
                              <th scope="col">Cell Number</th>
                              <th scope="col">Account Number</th>
                              <th scope="col">Bank Name</th>
                              <th scope="col">Update</th>
                              <th scope="col">Delete Client</th>

                          </tr>
                          <tbody>
                                <?php

                                if (!empty($_POST['search'])&&isset($_POST['client_search'])&&isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes" && isset($_SESSION['bankn']))
                                {
                                  $search = $_POST['search'];


                                  if (isset($_POST['sort'])&&isset($_POST['order']))
                                  {
                                    $sort = $_POST['sort'];
                                    $order = $_POST['order'];

                                    $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                            FROM  client c,bank b,branch br,account a
                                            WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                            AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                            AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%$search%' ORDER BY  ".$order.' '.$sort;

                                  }
                                  else
                                  {
                                    $sql = "select c.cli_ID, c.cli_Name,a.acc_Number, c.cli_Surname,c.cli_Address,c.cli_IDNo ,c.cli_Phone, c.cli_Email,b.bank_Name
                                            FROM  client c,bank b,branch br,account a
                                            WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                            AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                            AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%$search%';";
                                  }


                                  $result = mysqli_query($conn,$sql);
                                  $check = mysqli_num_rows($result);
                                        if ($check>0)
                                        {
                                                  echo "<script>alert('hello contintinue');</script>";
                                                  while ($row=mysqli_fetch_assoc($result))
                                                  {


                                                          ?>

                                                          <tr>
                                                            <td><?php echo $row['cli_ID']?></td>
                                                            <td><?php echo $row['cli_Name']?></td>
                                                            <td><?php echo $row['cli_Surname']?></td>
                                                            <td><?php echo $row['cli_IDNo']?></td>
                                                            <td><?php echo $row['cli_Email']?></td>
                                                            <td><?php echo $row['cli_Phone']?></td>
                                                            <td><?php echo $row['acc_Number']?></td>
                                                            <td><?php echo strtoupper($row['bank_Name'])?></td>

                                                            <td>
                                                              <?php

                                                                      echo "<a href='viewClient.php?type=update&id=".$row['cli_ID']."'><span ' class='fa fa-pencil-square-o' style='font-size:24px'></span></a>";
                                                              ?>
                                                            </td>
                                                            <td>
                                                              <?php
                                                                    echo "<a href='viewClient.php?type=delete&id=".$row['cli_ID']."'><span ' class='fa fa-trash-o' style='font-size:24px'></span></a>";

                                                              ?>
                                                            </td>
                                                          </tr>

                                                          <?php
                                                  }
                                        }
                                        else
                                        {
                                                  ?>
                                                      <tr>
                                                        <td colspan="9">No record found</td>
                                                      </tr>

                                                  <?php
                                        }
                                }
                                else
                                {
                                  $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                          FROM  client c,bank b,branch br,account a
                                          WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                          AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID";
                                  $result = mysqli_query($conn,$sql);
                                  $check = mysqli_num_rows($result);

                                            while ($row=mysqli_fetch_assoc($result))
                                            {
                                                    ?>

                                                    <tr class="table-info">
                                                      <td><?php echo $row['cli_ID']?></td>
                                                      <td><?php echo $row['cli_Name']?></td>
                                                      <td><?php echo $row['cli_Surname']?></td>
                                                      <td><?php echo $row['cli_IDNo']?></td>
                                                      <td><?php echo $row['cli_Email']?></td>
                                                      <td><?php echo $row['cli_Phone']?></td>
                                                      <td><?php echo $row['acc_Number']?></td>
                                                      <td><?php echo strtoupper($row['bank_Name'])?></td>




                                                      <td>

                                                        <?php
                                                              echo "<a href='UpdateCli.php?type=update&id=".$row['cli_ID']."'><span ' class='fa fa-pencil-square-o' style='font-size:24px'></span></a>";


                                                        ?>
                                                      </td>
                                                      <td>
                                                        <?php
                                                              echo "<a href='viewClient.php?type=delete&id=".$row['cli_ID']."'><span ' class='fa fa-trash-o' style='font-size:24px'></span></a>";

                                                        ?>
                                                      </td>

                                                    </tr>

                                                    <?php
                                            }

                                }







                                 ?>
                          </tbody>
                          </table>

            <h5><?php
                  if ($check > 0)
                  {
                    echo "Number of Clients : ".$check;
                  }
                  else
                  {
                      echo "No Records found ";
                  }


            ?></h5>

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->

      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
	<script src="assets/js/calendar-conf-events.js"></script>

  <script>
      //custom select box

      $(function(){
          $("select.styled").customSelect();
      });

  </script>

  </body>
</html>
