<?php
    session_start();
    require "../../IMISS-System/db_conn.php"; 
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");
    }  
    /* submit for add */
    if(isset($_POST["add_submit"])) {
        $admin_fname = $_POST['admin_fname']; 
        $admin_mname = $_POST['admin_mname'];
        $admin_lname = $_POST['admin_lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $updated_by = $_POST['updated_by'];

        $sql = "INSERT INTO `admin-list`
                (`id`, `admin_fname`, `admin_mname`, `admin_lname`, `username`, `password`, `updated_by`) 
            VALUES
                (NULL, '$admin_fname', '$admin_mname', '$admin_lname', '$username', '$password', '$updated_by')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/1admin.php?scs=Added successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for delete */
    if(isset($_POST["delete_submit"])) {  
        $array = $_POST['delete_item'];
        $extract_id = implode(' , ', $array);
    
        $sql = "DELETE FROM `admin-list`
                WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/1admin.php?scs=Deleted successfully.");
        } else {
        echo "Failed: " . mysqli_error($conn);
        } 
    }
    /* submit for edit */
    if(isset($_POST["edit_submit"])) {
        $admin_fname = $_POST['admin_fname'];
        $admin_mname = $_POST['admin_mname'];
        $admin_lname = $_POST['admin_lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $updated_by = $_POST['updated_by'];
        
        $array = $_POST['edit_item'];
        $extract_id = implode(' , ', $array);

        $sql = "UPDATE `admin-list` SET 
            `admin_fname` = '$admin_fname',
            `admin_mname` = '$admin_mname',
            `admin_lname` = '$admin_lname',
            `username` = '$username',
            `password` = '$password',
            `updated_by` = '$updated_by'
            WHERE id = $extract_id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/1admin.php?scs=Data updated successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    
?>