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



if (isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='cliCSV')
{
            header('Coontent-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment;filename=clientTransaction.csv');
            $output = fopen("php://output","W");
            fputcsv($output,array('Transaction Type','Transaction Amount','Account Number','Transaction Date'));


            $sql = "SELECT t.trans_Type,t.trans_Amount,t.acc_Number,t.trans_Date
                    FROM  account a,transaction t
            				WHERE t.acc_Number = a.acc_Number AND a.cli_ID = '".$_GET['id']."' ";
            $result = mysqli_query($conn,$sql);
            $check = mysqli_num_rows($result);

            if ($check>0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                    fputcsv($output,$row);

              }
              fclose($output);

            }


}
