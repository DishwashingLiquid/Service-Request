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
        $ink_type = $_POST['ink_type'];
        $ink_code = $_POST['ink_code'];
        $status = $_POST['status'];
        $updated_by = $_POST['updated_by'];

        $sql = "UPDATE `equipment-list-printer` SET
                `area` = '$area',
                `brand` = '$brand',
                `model` = '$model',
                `type` = '$type',
                `ink_type` = '$ink_type',
                `ink_code` = '$ink_code',
                `status` = '$status',
                `updated_by` = '$updated_by'
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: ../../../../IMISS-System/PHP-Inventory/actions_printer.php?scs=Updated successfully.");
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
        <div class="titlebar">printer</div>
        <div class="all_forms">
            <div> <!-- div for edit --> 
                <h3>Edit Printer Inventory</h3> 
                <form action="" method="post" autocomplete="off">  
                    <?php 
                        $id = $_GET["id"];   
                        $sql = "SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id, id, area, brand, model,
                                       type, ink_type, ink_code, status
                                FROM `equipment-list-printer` WHERE id = $id";
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
                        <select name="type" id="type" required>
                        <option value="<?php echo $row['type']?>" selected hidden><?php echo $row['type']?></option>
                                <option value="Multifunction">Multifunction</option>
                                <option value="Printer Only">Printer Only</option>
                        </select>
                        <label for="type">Type:</label>
                    </div>
                    <div class="input_field">
                        <select name="ink_type" id="ink_type" required>
                        <option value="<?php echo $row['ink_type']?>" selected hidden><?php echo $row['ink_type']?></option>
                                <option value="CIS">CIS</option>
                                <option value="Toner">Toner</option>
                                <option value="Ribbon">Ribbon</option>
                                <option value="Cartridge">Cartridge</option>
                        </select>
                        <label for="ink_type">Ink Type:</label>
                    </div> 
                    <div class="input_field">
                        <input type="text" name="ink_code" id="ink_code" value="<?php echo $row['ink_code']?>" required>
                        <label for="ink_code">Ink Code:</label>
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
                    <a href="../../IMISS-System/PHP-Inventory/actions_printer.php" class="button_control">Cancel</a> 
                </form>
            </div>  
        </div> <!-- all_forms closer -->
    </div>
    </div>
</body>
</html>