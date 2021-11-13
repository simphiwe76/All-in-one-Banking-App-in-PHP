<?php
include_once '../../database/dbConn.php';
session_start();


$cID = $_GET['id'];
$type = $_GET['type'];
$bankN = $_SESSION['bankn'];
if (isset($cID) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='cliPdf')
{

$datePrint = date('Y-m-d ');
$time = date('h:i');


if ($bankN == "Fnb")
{
  require('print/fpdf.php');
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->Image('img/Fnb.png',16,12);
  $pdf->SetFont('Arial','B',12);
  $pdf->Text(80, 50, 'FNB Client Information');





  $sql = "SELECT br.branch_Code,br.branch_Name,br.branch_Address FROM branch br,bank b WHERE br.bank_ID = b.bank_ID AND b.bank_Name = '$bankN'; ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);


  ///// branch address
  $pdf->SetFont('Times','B',13);
  $pdf->Text(136, 8, 'BRANCH');
$pdf->SetFont('Times','',12);
  $pdf->Text(136, 12, 'Branch Name:     '.$row['branch_Name']);
  $pdf->Text(136, 16, 'Branch Address: '.$row['branch_Address']);
  $pdf->Text(136, 20, 'Branch Code:      '.$row['branch_Code']);


  $sql = "SELECT*  FROM client WHERE cli_ID = '$cID';";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $clientName = $row['cli_Name'];
  /////////////////// client
  $pdf->SetFont('Arial','B',14);
  $pdf->Text(20,74, 'Account holder');
  $pdf->SetFont('Times','',12);
  $pdf->Text(20,80, 'Name:                '.$row['cli_Name']);
  $pdf->Text(20,86, 'Surname:           '.$row['cli_Surname']);
  $pdf->Text(20,92, 'Email Address: '.$row['cli_Address']);
  $pdf->Text(20,98, 'Cell Number:     '.$row['cli_Phone']);
  $pdf->Text(20,104, 'Province:           '.$row['cli_Prov']);
  //////////////////////////////// account info
  $sql = "SELECT*  FROM account WHERE cli_ID = '$cID';";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $pdf->SetFont('Arial','B',14);
  $pdf->Text(20,126, 'Account Information');

  $pdf->SetFont('Times','',12);
  $pdf->Text(20,132, 'Account Number:  '.$row['acc_Number']);
  $pdf->Text(20,138, 'Account Type:       '.$row['acc_Type']);
  $pdf->Text(20,144, 'Account Balance:  '.'R'.$row['acc_Balance']);

/////////// employee
$empID = $_SESSION['ID'];
$sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
  $pdf->SetFont('Times','',12);
  $pdf->Text(146, 280, 'Date Printed');
  $pdf->SetFont('Times','',12);
  $pdf->Text(146, 286, $datePrint.' '.$time);
  $pdf->SetFont('Times','',12);
  $pdf->Text(16, 280, 'Employee');
  $pdf->SetFont('Times','',12);
  $pdf->Text(16, 286,$row['emp_Name'].' '.$row['emp_Surname']);


  $pdf->Output('D',$clientName.'.'.'pdf');
  echo '<script>alert("PDF with client details successfully downloaded")</script>';
  echo "<script>location.replace('viewClients.php');</script>";
  exit();


}
elseif ($bankN == "Capitec")
{

  require('print/fpdf.php');
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->Image('img/Capitec.png',16,12);
  $pdf->SetFont('Arial','B',12);
  $pdf->Text(80, 50, 'CAPITEC Client Information');





  $sql = "SELECT br.branch_Code,br.branch_Name,br.branch_Address FROM branch br,bank b WHERE br.bank_ID = b.bank_ID AND b.bank_Name = '$bankN'; ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);


  ///// branch address
  $pdf->SetFont('Arial','B',14);
  $pdf->Text(136, 8, 'BRANCH');
  $pdf->SetFont('Times','',12);
  $pdf->Text(136, 12, 'Branch Name:     '.$row['branch_Name']);
  $pdf->Text(136, 16, 'Branch Address: '.$row['branch_Address']);
  $pdf->Text(136, 20, 'Branch Code:      '.$row['branch_Code']);


  $sql = "SELECT*  FROM client WHERE cli_ID = '$cID';";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $clientName = $row['cli_Name'];
  /////////////////// client
  $pdf->SetFont('Arial','B',14);

  $pdf->Text(20,74, 'Account holder');
  $pdf->SetFont('Times','',12);
  $pdf->Text(20,80, 'Name:                '.$row['cli_Name']);
  $pdf->Text(20,86, 'Surname:           '.$row['cli_Surname']);
  $pdf->Text(20,92, 'Email Address: '.$row['cli_Address']);
  $pdf->Text(20,98, 'Cell Number:     '.$row['cli_Phone']);
  $pdf->Text(20,104, 'Province:           '.$row['cli_Prov']);
  //////////////////////////////// account info
  $sql = "SELECT*  FROM account WHERE cli_ID = '$cID';";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $pdf->SetFont('Arial','B',14);
  $pdf->Text(20,126, 'Account Information');

  $pdf->SetFont('Times','',12);
  $pdf->Text(20,132, 'Account Number:  '.$row['acc_Number']);
  $pdf->Text(20,138, 'Account Type:       '.$row['acc_Type']);
  $pdf->Text(20,144, 'Account Balance:  '.'R'.$row['acc_Balance']);

/////////// employee
$empID = $_SESSION['ID'];
$sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
  $pdf->SetFont('Times','',12);
  $pdf->Text(146, 280, 'Date Printed');
  $pdf->SetFont('Times','',12);
  $pdf->Text(146, 286, $datePrint.' '.$time);
  $pdf->SetFont('Times','',12);
  $pdf->Text(16, 280, 'Employee');
  $pdf->SetFont('Times','',12);
  $pdf->Text(16, 286,$row['emp_Name'].' '.$row['emp_Surname']);



  $pdf->Output('D',$clientName.'.'.'pdf');

echo '<script>alert("PDF with client details successfully downloaded")</script>';
  echo "<script>location.replace('viewClients.php');</script>";
  exit();


}

}
?>
