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




if (isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&& isset($_GET['type'])&&isset($_GET['id']))
{


        $type = $_GET['type'];

        if ($type == 'delete')
        {
          $sql = "DELETE FROM client WHERE cli_ID = '".$_GET['id']."'";
          mysqli_query($conn,$sql);
          $sql = "DELETE FROM account WHERE cli_ID = '".$_GET['id']."'";
          mysqli_query($conn,$sql);

          $sql = "SELECT* FROM Account WHERE cli_ID = '".$_GET['id']."'";
          $result = mysqli_query($conn,$sql);
          $check = mysqli_num_rows($result);

          if ($check == 1)
          {
            $row = mysqli_fetch_assoc($result);
            $acc = $row['acc_Number'];

            $sql = "DELETE FROM transaction WHERE acc_Number = '$acc';";
            mysqli_query($conn,$sql);
          }
        }

      echo '<script>alert("Client was Successfully deteted")</script>';
      echo "<script>location.replace('viewClients.php');</script>";
      exit();
}









?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewpoint" content="width-device-width, initial-scale-1.0">
		<meta http-equiv="X-UA-Compatible" content="ie-edge">
		<title>Client Records</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
	</head>
	<body>


			<div class="container">
							<div class="jumbotron">
							    <a href="index.php" class="btn-default"><span class="fas fa-arrow-circle-left" style='font-size:24px;color:green'> Back</span></a>
								<div class="card">
										<h2 my-5 text-center>Client Records</h2>
								</div>
								<div class="card">
										<div class="card-body">
											<label for="">Download : </label>
											<a href="clientsDataCSV.php" class="btn btn-info"><span class="far fa-file-excel" style='font-size:24px;color:green'></span>CSV FOR ALL CLIENTS</a>
											<a href="clientsPDF.php" class="btn btn-warning"><span class="far fa-file-pdf" style='font-size:24px;color:red'></span>PDF FOR ALL CLIENTS</a>
										</div>
								</div>
								<div class="card">
										<div class="card-body">
													<form class="" action="viewClients.php" method="POST">
														<input  type="text"  name="search" placeholder="Search" />
														<button type="submit" name="client_search" class="btn btn-primary"><i class="fas fa-search"></i>
													</form>
										</div>
								</div>


								<div class="card">
													<div class="card-body">
                            <?php

                              if (isset($_SESSION['message'])): ?>
                              <div class="alert alert-<?=$_SESSION['msg_type']?>">

                                <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                ?>

                            </div>
                          <?php endif ?>
														<table class="table table-striped">
															<tr>
																	<th scope="col">Client ID</th>
																	<th scope="col">Name</th>
																	<th scope="col">Surname</th>
																	<th scope="col">Address</th>
																	<th scope="col">Cell Number</th>
																	<th scope="col">Email</th>
																	<th scope="col">Bank Name</th>
																	<th scope="col">Client PDF</th>
																	<th scope="col">Client Trans CSV</th>
																	<th scope="col">Delete Client</th>

															</tr>
															<tbody>
																		<?php

																		if (!empty($_POST['search'])&&isset($_POST['client_search'])&&isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes" && isset($_SESSION['bankn']))
																		{
																						$search = $_POST['search'];


																						$sql = "select c.cli_ID, c.cli_Name, c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                                    FROM  client c,bank b,branch br,account a
                                                    WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                                    AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                                    AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%$search%'";
																						$result = mysqli_query($conn,$sql);
																						$check = mysqli_num_rows($result);
																						if ($check>0)
																						{
                                                      
																											while ($row=mysqli_fetch_assoc($result))
																											{
																															?>

																															<tr>
																																<td><?php echo $row['cli_ID']?></td>
																																<td><?php echo $row['cli_Name']?></td>
																																<td><?php echo $row['cli_Surname']?></td>
																																<td><?php echo $row['cli_Address']?></td>
																																<td><?php echo $row['cli_Phone']?></td>
																																<td><?php echo $row['cli_Email']?></td>
																																<td><?php echo $row['bank_Name']?></td>
																																<td>
																																	<?php
																																				echo "<a href='clientPDF.php?type=cliPdf&id=".$row['cli_ID']."'><span ' class='far fa-file-pdf ' style='font-size:24px;color:red'></span></a>";

																																	?>
																																</td>
																																<td>
																																	<?php
																																				echo "<a href='clientCSV.php?type=cliCSV&id=".$row['cli_ID']."'><span ' class='far fa-file-excel' style='font-size:24px;color:green'></span></a>";

																																	?>
																																</td>
																																<td>
																																	<?php
																																				echo "<a href='viewClients.php?type=delete&id=".$row['cli_ID']."'><span ' class='fas fa-trash-alt' style='font-size:24px'></span></a>";

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
																			$sql = "select c.cli_ID, c.cli_Name, c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                              FROM  client c,bank b,branch br,account a
                                              WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                              AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID";
																			$result = mysqli_query($conn,$sql);
																			$check = mysqli_num_rows($result);

																								while ($row=mysqli_fetch_assoc($result))
																								{
																												?>

																												<tr>
																													<td><?php echo $row['cli_ID']?></td>
																													<td><?php echo $row['cli_Name']?></td>
																													<td><?php echo $row['cli_Surname']?></td>
																													<td><?php echo $row['cli_Address']?></td>
																													<td><?php echo $row['cli_Phone']?></td>
																													<td><?php echo $row['cli_Email']?></td>
																													<td><?php echo $row['bank_Name']?></td>
																													<td>
																														<?php
																																	echo "<a href='clientPDF.php?type=cliPdf&id=".$row['cli_ID']."'><span ' class='far fa-file-pdf ' style='font-size:24px;color:red'></span></a>";

																														?>
																													</td>
																													<td>
																														<?php
																																	echo "<a href='clientCSV.php?type=cliCSV&id=".$row['cli_ID']."'><span ' class='far fa-file-excel' style='font-size:24px;color:green'></span></a>";

																														?>
																													</td>
																													<td>
																														<?php
																																	echo "<a href='viewClients.php?type=delete&id=".$row['cli_ID']."'><span ' class='fas fa-trash-alt' style='font-size:24px'></span></a>";

																														?>
																													</td>
																												</tr>

																												<?php
																								}

																		}







																		 ?>
															</tbody>
															</table>
													</div>
								</div>
							</div>
			</div>





			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	</body>
</html>
