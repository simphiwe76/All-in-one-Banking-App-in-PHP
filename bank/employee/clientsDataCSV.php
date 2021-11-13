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






if (isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes" && isset($_SESSION['bankn']))
{
            header('Coontent-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment;filename=clientsCSV.csv');
            $output = fopen("php://output","W");
            fputcsv($output,array('Name','Surname','Address','Phone Number','Email','Bank Name'));

            $sql = "select  c.cli_Name, c.cli_Surname,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
            				FROM  client c,bank b,branch br,account a,employee e
            				WHERE e.emp_ID = '$emp_ID' AND b.bank_ID = '$bank_ID' AND br.bank_ID= b.bank_ID
            				AND br.branch_ID = a.branch_ID AND a.cli_ID = c.cli_ID";
            $result = mysqli_query($conn,$sql);

            while ($row = mysqli_fetch_assoc($result))
            {
                  fputcsv($output,$row);

            }

            fclose($output);





}






?>
