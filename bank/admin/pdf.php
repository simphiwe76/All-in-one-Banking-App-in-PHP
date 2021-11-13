<?php

include_once '../../database/dbConn.php';
session_start();
require('print/fpdf.php');

$conn = $conn;
$emp_ID      = $_SESSION['ID'] ;
$emp_Number  = $_SESSION['empNum'];
$bank_ID     = $_SESSION['bankId'];
$level       = $_SESSION['access'];
$stu         = $_SESSION['stutus'] ;
$braID      = $_SESSION['branchId'];
$bankN       = $_SESSION['bankn'];

$type = $_GET['type'];

if (isset($type) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='PdfSearch')
{

    $bankN = $_SESSION['bankn'];
    $datePrint = date('Y-m-d ');
    $time = date('h:i');


    if ($bankN == "Fnb")
    {

      class myPDF extends FPDF
      {
          function header()
          {
                $this->Image('img/Fnb.png',10,6);
                $this->SetFont('Arial','B',14);
                $this->Cell(276,30,'FNB Client Information',0,0,'C');
                $this->Ln();

          }
          function footer()
          {
                  $this->SetY(-15);
                  $this->SetFont('Arial','',8);
                  $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


          }
          function headerTable()
          {


                $this->SetFont('Times','B',12);
                $this->Cell(35,10,'Client ID',1,0,'C');
                $this->Cell(40,10,'Name',1,0,'C');
                $this->Cell(40,10,'Surname',1,0,'C');
                $this->Cell(70,10,'Email Address',1,0,'C');
                $this->Cell(40,10,'Cell Number',1,0,'C');
                $this->Cell(40,10,'Bank Name',1,0,'C');

                $this->Ln();

          }
        function viewTable($conn,$emp_ID,$bank_ID)
        {

                $this->SetFont('Times','',12);

                        $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                FROM  client c,bank b,branch br,account a
                                WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%".$_GET['search']."%' ORDER BY  ".$_GET['order'].' '.$_GET['sort'];

                $result = mysqli_query($conn,$sql);
                $check = mysqli_num_rows($result);


                if ($check>0)
                {
                  while ($row = mysqli_fetch_assoc($result))
                  {
                          $this->SetFont('Times','B',12);
                          $this->Cell(35,10,$row['cli_ID'],1,0,'C');
                          $this->Cell(40,10,$row['cli_Name'],1,0,'C');
                          $this->Cell(40,10,$row['cli_Surname'],1,0,'C');
                          $this->Cell(70,10,$row['cli_Email'],1,0,'C');
                          $this->Cell(40,10,$row['cli_Phone'],1,0,'C');
                          $this->Cell(40,10,strtoupper($row['bank_Name']),1,0,'C');

                          $this->Ln();

                  }
                }





        }

      }

      $pdf = new myPDF();
      $pdf->AliasNbPages();
      $pdf->AddPage('L','A4',0);
      $pdf->headerTable();
      $pdf->viewTable($conn,$emp_ID,$bank_ID);

      $empID = $_SESSION['ID'];
      $sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $pdf->SetFont('Times','',12);
      $pdf->Text(250, 195, 'Date Printed');
      $pdf->SetFont('Times','',10);
      $pdf->Text(250, 200, $datePrint.' '.$time);
      $pdf->SetFont('Times','',12);
      $pdf->Text(16, 195, 'Employee');
      $pdf->SetFont('Times','',10);
      $pdf->Text(16, 200,$row['emp_Name'].' '.$row['emp_Surname']);
      $pdf->Output('D','clients.pdf');



    }
    else if($bankN == "Capitec")
    {
                class myPDF extends FPDF
                {
                    function header()
                    {
                          $this->Image('img/Capitec.png',10,6);
                          $this->SetFont('Arial','B',14);
                          $this->Cell(276,30,'CAPITEC Client Information',0,0,'C');
                          $this->Ln();




                    }
                    function footer()
                    {
                            $this->SetY(-15);
                            $this->SetFont('Arial','',8);
                            $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


                    }
                    function headerTable()
                    {
                      $this->SetFont('Times','B',12);
                      $this->Cell(35,10,'Client ID',1,0,'C');
                      $this->Cell(40,10,'Name',1,0,'C');
                      $this->Cell(40,10,'Surname',1,0,'C');
                      $this->Cell(70,10,'Email Address',1,0,'C');
                      $this->Cell(40,10,'Cell Number',1,0,'C');
                      $this->Cell(40,10,'Bank Name',1,0,'C');

                          $this->Ln();

                    }
                  function viewTable($conn,$emp_ID,$bank_ID)
                  {

                          $this->SetFont('Times','',12);
                          $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                  FROM  client c,bank b,branch br,account a
                                  WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                  AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                  AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%".$_GET['search']."%' ORDER BY  ".$_GET['order'].' '.$_GET['sort'];

                  $result = mysqli_query($conn,$sql);
                  $check = mysqli_num_rows($result);


                  if ($check>0)
                  {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                            $this->SetFont('Times','B',12);
                            $this->Cell(35,10,$row['cli_ID'],1,0,'C');
                            $this->Cell(40,10,$row['cli_Name'],1,0,'C');
                            $this->Cell(40,10,$row['cli_Surname'],1,0,'C');
                            $this->Cell(70,10,$row['cli_Email'],1,0,'C');
                            $this->Cell(40,10,$row['cli_Phone'],1,0,'C');
                            $this->Cell(40,10,strtoupper($row['bank_Name']),1,0,'C');

                            $this->Ln();

                    }
                  }

                  }

                }

                $pdf = new myPDF();
                $pdf->AliasNbPages();
                $pdf->AddPage('L','A4',0);
                $pdf->headerTable();
                $pdf->viewTable($conn,$emp_ID,$bank_ID);

                $empID = $_SESSION['ID'];
                $sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);
                $pdf->SetFont('Times','',12);
                $pdf->Text(250, 195, 'Date Printed');
                $pdf->SetFont('Times','',10);
                $pdf->Text(250, 200, $datePrint.' '.$time);
                $pdf->SetFont('Times','',12);
                $pdf->Text(16, 195, 'Employee');
                $pdf->SetFont('Times','',10);
                $pdf->Text(16, 200,$row['emp_Name'].' '.$row['emp_Surname']);
                $pdf->Output('D','clients.pdf');




    }


}
elseif (isset($type) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='PdfSearchO')
{
  $bankN = $_SESSION['bankn'];
  $datePrint = date('Y-m-d ');
  $time = date('h:i');


  if ($bankN == "Fnb")
  {

    class myPDF extends FPDF
    {
        function header()
        {
              $this->Image('img/Fnb.png',10,6);
              $this->SetFont('Arial','B',14);
              $this->Cell(276,30,'FNB Client Information',0,0,'C');
              $this->Ln();




        }
        function footer()
        {
                $this->SetY(-15);
                $this->SetFont('Arial','',8);
                $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


        }
        function headerTable()
        {


              $this->SetFont('Times','B',12);
              $this->Cell(35,10,'Client ID',1,0,'C');
              $this->Cell(40,10,'Name',1,0,'C');
              $this->Cell(40,10,'Surname',1,0,'C');
              $this->Cell(70,10,'Email Address',1,0,'C');
              $this->Cell(40,10,'Cell Number',1,0,'C');
              $this->Cell(40,10,'Bank Name',1,0,'C');

              $this->Ln();

        }
      function viewTable($conn,$emp_ID,$bank_ID)
      {

              $this->SetFont('Times','',12);
              $sql = "select c.cli_ID, c.cli_Name,a.acc_Number, c.cli_Surname,c.cli_Address,c.cli_IDNo ,c.cli_Phone, c.cli_Email,b.bank_Name
                      FROM  client c,bank b,branch br,account a
                      WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                      AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                      AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%".$_GET['search']."%';";
              $result = mysqli_query($conn,$sql);
              $check = mysqli_num_rows($result);

              if ($check>0)
              {
                while ($row = mysqli_fetch_assoc($result))
                {
                        $this->SetFont('Times','B',12);
                        $this->Cell(35,10,$row['cli_ID'],1,0,'C');
                        $this->Cell(40,10,$row['cli_Name'],1,0,'C');
                        $this->Cell(40,10,$row['cli_Surname'],1,0,'C');
                        $this->Cell(70,10,$row['cli_Email'],1,0,'C');
                        $this->Cell(40,10,$row['cli_Phone'],1,0,'C');
                        $this->Cell(40,10,strtoupper($row['bank_Name']),1,0,'C');

                        $this->Ln();

                }
              }







      }

    }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable($conn,$emp_ID,$bank_ID);

    $empID = $_SESSION['ID'];
    $sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $pdf->SetFont('Times','',12);
    $pdf->Text(250, 195, 'Date Printed');
    $pdf->SetFont('Times','',10);
    $pdf->Text(250, 200, $datePrint.' '.$time);
    $pdf->SetFont('Times','',12);
    $pdf->Text(16, 195, 'Employee');
    $pdf->SetFont('Times','',10);
    $pdf->Text(16, 200,$row['emp_Name'].' '.$row['emp_Surname']);
    $pdf->Output('D','clients.pdf');



  }
  else if($bankN == "Capitec")
  {
              class myPDF extends FPDF
              {
                  function header()
                  {
                        $this->Image('img/Capitec.png',10,6);
                        $this->SetFont('Arial','B',14);
                        $this->Cell(276,30,'CAPITEC Client Information',0,0,'C');
                        $this->Ln();




                  }
                  function footer()
                  {
                          $this->SetY(-15);
                          $this->SetFont('Arial','',8);
                          $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


                  }
                  function headerTable()
                  {
                    $this->SetFont('Times','B',12);
                    $this->Cell(35,10,'Client ID',1,0,'C');
                    $this->Cell(40,10,'Name',1,0,'C');
                    $this->Cell(40,10,'Surname',1,0,'C');
                    $this->Cell(70,10,'Email Address',1,0,'C');
                    $this->Cell(40,10,'Cell Number',1,0,'C');
                    $this->Cell(40,10,'Bank Name',1,0,'C');

                        $this->Ln();

                  }
                function viewTable($conn,$emp_ID,$bank_ID)
                {

                        $this->SetFont('Times','',12);
                        $sql = "select c.cli_ID, c.cli_Name,a.acc_Number, c.cli_Surname,c.cli_Address,c.cli_IDNo ,c.cli_Phone, c.cli_Email,b.bank_Name
                                FROM  client c,bank b,branch br,account a
                                WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID
                                AND CONCAT(c.cli_ID,c.cli_Name,c.cli_Surname,c.cli_Phone,c.cli_Email) LIKE '%".$_GET['search']."%';";
                        $result = mysqli_query($conn,$sql);

                        $check = mysqli_num_rows($result);

                        if ($check>0)
                        {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          $this->SetFont('Times','B',12);
                          $this->Cell(35,10,$row['cli_ID'],1,0,'C');
                          $this->Cell(40,10,$row['cli_Name'],1,0,'C');
                          $this->Cell(40,10,$row['cli_Surname'],1,0,'C');
                          $this->Cell(70,10,$row['cli_Email'],1,0,'C');
                          $this->Cell(40,10,$row['cli_Phone'],1,0,'C');
                          $this->Cell(40,10,strtoupper($row['bank_Name']),1,0,'C');

                                $this->Ln();

                        }
                      }




                }

              }

              $pdf = new myPDF();
              $pdf->AliasNbPages();
              $pdf->AddPage('L','A4',0);
              $pdf->headerTable();
              $pdf->viewTable($conn,$emp_ID,$bank_ID);

              $empID = $_SESSION['ID'];
              $sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
              $pdf->SetFont('Times','',12);
              $pdf->Text(250, 195, 'Date Printed');
              $pdf->SetFont('Times','',10);
              $pdf->Text(250, 200, $datePrint.' '.$time);
              $pdf->SetFont('Times','',12);
              $pdf->Text(16, 195, 'Employee');
              $pdf->SetFont('Times','',10);
              $pdf->Text(16, 200,$row['emp_Name'].' '.$row['emp_Surname']);
              $pdf->Output('D','clients.pdf');




  }

}
elseif (isset($type) && isset($_SESSION['ID'])&&$_SESSION['stutus'] == "yes"&&$type=='PdfAll')
{

  $bankN = $_SESSION['bankn'];
  $datePrint = date('Y-m-d ');
  $time = date('h:i');


  if ($bankN == "Fnb")
  {

    class myPDF extends FPDF
    {
        function header()
        {
              $this->Image('img/Fnb.png',10,6);
              $this->SetFont('Arial','B',14);
              $this->Cell(276,30,'FNB Client Information',0,0,'C');
              $this->Ln();




        }
        function footer()
        {
                $this->SetY(-15);
                $this->SetFont('Arial','',8);
                $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


        }
        function headerTable()
        {


              $this->SetFont('Times','B',12);
              $this->Cell(35,10,'Client ID',1,0,'C');
              $this->Cell(40,10,'Name',1,0,'C');
              $this->Cell(40,10,'Surname',1,0,'C');
              $this->Cell(70,10,'Email Address',1,0,'C');
              $this->Cell(40,10,'Cell Number',1,0,'C');
              $this->Cell(40,10,'Bank Name',1,0,'C');

              $this->Ln();

        }
      function viewTable($conn,$emp_ID,$bank_ID)
      {

              $this->SetFont('Times','',12);
              $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                      FROM  client c,bank b,branch br,account a
                      WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                      AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID";
              $result = mysqli_query($conn,$sql);
              $check  = mysqli_num_rows($result);



            if ($check>0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                      $this->SetFont('Times','B',12);
                      $this->Cell(35,10,$row['cli_ID'],1,0,'C');
                      $this->Cell(40,10,$row['cli_Name'],1,0,'L');
                      $this->Cell(40,10,$row['cli_Surname'],1,0,'C');
                      $this->Cell(70,10,$row['cli_Email'],1,0,'C');
                      $this->Cell(40,10,$row['cli_Phone'],1,0,'C');
                      $this->Cell(40,10,strtoupper($row['bank_Name']),1,0,'C');
                      $this->Ln();
              }
            }

      }

    }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable($conn,$emp_ID,$bank_ID);

    $empID = $_SESSION['ID'];
    $sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $pdf->SetFont('Times','',12);
    $pdf->Text(250, 195, 'Date Printed');
    $pdf->SetFont('Times','',10);
    $pdf->Text(250, 200, $datePrint.' '.$time);
    $pdf->SetFont('Times','',12);
    $pdf->Text(16, 195, 'Employee');
    $pdf->SetFont('Times','',10);
    $pdf->Text(16, 200,$row['emp_Name'].' '.$row['emp_Surname']);
    $pdf->Output();



  }
  else if($bankN == "Capitec")
  {
              class myPDF extends FPDF
              {
                  function header()
                  {
                        $this->Image('img/Capitec.png',10,6);
                        $this->SetFont('Arial','B',14);
                        $this->Cell(276,30,'CAPITEC Client Information',0,0,'C');
                        $this->Ln();




                  }
                  function footer()
                  {
                          $this->SetY(-15);
                          $this->SetFont('Arial','',8);
                          $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');


                  }
                  function headerTable()
                  {
                    $this->SetFont('Times','B',12);
                    $this->Cell(35,10,'Client ID',1,0,'C');
                    $this->Cell(40,10,'Name',1,0,'C');
                    $this->Cell(40,10,'Surname',1,0,'C');
                    $this->Cell(70,10,'Email Address',1,0,'C');
                    $this->Cell(40,10,'Cell Number',1,0,'C');
                    $this->Cell(40,10,'Bank Name',1,0,'C');

                        $this->Ln();

                  }
                function viewTable($conn,$emp_ID,$bank_ID)
                {

                        $this->SetFont('Times','',12);
                        $sql = "select c.cli_ID, c.cli_Name,a.acc_Number,c.cli_Surname,c.cli_IDNo,c.cli_Address, c.cli_Phone, c.cli_Email,b.bank_Name
                                FROM  client c,bank b,branch br,account a
                                WHERE  b.bank_ID = '$bank_ID' AND br.bank_ID = b.bank_ID
                                AND br.branch_ID	 = a.branch_ID	AND a.cli_ID = c.cli_ID";
                        $result = mysqli_query($conn,$sql);
                        $check = mysqli_num_rows($result);

                        if ($check> 0)
                        {
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            $this->SetFont('Times','B',12);
                            $this->Cell(35,10,$row['cli_ID'],1,0,'C');
                            $this->Cell(40,10,$row['cli_Name'],1,0,'C');
                            $this->Cell(40,10,$row['cli_Surname'],1,0,'C');
                            $this->Cell(70,10,$row['cli_Email'],1,0,'C');
                            $this->Cell(40,10,$row['cli_Phone'],1,0,'C');
                            $this->Cell(40,10,strtoupper($row['bank_Name']),1,0,'C');

                                  $this->Ln();

                          }
                        }

                }

              }

              $pdf = new myPDF();
              $pdf->AliasNbPages();
              $pdf->AddPage('L','A4',0);
              $pdf->headerTable();
              $pdf->viewTable($conn,$emp_ID,$bank_ID);

              $empID = $_SESSION['ID'];
              $sql = "SELECT*  FROM employee WHERE emp_ID = '$empID';";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
              $pdf->SetFont('Times','',12);
              $pdf->Text(250, 195, 'Date Printed');
              $pdf->SetFont('Times','',10);
              $pdf->Text(250, 200, $datePrint.' '.$time);
              $pdf->SetFont('Times','',12);
              $pdf->Text(16, 195, 'Employee');
              $pdf->SetFont('Times','',10);
              $pdf->Text(16, 200,$row['emp_Name'].' '.$row['emp_Surname']);
              $pdf->Output('D','clients.pdf');




  }
}


?>
