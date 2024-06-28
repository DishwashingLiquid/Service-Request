<?php
    session_start();
    include "../../IMISS-System/db_conn.php";

    if(isset($_POST['username']) && isset($_POST['password'])){
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        
            if(!empty($username) && !empty($password)){
                $sql = "SELECT * FROM `end-user-list`
                        WHERE username = '$username' AND
                        password = '$password'  
                        ";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) === 1){
                    $row = mysqli_fetch_assoc($result);
                    if($row['username'] === $username && $row['password'] === $password && $row['is_approved'] === 'false'){
                        header("Location: ../../IMISS-System/index.php?wng=Your account is not yet approved.");
                        exit();
                    } else {
                        $_SESSION['username'] = $row['username'];   
                        $_SESSION['end_user_fname'] = $row['end_user_fname'];   
                        $_SESSION['end_user_mname'] = $row['end_user_mname'];   
                        $_SESSION['end_user_lname'] = $row['end_user_lname'];   
                        $_SESSION['id'] = $row['id'];   
                        $_SESSION["log_user"] = true; 
                        header("Location: ../../IMISS-System/8user_dashboard.php");
                        exit();
                    }
                } else { 
                        header("Location: ../../IMISS-System/index.php?dng=Incorrect username or password.");
                        exit();
                }
            } 
    }
