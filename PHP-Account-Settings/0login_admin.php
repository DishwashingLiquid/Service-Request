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
                $sql = "SELECT * FROM `admin-list`
                    WHERE username='$username'
                    AND password='$password'";
                $result = mysqli_query($conn, $sql);
                
                if(mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);  
                    if($row['username'] === $username && $row['password'] === $password) {
                        $_SESSION['username'] = $row['username']; 
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['admin_fname'] = $row['admin_fname'];
                        $_SESSION['admin_mname'] = $row['admin_mname'];
                        $_SESSION['admin_lname'] = $row['admin_lname'];
                        $_SESSION["log_admin"] = true; 
                        header("Location: ../../IMISS-System/12admin_dashboard.php");
                        exit();
                    }
                } else {
                    header("Location: ../../IMISS-System/index_two.php?dng=Incorrect username or password.");
                    exit();
                }
            }
    }