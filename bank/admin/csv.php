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

$type = $_GET['type'];


if (isset($type) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='CsvSearch')
{

  $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
          FROM  client c,bank b,branch br,account a
          WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
          AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
          AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%".$_GET['search']."%' ORDER BY  ".$_GET['order'].' '.$_GET['sort'];
            $result = mysqli_query($conn,$sql);
            $check = mysqli_num_rows($result);



            if($check>0)
            {
            $delimiter = ",";
            $filename = "Client_" . date('Y-m-d') . ".csv";

            // Create a file pointer
            $f = fopen('php://memory', 'w');

            // Set column headers
            $fields = array('Client ID','Name','Surname','Email Address','Address'	,'Cell Number'	,'Bank Name');
            fputcsv($f, $fields, $delimiter);

            // Output each row of the data, format line as csv and write to file pointer
            while($row = mysqli_fetch_assoc($result))
            {

                $lineData = array($row['cli_ID'], $row['cli_Name'], $row['cli_Surname'], $row['cli_Address'], $row['cli_Phone'], $row['cli_Email'], $row['bank_Name']);
                fputcsv($f, $lineData, $delimiter);
            }

            // Move back to beginning of file
            fseek($f, 0);

            // Set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            //output all remaining data on a file pointer
            fpassthru($f);
          }
          exit;


}
elseif (isset($type) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='CsvSearchOnly')
{

  $sql = "select c.cli_ID, c.cli_Name,a.acc_Number, c.cli_Surname,c.cli_Address,c.cli_IDNo ,c.cli_Phone, c.cli_Email,b.bank_Name
          FROM  client c,bank b,branch br,account a
          WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
          AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
          AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%".$_GET['search']."%';";
  $result = mysqli_query($conn,$sql);
  $check = mysqli_num_rows($result);


  if($check>0)
  {
  $delimiter = ",";
  $filename = "Client_" . date('Y-m-d') . ".csv";

  // Create a file pointer
  $f = fopen('php://memory', 'w');

  // Set column headers
  $fields = array('Client ID','Name','Surname','Email Address','Address'	,'Cell Number'	,'Bank Name');
  fputcsv($f, $fields, $delimiter);

  // Output each row of the data, format line as csv and write to file pointer
  while($row = mysqli_fetch_assoc($result))
  {

      $lineData = array($row['cli_ID'], $row['cli_Name'], $row['cli_Surname'], $row['cli_Address'], $row['cli_Phone'], $row['cli_Email'], $row['bank_Name']);
      fputcsv($f, $lineData, $delimiter);
  }

  // Move back to beginning of file
  fseek($f, 0);

  // Set headers to download file rather than displayed
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '";');

  //output all remaining data on a file pointer
  fpassthru($f);
}
exit;

}
elseif (isset($type) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='CsvAll')
{


  $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
          FROM  client c,bank b,branch br,account a
          WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
          AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID";

  $result = mysqli_query($conn,$sql);
  $check = mysqli_num_rows($result);


  if($check>0)
  {
  $delimiter = ",";
  $filename = "Client_" . date('Y-m-d') . ".csv";

  // Create a file pointer
  $f = fopen('php://memory', 'w');

  // Set column headers
  $fields = array('Client ID','Name','Surname','Email Address','Address'	,'Cell Number'	,'Bank Name');
  fputcsv($f, $fields, $delimiter);

  // Output each row of the data, format line as csv and write to file pointer
  while($row = mysqli_fetch_assoc($result))
  {

      $lineData = array($row['cli_ID'], $row['cli_Name'], $row['cli_Surname'], $row['cli_Address'], $row['cli_Phone'], $row['cli_Email'], $row['bank_Name']);
      fputcsv($f, $lineData, $delimiter);
  }

  // Move back to beginning of file
  fseek($f, 0);

  // Set headers to download file rather than displayed
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '";');

  //output all remaining data on a file pointer
  fpassthru($f);
}
exit;



}
