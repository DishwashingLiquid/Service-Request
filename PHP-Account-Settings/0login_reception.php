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
                $sql = "SELECT * FROM `reception-list`
                        WHERE username='$username' 
                        AND password='$password'";
                $result = mysqli_query($conn, $sql);
    
                if(mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if($row['username'] === $username && $row['password'] === $password) { 
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['reception_fname'] = $row['reception_fname'];
                        $_SESSION['reception_mname'] = $row['reception_mname'];
                        $_SESSION['reception_lname'] = $row['reception_lname'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION["log_reception"] = true; 
                        header("Location: ../../IMISS-System/4on-going.php");
                        exit();  
                    }
                } else {
                    header("Location: ../../IMISS-System/index_two.php?dng=Incorrect username or password.");
                    exit();
                }
            }
    }