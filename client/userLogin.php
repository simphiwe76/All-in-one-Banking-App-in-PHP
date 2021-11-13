<?php
      include_once '../database/dbConn.php';
      session_start();


      if (isset($_POST['user_log']))
      {
            $email = $_POST['email'];
            $password = $_POST['password'];


            $email = mysqli_real_escape_string($conn,$email);
            $password = mysqli_real_escape_string($conn,$password);



            $sql = "SELECT C.cli_ID,C.cli_IDNo,C.cli_Email,C.cli_Password,C.level, A.acc_Number,A.acc_ID,BR.branch_ID,B.bank_Name
                   FROM client C ,account A , branch BR ,bank B
                   WHERE A.acc_Number = '$email'
                   AND C.cli_ID = A.cli_ID
                   AND A.branch_ID	 = BR.branch_ID
                   AND B.bank_ID	 = BR.bank_ID;";
            $results = mysqli_query($conn,$sql);
            $check = mysqli_num_rows($results);
            $row = mysqli_fetch_assoc($results);
            $pass = $row['cli_Password'];


            if ($check == 1)
            {




                      if (password_verify($password,$pass))
                      {
                        $_SESSION['ID'] =  $row['cli_ID'];
                        $_SESSION['userLevel'] =  "yes";
                        $_SESSION['status'] =  $row['level'];
                        $_SESSION['bank'] =  $row['bank_Name'];
                        $_SESSION['acc'] =  $row['acc_Number'];
                        $_SESSION['idNum'] = $row['cli_IDNo'];


                        if ( $row['bank_Name'] == 'Fnb' && $row['level'] == 2)
                        {
                            echo '<script>alert("User has successfully login on Fnb")</script>';
                            echo "<script>location.replace('fnb/index.php');</script>";

                        }
                        elseif ( $row['bank_Name'] == 'Capitec' && $row['level'] == 2)
                        {

                            echo '<script>alert("User has successfully login on Capitec")</script>';
                            echo "<script>location.replace('capitec/index.php');</script>";

                        }

                      }
                      else
                      {
                        echo '<script>alert("Password is Incorrect")</script>';
                        echo "<script>location.replace('Login.html');</script>";
                        exit();


                      }




            }
            else
            {

                          echo '<script>alert("Client is  not registered with one of the bank in a system")</script>';
                          echo "<script>location.replace('Login.html');</script>";
                          exit();
            }



      }

 ?>
