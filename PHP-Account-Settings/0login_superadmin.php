<?php
    session_start();
    include "../../IMISS-System/db_conn.php";

        if(isset($_POST['username']) && isset($_POST['password'])) {
            function validate($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $username = validate($_POST['username']);
            $password = validate($_POST['password']);
  
                if(!empty($username) && !empty($password)){
                    $sql = "SELECT * FROM `superadmin-list` 
                            WHERE username='$username'
                            AND password='$password'";
                    $result = mysqli_query($conn, $sql);
        
                    if(mysqli_num_rows($result) === 1){
                        $row = mysqli_fetch_assoc($result);
                        if($row['username'] === $username && $row['password'] === $password) { 
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['superadmin_fname'] = $row['superadmin_fname'];
                            $_SESSION['superadmin_mname'] = $row['superadmin_mname'];
                            $_SESSION['superadmin_lname'] = $row['superadmin_lname'];
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['log_superadmin'] = true;
                            header("Location: ../../IMISS-System/2reception.php");
                            exit();
                        }
                    } else {
                        header("Location: ../../IMISS-System/index_two.php?dng=Incorrect username or password.");
                        exit();
                    }
                }
        }