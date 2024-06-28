<?php
    session_start();
    include "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_admin"])){
        header("Location: ../../IMISS-System/index_two.php");
    }  
    $id = $_GET["id"];
    if(isset($_POST['claim'])) { 
        $admin_id = $_SESSION['id'];   
        $updated_by = $_SESSION['admin_fname']." ".$_SESSION['admin_mname']." ".$_SESSION['admin_lname'];
        $sql = "UPDATE `request-list` SET
                `admin_id` = '$admin_id',
                `updated_by` = '$updated_by'
                WHERE id = $id"; 
        $result = mysqli_query($conn, $sql);
        
            if ($result) {
                header("Location: ../../IMISS-System/13admin_claim.php?scs=Claimed successfully.");
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
        <div class="titlebar">on-going request</div>
        <div class="all_forms claim_form">
            <div>
                <h3>Claim this Request</h3> 
                    <?php 
                        $sql = "SELECT description, id, date_requested, 
                                    CONCAT(MONTH(date_requested), '-', YEAR(date_requested), '-', id) AS full_id 
                                FROM `request-list`
                                WHERE id = $id LIMIT 1"; 
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                <div class="input_field">
                    <input type="text" id="id" name="id" value="<?php echo $row['full_id'] ?>" >
                    <label for="id">Service Request No.:</label>  
                </div>
                <div class="input_field">
                        <textarea name="description" id="description" required><?php echo $row['description'] ?></textarea>  
                        <label for="description">Description of Request:</label>
                </div>
                <br><br>
                    <form method="post">   
                    <button type="submit" name="claim" class="button_control" value="claim">Claim</button>
                    <a href="../../IMISS-System/13admin_claim.php" class="button_control">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
    </div> 
</body>
</html>