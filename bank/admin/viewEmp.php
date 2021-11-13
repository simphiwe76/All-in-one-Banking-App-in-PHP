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



if(isset($_GET['type']) && isset($_SESSION['ID'])&&$stu  == "yes"&&isset($_GET['id']))
{


	$type = $_GET['type'];

	if($type=='delete')
  {

		$delete_sql="delete from employee where emp_ID = '".$_GET['id']."'";
		mysqli_query($conn,$delete_sql);


		$_SESSION['message'] = "Employee Successfully deleted";
		$_SESSION['msg_type'] = "warning";
    echo "<script>location.replace('viewEmp.php');</script>";
    exit();



    }


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
    <link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/jquery.js"></script>


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
                      <a  class="active" href="viewEmp.php" >
                          <i class="fa fa-desktop"></i>
                          <span>Manager Employee</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="AddEmp.php">Add Employee</a></li>
                          <li><a  href="viewEmp.php">View Employee</a></li>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a  >
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





  <div class="card-body">
    <h3 class="card-title" my-5 text-center><?php echo "Registered ".strtoupper($bankN)." Employees" ?></h3>
    
    <blockquote class="blockquote mb-0">
      <form class="" action="viewEmp.php" method="post">
        <div class="input-group">
      <div class="form-outline">
      <input type="search" name="search" id="form1" class="form-control" />
      <label class="form-label" for="form1">Search</label>
      </div>
      <button type="submit" name="emp_search" class="btn btn-primary">
      <i class="fa fa-search"></i>
      </button>
      </div>
      </form>


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





                              <table class="table table-striped">
                                <tr>
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Employee Number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Bank Name</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete Employee</th>

                                </tr>
                                <tbody>
                                      <?php

                                      if (!empty($_POST['search'])&&isset($_POST['emp_search'])&&isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes" && isset($_SESSION['bankn']))
                                      {
                                              $search = $_POST['search'];


                                              $sql = "select e.emp_ID, e.emp_Name, e.emp_Surname, e.emp_Number,e.emp_Email, e.emp_Address,b.bank_Name
                                                      FROM  bank b,employee e
                                                      WHERE  b.bank_ID = e.bank_ID AND b.bank_Name = '$bankN' AND level <> 3
                                                      AND CONCAT(e.emp_ID, e.emp_Name, e.emp_Surname, e.emp_Number,e.emp_Email) LIKE '%$search%';";
                                              $result = mysqli_query($conn,$sql);
                                              $check = mysqli_num_rows($result);
                                              if ($check>0)
                                              {
                                                        while ($row=mysqli_fetch_assoc($result))
                                                        {


                                                                ?>

                                                                <tr>
                                                                  <td><?php echo $row['emp_ID']?></td>
                                                                  <td><?php echo $row['emp_Number']?></td>
                                                                  <td><?php echo $row['emp_Name']?></td>
                                                                  <td><?php echo $row['emp_Surname']?></td>
                                                                  <td><?php echo $row['emp_Email']?></td>
                                                                  <td><?php echo $row['emp_Address']?></td>
                                                                  <td><?php echo $row['bank_Name']?></td>

                                                                  <td>
                                                                    <?php
                                                                          echo "<a href='UpdateEmp.php?type=update&id=".$row['emp_ID']."'><span ' class='fa fa-pencil-square-o' style='font-size:24px'></span></a>";

                                                                    ?>
                                                                  </td>
                                                                  <td>
                                                                    <?php
                                                                          echo "<a href='viewEmp.php?type=delete&id=".$row['emp_ID']."'><span ' class='fa fa-trash-o' style='font-size:24px'></span></a>";

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
                                        $sql = "select e.emp_ID, e.emp_Name, e.emp_Surname, e.emp_Number,e.emp_Email, e.emp_Address,b.bank_Name
                                                FROM  bank b,employee e
                                                WHERE  b.bank_ID = e.bank_ID AND b.bank_Name = '$bankN' AND level <> 3;";
                                        $result = mysqli_query($conn,$sql);
                                        $check = mysqli_num_rows($result);

                                                  while ($row=mysqli_fetch_assoc($result))
                                                  {
                                                          ?>

                                                          <tr>
                                                            <td><?php echo $row['emp_ID']?></td>
                                                            <td><?php echo $row['emp_Number']?></td>
                                                            <td><?php echo $row['emp_Name']?></td>
                                                            <td><?php echo $row['emp_Surname']?></td>
                                                            <td><?php echo $row['emp_Email']?></td>
                                                            <td><?php echo $row['emp_Address']?></td>
                                                            <td><?php echo $row['bank_Name']?></td>


                                                            <td>
                                                              <?php
                                                                    echo "<a href='UpdateEmp.php?type=update&id=".$row['emp_ID']."'><span ' class='fa fa-pencil-square-o' style='font-size:24px'></span></a>";

                                                              ?>
                                                            </td>
                                                            <td>
                                                              <?php
                                                                    echo "<a href='viewEmp.php?type=delete&id=".$row['emp_ID']."'><span ' class='fa fa-trash-o' style='font-size:24px'></span></a>";

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
                          echo "Number of Employee : ".$check;
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
	<script src="assets/js/fancybox/jquery.fancybox.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>

  <script>
      //custom select box

      $(function(){
          $("select.styled").customSelect();
      });

  </script>

  </body>
</html>
