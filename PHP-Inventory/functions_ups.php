<?php
    session_start();
    require "../../IMISS-System/db_conn.php"; 
    if(! isset($_SESSION["log_admin"]) && ! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])) {
         header("Location: index_two.php"); 
    }
    /* submit for edit */
    if(isset($_POST["edit_submit"])){ 
        $id = $_GET['id']; 
        $area = $_POST['area'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $type = $_POST['type'];
        $no_of_kva = $_POST['no_of_kva'];
        $status = $_POST['status'];
        $updated_by = $_POST['updated_by'];

        $sql = "UPDATE `equipment-list-ups` SET
                `area` = '$area',
                `brand` = '$brand',
                `model` = '$model',
                `type` = '$type',
                `no_of_kva` = '$no_of_kva',
                `status` = '$status',
                `updated_by` = '$updated_by'
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: ../../../../IMISS-System/PHP-Inventory/actions_ups.php?scs=Updated successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../IMISS-System/index.css">
    <link rel="stylesheet" href="../../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title>
</head>
<body>
    <?php require "../../IMISS-System/nav_bar_disabled.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">ups</div>
        <div class="all_forms">
            <div> <!-- div for edit --> 
                <h3>Edit UPS Inventory</h3> 
                <form action="" method="post" autocomplete="off">  
                    <?php 
                        $id = $_GET["id"];   
                        $sql = "SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id, id, area, brand, model,
                                        type, no_of_kva, status
                                FROM `equipment-list-ups` WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>  
                    <div class="input_field no_display"> <!-- this will let the id still submit  -->
                        <input type="text" name="edit_item[]" id="edit_item" value="<?php echo $extract_id ?>">
                        <label for="edit_item">ID:</label>
                    </div> 
                    <div class="input_field"> <!-- just for display -->
                        <input type="text" value="<?php echo $row['full_id'] ?>" disabled>
                        <label for="edit_item">ID:</label>
                    </div>  
                    <div class="input_field">
                        <input type="text" name="area" id="area" value="<?php echo $row['area']?>" required>
                        <label for="area">Area:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="brand" id="brand" value="<?php echo $row['brand']?>" required>
                        <label for="brand">Brand:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="model" id="model" value="<?php echo $row['model']?>" required>
                        <label for="model">Model:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="type" id="type" value="<?php echo $row['type']?>" required>
                        <label for="type">Type:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="no_of_kva" id="no_of_kva" value="<?php echo $row['no_of_kva']?>" required>
                        <label for="no_of_kva">Number of KVA:</label>
                    </div>
                    <div class="input_field">
                        <select name="status" id="status">
                            <option value="<?php
                                $status = $row['status'];
                                if($status === 'Inactive'){
                                    echo "Inactive";
                                } else {
                                    echo "Active";
                                }
                            ?>"><?php
                            if($status === 'Inactive'){
                                echo "Inactive";
                            } else {
                                echo "Active";
                            }
                        ?></option>
                            <option value="<?php
                                $status = $row['status'];
                                if($status === 'Inactive'){
                                    echo "Active";
                                } else {
                                    echo "Inactive";
                                }
                            ?>"><?php
                            if($status === 'Inactive'){
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                        ?></option>
                        </select>
                        <label for="status">Status:</label>
                    </div>
                    <?php 
                        if(!empty($_SESSION['reception_fname'])) { ?>
                            <div class="input_field no_display"> 
                                <?php $updated_name = $_SESSION['reception_fname']." ". $_SESSION['reception_mname']." ". $_SESSION['reception_lname']?>
                                <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                                <label for="updated_by">Updated by:</label> 
                            </div>
                        <?php } else if(!empty($_SESSION['superadmin_fname'])) { ?>
                            <div class="input_field no_display"> 
                                <?php $updated_name = $_SESSION['superadmin_fname']." ".$_SESSION['superadmin_mname']." ".$_SESSION['superadmin_lname']?>
                                <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                                <label for="updated_by">Updated by:</label> 
                            </div>
                        <?php } else { ?> 
                            <div class="input_field no_display"> 
                                <?php $updated_name = $_SESSION['admin_fname']." ".$_SESSION['admin_mname']." ".$_SESSION['admin_lname']?>
                                <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                                <label for="updated_by">Updated by:</label> 
                            </div>
                    <?php } ?>
                    <button type="submit" name="edit_submit" id="edit_submit" class="button_control">Edit</button> 
                    <a href="../../IMISS-System/PHP-Inventory/actions_ups.php" class="button_control">Cancel</a> 
                </form>
            </div>  
        </div>
    </div>
    </div>
</body>
</html>