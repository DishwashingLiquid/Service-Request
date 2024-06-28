<?php
    session_start();
    include "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");
    } 
    $id = $_GET["id"];
    if(isset($_POST["submit"])) { 
        $admin_id = $_POST['admin_id'];
        $updated_by = $_POST['updated_by'];
    
    $sql = "UPDATE `request-list` SET 
        	`admin_id` = '$admin_id',
            `updated_by` = '$updated_by'
            WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);
    
        if ($result) {
            header("Location: ../../IMISS-System/4on-going.php?scs=Assigned successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <div class="all_forms">
        <div>
            <?php
                $id = $_GET["id"];  
                $sql = "SELECT a.description, a.admin_id, a.end_user_id, a.id,
                            CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                            CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested,
                            b.id, CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) as full_user
                        FROM `request-list` a
                        LEFT JOIN `end-user-list` b
                        ON a.end_user_id = b.id
                        WHERE a.id = $id LIMIT 1"; 
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?>
                <?php 
                        $admin_id = $row["admin_id"];
                        if(empty($admin_id)) { ?>
                            <h3>Assign this Request</h3> 
                    <?php   } else { ?>
                            <h3>Re-assign this Request</h3> 
                    <?php } ?>
            <form action="" method="post" autocomplete="off">
                <div class="input_field">
                    <input type="text"  id="id" name="id" value="<?php echo $row['full_id'] ?>" disabled>
                    <label for="id">Service Request No.:</label> 
                </div>
                <div class="input_field">
                    <input type="text" id="date" name="date" value="<?php echo $row["datetime_requested"]; ?>" disabled>
                    <label for="date">Date:</label> 
                </div>
                <div class="input_field">
                    <input type="text" id="end_user_name" name="end_user_name" 
                        value="<?php 
                        $end_user_name = $row["full_user"];
                            if(empty($end_user_name)) {
                                echo "IMISS Manual Request";
                            } else {
                            echo $row['full_user'] ;
                            }
                            ?>" disabled>
                    <label for="end_user_name">Full Name:</label> 
                </div> 
                <div class="input_field">
                    <textarea name="description" id="description" required><?php echo $row['description'] ?></textarea>  
                    <label for="description">Description of Request:</label>
                </div> 
                <?php
                    if(!empty($_SESSION['reception_fname'])) { ?>
                        <div class="input_field no_display">
                            <?php $updated_name = $_SESSION['reception_fname']." ". $_SESSION['reception_mname']." ". $_SESSION['reception_lname'] ?>
                            <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                            <label for="updated_by">Updated by:</label>
                        </div>
                    <?php } else { ?>
                        <div class="input_field no_display">
                            <?php $updated_name = $_SESSION['superadmin_fname']." ". $_SESSION['superadmin_mname']." ". $_SESSION['superadmin_lname'] ?>
                            <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                            <label for="updated_by">Updated by:</label>
                        </div>
                <?php } ?> 
                <?php
                    $admin_id = $row['admin_id'];
                    if(empty($admin_id)) { ?>
                        <div class="input_field"> 
                            <select name="admin_id" id="admin_id" required>
                            <option value="" disabled selected hidden></option>
                                    <?php  
                                        $sql = "SELECT CONCAT(admin_fname, ' ', admin_mname, ' ', admin_lname) AS full_admin, id
                                                FROM `admin-list`";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                <option value="<?php echo $row["id"] ?>"><?php echo $row["full_admin"] ?></option>
                                    <?php
                                        }
                                    ?>
                            </select> 
                            <label for="admin_id">Assign to:</label>
                        </div>
                <?php  
                    } else { ?>
                        <div class="input_field"> 
                        <select name="admin_id" id="admin_id" required>
                        <option value="" disabled selected hidden></option>
                                <?php  
                                    $sql = "SELECT CONCAT(admin_fname, ' ', admin_mname, ' ', admin_lname, ' ') AS full_admin, id
                                    FROM `admin-list`";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["full_admin"] ?></option>
                                <?php
                                    }
                                ?>
                        </select> 
                        <label for="admin_id">Re-Assign to:</label>
                    </div>  
                <?php } ?>
                <button type="submit" class="button_control" name="submit">Save</button>
                <a href="../../IMISS-System/4on-going.php" class="button_control">Cancel</a>
            </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>