<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");
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
        <div class="all_forms">
        <?php if(isset($_POST["create_button"])) { ?>
        <div> <!-- div for create -->
            <h3>Create Request</h3>
            <form action="../../IMISS-System/PHP-On-Going/actions_function.php" method="post" autocomplete="off">
                <div class="input_field"> 
                    <select name="end_user_id" id="end_user_id">
                    <option selected>IMISS Manual Request</option>
                            <?php  
                                $sql = "SELECT CONCAT(end_user_fname, end_user_mname, end_user_lname) as full_user, id
                                        FROM `end-user-list`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["full_user"] ?></option>
                            <?php
                                }
                            ?>
                    </select> 
                    <label for="end_user_id">End-User Name:</label>
                    </div>  
                    <div class="input_field">  
                    <label for="ict_equipment_code" style="top: 0; background: #FFF;padding: 0 .5vh 0 .5vh;">ICT Equipment Code:</label>
                    <input type="text" list="codes" name="ict_equipment_code" id="ict_equipment_code" required>
                    <datalist id="codes">
                    <option value="" disabled selected hidden></option>
                            <?php  
                                $sql = "SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-desktop`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-laptop`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-ups`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-printer`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-scanner`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-server`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-router`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-switch`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-kiosk`
                                        WHERE status = 'Active'
                                        UNION ALL
                                        SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id
                                        FROM `equipment-list-tv`
                                        WHERE status = 'Active'
                                        ";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                    <option value="<?php echo $row["full_id"] ?>"><?php echo $row["full_id"] ?></option>
                            <?php
                                }
                            ?>
                    </datalist> 
                </div>   
                <div class="input_field">
                    <textarea name="description" id="description" cols="80" rows="15" required></textarea> 
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
                <button type="submit" name="create_submit" id="create_submit" class="button_control">Save</button>
                <a href="../../IMISS-System/4on-going.php" class="button_control">Cancel</a>
            </form>
        </div>
        <?php } elseif (isset($_POST["delete_button"])) { ?>
        <div> <!-- div for delete -->
            <h3>Delete On-Going Request</h3>
            <form action="../../IMISS-System/PHP-On-Going/actions_function.php" method="post" autocomplete="off">
                <?php
                    /* this will let the id still submit */
                    $array = $_POST['select_id'];
                    $extract_id = implode(' , ', $array);

                    /* just for display */
                    $sql =  "SELECT CONCAT(MONTH(date_requested), '-', YEAR(date_requested), '-') AS full_id
                            FROM `request-list`";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);  
                ?>
                <div class="input_field no_display"> <!-- this will let the id still submit  -->
                    <input type="text" name="delete_item[]" id="delete_item" value="<?php echo $extract_id ?>">
                    <label for="delete_item"></label>
                </div>
                <div class="input_field"> <!-- just for display -->
                    <textarea id="for_delete" disabled><?php 
                                /* added the code below to remove last comma on array of ids */
                                $num_items = count($array);
                                $num_count = 0;

                                foreach($array as $value) {
                                    $values = $row['full_id'] . $value;  
                                    echo $values;
                                    $num_count = $num_count + 1;

                                    if ($num_count < $num_items) {
                                        echo ", ";
                                    }
                                } 
                            ?></textarea>
                    <label for="delete_item"></label>
                </div>
                <button type="submit" name="delete_submit" id="delete_submit" class="button_control">Delete</button>
                <a href="../../IMISS-System/4on-going.php" class="button_control"> Cancel</a>
            </form>
        </div>
        <?php } else { ?>
        <div> <!-- div for edit -->
            <h3>Edit On-Going Request</h3>
            <form action="../../IMISS-System/PHP-On-Going/actions_function.php" method="post" autocomplete="off">
                <?php
                    $array = $_POST['select_id'];
                    $extract_id = implode(' , ', $array); 
                    $sql = "SELECT CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', $extract_id) AS full_id, 
                            a.ict_equipment_code, a.description, a.end_user_id,
                            b.id, CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) as full_user
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            WHERE a.id = $extract_id LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                <div class="input_field no_display"> <!-- this will let the id still submit  -->
                    <input type="text" name="edit_item[]" id="edit_item" value="<?php echo $extract_id ?>">
                    <label for="edit_item">Service Request No.:</label>
                </div>
                <div class="input_field"> <!-- just for display -->
                    <input type="text" value="<?php echo $row['full_id'] ?>" disabled>
                    <label for="edit_item">Service Request No.:</label>
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
                    <input type="text" id="ict_equipment_code" name="ict_equipment_code" value="<?php echo $row['ict_equipment_code'] ?>" required>
                    <label for="ict_equipment_code">ICT Equipment Code:</label>  
                </div>   
                <div class="input_field">
                    <textarea name="description" id="description" cols="80" rows="15" required><?php echo $row['description'] ?></textarea> 
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
                            <?php $updated_name = $_SESSION['superadmin_fname']." ". $_SESSION['reception_mname']." ". $_SESSION['reception_lname'] ?>
                            <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                            <label for="updated_by">Updated by:</label>
                        </div>
                <?php } ?>
                <button type="submit" name="edit_submit" id="edit_submit" class="button_control">Edit</button> 
                <a href="../../IMISS-System/4on-going.php" class="button_control">Cancel</a> 
            </form>
        </div>
        <?php } ?>
        </div> <!-- closer for all_forms -->
    </div>
    </div>
</body>
</html>