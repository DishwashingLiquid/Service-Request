<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");    
    }
    /* submit for add */
    if(isset($_POST["add_submit"])) {
        $reception_fname = $_POST['reception_fname'];
        $reception_mname = $_POST['reception_mname'];
        $reception_lname = $_POST['reception_lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $updated_by= $_POST['updated_by'];

        $sql = "INSERT INTO `reception-list`
                (`id`, `reception_fname`, `reception_mname`, `reception_lname`, `username`, `password`, `updated_by`)
            VALUES
                (NULL, '$reception_fname', '$reception_mname', '$reception_lname', '$username', '$password', '$updated_by')";
    
        $result = mysqli_query($conn, $sql);
        
        if($result) {
            header("Location: ../../IMISS-System/2reception.php?scs=Added successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for delete */
    if(isset($_POST["delete_submit"])) {
        $array = $_POST['delete_item'];
        $extract_id = implode(' , ', $array);

        $sql = "DELETE FROM `reception-list`
                WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/2reception.php?scs=Deleted successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for edit */
    if(isset($_POST["edit_submit"])) {
        $reception_fname = $_POST['reception_fname'];
        $reception_mname = $_POST['reception_mname'];
        $reception_lname = $_POST['reception_lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $updated_by = $_POST['updated_by'];

        $array = $_POST['edit_item'];
        $extract_id = implode(' , ', $array);

        $sql = "UPDATE `reception-list` SET
                `reception_fname` = '$reception_fname',
                `reception_mname` = '$reception_mname',
                `reception_lname` = '$reception_lname',
                `username` = '$username',
                `password` = '$password',
                `updated_by` = '$updated_by'
                WHERE id = $extract_id";
    
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/2reception.php?scs=Data updated successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }

?>