<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])) {
        header("Location: ../../IMISS-System/index_two.php");
    }
    /* submit for delete */
    if(isset($_POST["delete_submit"])) {
        $array = $_POST['delete_item'];
        $extract_id = implode(' , ', $array);

        $sql = "DELETE FROM `request-list`
                WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: ../../IMISS-System/6resolved.php?scs=Deleted successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    /* submit for edit */
    if(isset($_POST["edit_submit"])) {
        $ict_equipment_code = $_POST['ict_equipment_code'];
        $description = $_POST['description'];
        $type_of_service = $_POST['type_of_service'];
        $ict_component = $_POST['ict_component'];
            $array_two = $_POST['ict_component_spec'];
        $ict_component_spec = implode("<br>", $array_two);
        $assessment = $_POST['assessment'];
        $remarks = $_POST['remarks'];
        $service_rendered = $_POST['service_rendered'];
        $updated_by = $_POST['updated_by'];

        $array = $_POST['edit_item'];
        $extract_id = implode(' , ', $array);

        $sql = "UPDATE `request-list` SET
                `ict_equipment_code` = '$ict_equipment_code',
                `description` = '$description',
                `type_of_service` = '$type_of_service',
                `ict_component` = '$ict_component',
                `ict_component_spec` = '$ict_component_spec',
                `assessment` = '$assessment',
                `remarks` = '$remarks',
                `service_rendered` = '$service_rendered',
                `updated_by` = '$updated_by'
                WHERE id = $extract_id";

        $result = mysqli_query($conn, $sql);            

        if($result) {
            header("Location: ../../IMISS-System/6resolved.php?scs=Data updated successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>