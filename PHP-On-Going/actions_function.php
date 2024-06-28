<?php
    session_start();
    require "../../IMISS-System/db_conn.php"; 
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");
    }  
    /* submit for create */
    if(isset($_POST["create_submit"])) {
        $end_user_id = $_POST['end_user_id']; 
        $description = $_POST['description']; 
        $ict_equipment_code = $_POST['ict_equipment_code']; 
        $updated_by = $_POST['updated_by'];

        $sql = "INSERT INTO `request-list`
                (`end_user_id`, `description`, `ict_equipment_code`, `updated_by`) 
            VALUES
                ('$end_user_id', '$description', '$ict_equipment_code', '$updated_by')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/4on-going.php?scs=Added successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for delete */
    if(isset($_POST["delete_submit"])) {
        $array = $_POST['delete_item'];
        $extract_id = implode(' , ', $array);

        $sql = "DELETE FROM `request-list`
                WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/4on-going.php?scs=Deleted successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for edit */
    if(isset($_POST["edit_submit"])) { 
        $end_user_id = $_POST['end_user_id'];
        $ict_equipment_code = $_POST['ict_equipment_code'];
        $description = $_POST['description'];
        $updated_by = $_POST['updated_by'];

        $array = $_POST['edit_item'];
        $extract_id = implode(' , ', $array);

        $sql = "UPDATE `request-list` SET 
                `end_user_id` = '$end_user_id',
                `ict_equipment_code` = '$ict_equipment_code',
                `description` = '$description',
                `updated_by` = '$updated_by'
                WHERE id = $extract_id";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../../IMISS-System/4on-going.php?scs=Data updated successfully."); 
        } else {
            echo "Failed:  " . mysqli_error($conn);
        }
    }
?>