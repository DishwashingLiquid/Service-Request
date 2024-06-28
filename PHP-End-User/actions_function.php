<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");
    } 
    /* submit for add */
    if(isset($_POST["add_submit"])) {
        $division = $_POST['division'];
        $area = $_POST['area'];
        $end_user_fname = $_POST['end_user_fname'];
        $end_user_mname = $_POST['end_user_mname'];
        $end_user_lname = $_POST['end_user_lname'];
        $contact_no = $_POST['contact_no'];
        $email = $_POST['email']; 
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_approved = $_POST['is_approved'];
        $updated_by = $_POST['updated_by'];
    
        $sql = "INSERT INTO `end-user-list`
                (`id`, `division`, `area`, `end_user_fname`, `end_user_mname`, `end_user_lname`, `contact_no`, `email`, `username`, `password`, `is_approved`, `updated_by`)
            VALUES
                (NULL, '$division', '$area', '$end_user_fname', '$end_user_mname', '$end_user_lname', '$contact_no', '$email', '$username', '$password', '$is_approved', '$updated_by')";

        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            header("Location: ../../IMISS-System/3end-user.php?scs=Added successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for delete */
    if(isset($_POST["delete_submit"])) {
        $array = $_POST['delete_item'];
        $extract_id = implode(' , ', $array);
    
        $sql = "DELETE FROM `end-user-list`
                WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/3end-user.php?scs=Deleted successfully.");
        } else {
        echo "Failed: " . mysqli_error($conn);
        } 
    }
    /* submit for edit */
    if(isset($_POST["edit_submit"])) {
        $division = $_POST['division'];
        $area = $_POST['area'];
        $end_user_fname = $_POST['end_user_fname'];
        $end_user_mname = $_POST['end_user_mname'];
        $end_user_lname = $_POST['end_user_lname'];
        $contact_no = $_POST['contact_no']; 
        $username = $_POST['username'];
        $password = $_POST['password'];
        $updated_by = $_POST['updated_by'];

        $array = $_POST['edit_item'];
        $extract_id = implode(' , ', $array);
    
        $sql = "UPDATE `end-user-list` SET
            `division` = '$division',
            `area` = '$area';
            `end_user_fname` = '$end_user_fname',
            `end_user_mname` = '$end_user_mname',
            `end_user_lname` = '$end_user_lname',
            `contact_no` = '$contact_no', 
            `username` = '$username',
            `password` = '$password',
            `updated_by` = '$updated_by'
            WHERE id = $extract_id";
    
        $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../../IMISS-System/3end-user.php?scs=Data updated successfully.");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
    }