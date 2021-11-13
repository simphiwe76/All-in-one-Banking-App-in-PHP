<?php
include_once '../../database/dbConn.php';
session_start();


$id      =  $_SESSION['ID'];
$access  = $_SESSION['userLevel'] ;
$level   =  $_SESSION['status'];
$bankN  = $_SESSION['bank'];
$acc_Num  =  $_SESSION['acc'];
$IDNUM = $_SESSION['idNum'];

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
<!-- Bootstrap CSS File -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Libraries CSS Files -->
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
	</head>
	<body>


			<div class="container">
				<a href="index.php"><i class="ion-android-arrow-back" style="font-size:36px;"></i></a>

								<div class="card">
										<h2 my-5 text-center>Statement</h2>
								</div>

								<div class="card">
										<div class="card-body">
													<form class="" action="viewStatement.php" method="POST">
													<div class="card-body">
														<label for="">Start Date :</label>
														<input  type="date"  name="startD" >
													</div>
													<div class="card-body">
														<label for="">End Date :</label>
														<input  type="date"  name="endD" >
													</div>

													<button type="submit" name="statement" class="btn btn-primary">View Statement<i class=""></i>
													</form>
										</div>
								</div>
								<blockquote class="blockquote">
								<div class="card">
									<div class="card-body">



								<?php


											if (isset($_POST['statement']))
											{
															if (!empty($_POST['startD'])&&!empty($_POST['endD']))
															{
																$sDate = $_POST['startD'];
																$eDate = $_POST['endD'];

																$sql = "SELECT T.trans_Date,T.trans_Type,T.trans_Amount,T.acc_Number FROM transaction T,Account A,Client C WHERE A.acc_Number = T.acc_Number
																				AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '$IDNUM'
																			 AND trans_Date >= DATE('$sDate') AND trans_Date <= DATE('$eDate')";

																$result = mysqli_query($conn,$sql);
																$check = mysqli_num_rows($result);

																if ($check>0)
																{
																	echo "<a class='btn btn-info' href='statementPdf.php?type=PdfD&sDate=".$sDate."&eDate=".$eDate."&acc=".$IDNUM."'><span ' class='fa fa-file-pdf-o' style='font-size:24px'></span>PRINT PDF</a>";

																}

															}
											}
											else
											{
												$sql = "SELECT T.trans_Date,T.trans_Type,T.trans_Amount,T.acc_Number FROM transaction T,Account A,Client C  WHERE A.acc_Number = T.acc_Number
																AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '$IDNUM' ";

												$result = mysqli_query($conn,$sql);
												$check = mysqli_num_rows($result);


													if ($check>0)
													{
														echo "<a class='btn btn-warning' href='statementPdf.php?type=PdfN&acc=".$IDNUM."'><span ' class='fa fa-file-pdf-o' style='font-size:24px'></span>PRINT PDF</a>";

													}

											}



								?>
								</div>
								</div>
								</blockquote>
								<div class="table-responsive text-nowrap">
									<!--Table-->
									<table class="table table-striped">

										<!--Table head-->
										<thead>
											<tr>
												<th>Transation Date</th>
												<th>Description</th>
												<th>Transation Amount</th>
												<th>Account Number</th>

											</tr>
										</thead>
										<!--Table head-->

										<!--Table body-->

										<tbody>
											<?php


											if (isset($_POST['statement'])&&isset($_SESSION['ID'])&&$_SESSION['userLevel'] == "yes" && isset($_SESSION['bank']))
											{



												if (!empty($_POST['startD'])&&!empty($_POST['endD']))
												{
													$sDate = $_POST['startD'];
													$eDate = $_POST['endD'];
													$currentD = date('Y-m-d');

													if ($sDate>$eDate || $sDate > $currentD)
													{
														echo '<script>alert("Start  date cannot be greater then end date")</script>';
														echo "<script>location.replace('viewStatement.php');</script>";
														exit();
													}
													else
													{
														$sql = "SELECT T.trans_Date,T.trans_Type,T.trans_Amount,T.acc_Number FROM transaction T,Account A,Client C  WHERE A.acc_Number = T.acc_Number
																		AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '$IDNUM'
																	 AND trans_Date >= DATE('$sDate') AND trans_Date <= DATE('$eDate')";

														$result = mysqli_query($conn,$sql);
														$check = mysqli_num_rows($result);
													}


												}
												else
												{
													echo '<script>alert("Select Start date and End date first for Statement")</script>';
													echo "<script>location.replace('viewStatement.php');</script>";
													exit();
												}



															if ($check>0)
															{

																				while ($row=mysqli_fetch_assoc($result))
																				{

											?>
											<tr>
												<td><?php echo $row['trans_Date']; ?> </td>
												<td><?php echo $row['trans_Type']; ?> </td>
												<td><?php echo "R".$row['trans_Amount']; ?> </td>
												<td><?php echo $row['acc_Number']; ?> </td>
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

									$sql = "SELECT T.trans_Date,T.trans_Type,T.trans_Amount,T.acc_Number FROM transaction T,Account A,Client C WHERE A.acc_Number = T.acc_Number
													AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '$IDNUM' ";

									$result = mysqli_query($conn,$sql);
									$check = mysqli_num_rows($result);


																		if ($check>0)
																		{

																							while ($row=mysqli_fetch_assoc($result))
																							{

														?>
														<tr>
															<td><?php echo $row['trans_Date']; ?> </td>
															<td><?php echo $row['trans_Type']; ?> </td>
															<td><?php echo "R".$row['trans_Amount']; ?> </td>
															<td><?php echo $row['acc_Number']; ?> </td>
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
											?>
										</tbody>
										<!--Table body-->


									</table>
									<h5><?php
			                  if (!empty($_POST['startD'])&&!empty($_POST['endD']))
			                  {

													if ($check > 0)
													{
															echo "Number of Transaction : ".$check;
													}

			                  }
												elseif ($check > 0)
												{
														echo "Number of Transaction : ".$check;
												}
			                  else
			                  {
			                      echo "No Records found ";
			                  }


			            ?></h5>
									<!--Table-->
								</div>
					</section>

			</div>






			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	</body>
</html>
