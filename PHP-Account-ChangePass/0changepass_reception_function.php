<?php
    session_start();
    require "../../IMISS-System/db_conn.php";

        $id = $_SESSION['id'];
        $row_password = $_POST['password'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
    if($row_password === $current_password){
        if($new_password === $confirm_password) {
            if(isset($_POST['reception_submit'])) {
                $sql = "UPDATE `reception-list` SET
                        `password` = '$confirm_password'
                        WHERE id = $id";
                
                $result = mysqli_query($conn, $sql);

                if($result) {
                    header("Location: ../../../../IMISS-System/PHP-Account-MyAccount/0myaccount_reception.php?scs=Password updated successfully.");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            }
        } else {
            header("Location: ../../../../IMISS-System/PHP-Account-ChangePass/0changepass_reception.php?dng=Confirm password is incorrect.");
        }
    } else { 
        header("Location: ../../../../IMISS-System/PHP-Account-ChangePass/0changepass_reception.php?dng=Current password is incorrect.");
    }
    