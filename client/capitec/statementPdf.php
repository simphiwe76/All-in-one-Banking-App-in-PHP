<?php
include_once '../../database/dbConn.php';
session_start();

require('print/fpdf.php');


$id      =  $_SESSION['ID'];
$access  = $_SESSION['userLevel'] ;
$level   =  $_SESSION['status'];
$bankN  = $_SESSION['bank'];
$acc_Num  =  $_SESSION['acc'];


$type = $_GET['type'];


if ($type == "PdfD")
{

                              $datePrint = date('Y-m-d ');
                              $time = date('h:i');

                              $conn = $conn;


                              class myPDF extends FPDF
                              {
                                  function header()
                                  {
                                        $this->Image('img/Fnb.png',10,6);
                                        $this->SetFont('Arial','B',14);
                                        $this->Cell(276,30,'FNB Client Statement',0,0,'C');
                                        $this->Ln();
                                  }
                                  function footer()
                                  {
                                          $this->SetY(-15);
                                          $this->SetFont('Arial','',8);
                                          $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


                                  }
                                  function headerTable($conn,$id)
                                  {
                                        $sql = "SELECT*  FROM client WHERE cli_ID = '$id';";
                                        $result = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_assoc($result);

                                        $this->SetFont('Times','B',14);
                                        $this->Cell(276,25,"Bank Statement",0,0,'C');
                                        $this->SetFont('Times','',14);

                                        $this->Ln();
                                        $this->SetFont('Times','B',12);
                                        $this->Cell(35,10,'Transaction Date',1,0,'C');
                                        $this->Cell(185,10,'Transaction Type',1,0,'C');
                                        $this->Cell(20,10,'Amount',1,0,'C');

                                        $this->Cell(35,10,'Account Number',1,0,'C');

                                        $this->Ln();

                                  }
                                function viewTable($conn,$sql)
                                {

                                        $this->SetFont('Times','',12);
                                        $sql = "SELECT T.trans_Date,T.trans_Type,T.trans_Amount,T.acc_Number FROM transaction T,Account A,Client C  WHERE C.cli_IDNo = '".$_GET['acc']."'
                                         AND A.acc_Number = T.acc_Number AND A.cli_ID = C.cli_ID
        																 AND trans_Date >= DATE('".$_GET['sDate']."') AND trans_Date <= DATE('".$_GET['eDate']."') ORDER BY trans_Date ASC ";
                                        $result = mysqli_query($conn,$sql);


                                        while ($row = mysqli_fetch_assoc($result))
                                        {


                                                $this->SetFont('Times','B',12);
                                                $this->Cell(35,10,$row['trans_Date'],1,0,'C');
                                                $this->Cell(185,10,$row['trans_Type'],1,0,'C');
                                                $this->Cell(20,10,"R".$row['trans_Amount'],1,0,'C');

                                                $this->Cell(35,10,$row['acc_Number'],1,0,'C');

                                                $this->Ln();

                                        }

                                }

                              }
                              $id      =  $_SESSION['ID'];
                              $pdf = new myPDF();
                              $pdf->AliasNbPages();
                              $pdf->AddPage('L','A4',0);
                              $pdf->headerTable($conn,$id);
                              $pdf->viewTable($conn,$sql);

                              $sql = "SELECT*  FROM client WHERE cli_ID = '$id';";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              $clientName = $row['cli_Name'];
                              $pdf->SetFont('Times','',12);
                              $pdf->Text(250, 195, 'Date Printed');
                              $pdf->SetFont('Times','',10);
                              $pdf->Text(250, 200, $datePrint.' '.$time);
                              $pdf->SetFont('Times','',12);
                              $pdf->Text(16, 195, 'Client details');
                              $pdf->SetFont('Times','',10);
                              $pdf->Text(16, 200,$row['cli_Name'].' '.$row['cli_Surname']);
                              ob_end_clean();
                              $pdf->Output();

                              echo "<script>location.replace('index.php');</script>";





}
elseif ($type == "PdfN")
{
  $datePrint = date('Y-m-d ');
  $time = date('h:i');

  $conn = $conn;


  class myPDF extends FPDF
  {
      function header()
      {
            $this->Image('img/Fnb.png',10,6);
            $this->SetFont('Arial','B',14);
            $this->Cell(276,30,'FNB Client Statement',0,0,'C');
            $this->Ln();
      }
      function footer()
      {
              $this->SetY(-15);
              $this->SetFont('Arial','',8);
              $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


      }
      function headerTable($conn,$id)
      {
            $sql = "SELECT*  FROM client WHERE cli_ID = '$id';";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);

            $this->SetFont('Times','B',14);
            $this->Cell(276,25,"Bank Statement",0,0,'C');
            $this->SetFont('Times','',14);

            $this->Ln();
            $this->SetFont('Times','B',12);
            $this->Cell(35,10,'Transaction Date',1,0,'C');
            $this->Cell(185,10,'Transaction Type',1,0,'C');
            $this->Cell(20,10,'Amount',1,0,'C');

            $this->Cell(35,10,'Account Number',1,0,'C');

            $this->Ln();

      }
    function viewTable($conn,$sql)
    {

            $this->SetFont('Times','',12);
            $sql = "SELECT T.trans_Date,T.trans_Type,T.trans_Amount,T.acc_Number FROM transaction T,Account A,Client C WHERE A.acc_Number = T.acc_Number
                    AND A.cli_ID = C.cli_ID AND C.cli_IDNo = '".$_GET['acc']."' ";

            $result = mysqli_query($conn,$sql);

            while ($row = mysqli_fetch_assoc($result))
            {


                    $this->SetFont('Times','B',12);
                    $this->Cell(35,10,$row['trans_Date'],1,0,'C');
                    $this->Cell(185,10,$row['trans_Type'],1,0,'C');
                    $this->Cell(20,10,"R".$row['trans_Amount'],1,0,'C');

                    $this->Cell(35,10,$row['acc_Number'],1,0,'C');

                    $this->Ln();

            }




    }

  }
  $id      =  $_SESSION['ID'];
  $pdf = new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->headerTable($conn,$id);
  $pdf->viewTable($conn,$sql);


  $sql = "SELECT*  FROM client WHERE cli_ID = '$id';";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $clientName = $row['cli_Name'];
  $pdf->SetFont('Times','',12);
  $pdf->Text(250, 195, 'Date Printed');
  $pdf->SetFont('Times','',10);
  $pdf->Text(250, 200, $datePrint.' '.$time);
  $pdf->SetFont('Times','',12);
  $pdf->Text(16, 195, 'Client details');
  $pdf->SetFont('Times','',10);
  $pdf->Text(16, 200,$row['cli_Name'].' '.$row['cli_Surname']);
  $pdf->Text(16, 150, 'Client details');
  ob_end_clean();
  $pdf->Output();

  echo "<script>location.replace('index.php');</script>";

}




?>
