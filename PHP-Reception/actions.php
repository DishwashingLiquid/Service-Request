<?php
    session_start();
    require "../../IMISS-System/db_conn.php"; 
    if(! isset($_SESSION["log_superadmin"])){
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
        <div class="titlebar">reception</div>
        <div class="all_forms">  
        <?php if(isset($_POST["add_button"])) { ?> 
        <div> <!-- div for add -->
            <h3>Add New Reception</h3> 
            <form action="../../IMISS-System/PHP-Reception/actions_function.php" method="post" autocomplete="off">  
                <div class="input_field">
                    <input type="text" name="reception_fname" id="reception_fname" required>
                    <label for="reception_fname">First Name:</label> 
                </div>
                <div class="input_field">
                    <input type="text" name="reception_mname" id="reception_mname" required>
                    <label for="reception_mname">Middle Name:</label>
                </div> 
                <div class="input_field">
                    <input type="text" name="reception_lname" id="reception_lname" required>
                    <label for="reception_lname">Last Name:</label>
                </div>
                <div class="input_field">
                    <input type="text" name="username" id="username" required>
                    <label for="username">Username:</label> 
                </div>
                <div class="input_field">
                    <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_add()"></i>
                    <input type="password" name="password" id="add_password" required>
                    <label for="password">Password:</label> 
                </div>  
                <div class="input_field no_display">
                    <?php $updated_name = $_SESSION['superadmin_fname']." ". $_SESSION['superadmin_mname']." ". $_SESSION['superadmin_lname'] ?>
                    <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                    <label for="updated_by">Updated by:</label>
                </div> 
                <button type="submit" name="add_submit" id="add_submit" class="button_control">Save</button>
                <a href="../../IMISS-System/2reception.php" class="button_control">Cancel</a>
            </form>
        </div>
        <?php } elseif (isset($_POST["delete_button"])) { ?>
        <div> <!-- div for delete --> 
            <h3>Delete Reception</h3> 
            <form action="../../IMISS-System/PHP-Reception/actions_function.php" method="post" autocomplete="off">  
                <?php  
                    /* this will let the id still submit */
                    $array = $_POST['select_id'];
                    $extract_id = implode(' , ' , $array);  

                    /* just for display */
                    $sql = "SELECT *
                            FROM `reception-list`";
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
                            
                            foreach($array as $value){
                                $values = $row['id_name'] . $value;
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
                <a href="../../IMISS-System/2reception.php" class="button_control">Cancel</a> 
            </form>
        </div>
        <?php } else { ?>
        <div> <!-- div for edit -->
            <h3>Edit Reception</h3> 
            <form action="../../IMISS-System/PHP-Reception/actions_function.php" method="post" autocomplete="off">  
                <?php 
                    $array = $_POST['select_id'];
                    $extract_id = implode(' , ' , $array);  

                    $sql = "SELECT CONCAT(id_name, $extract_id) AS full_id,
                            reception_fname, reception_mname, reception_lname, username, password   
                            FROM `reception-list` WHERE id = $extract_id LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>  
                <div class="input_field no_display"> <!-- this will let the id still submit  -->
                    <input type="text" name="edit_item[]" id="edit_item" value="<?php echo $extract_id?>">
                    <label for="edit_item">ID:</label>
                </div> 
                <div class="input_field"> <!-- just for display -->
                    <input type="text" value="<?php echo $row['full_id']?>" disabled>
                    <label for="edit_item">ID:</label>
                </div> 
                <div class="input_field">
                    <input type="text" name="reception_fname" value="<?php echo $row['reception_fname'] ?>" required>
                    <label for="reception_fname">First Name:</label>
                </div>
                <div class="input_field">
                    <input type="text" name="reception_mname" value="<?php echo $row['reception_mname'] ?>" required>
                    <label for="reception_mname">Middle Name:</label>
                </div>
                <div class="input_field">
                    <input type="text" name="reception_lname" value="<?php echo $row['reception_lname'] ?>" required>
                    <label for="reception_lname">Last Name:</label>
                </div>
                <div class="input_field">
                    <input type="text" name="username" value="<?php echo $row['username'] ?>" required>
                    <label for="username">Username:</label>
                </div>
                <div class="input_field"> 
                    <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_edit()"></i>
                    <input type="password" name="password" id="edit_password" value="<?php echo $row['password'] ?>" required>
                    <label for="password">Password:</label>
                </div>  
                <div class="input_field no_display">
                    <?php $updated_name = $_SESSION['superadmin_fname']." ". $_SESSION['superadmin_mname']." ". $_SESSION['superadmin_lname'] ?>
                    <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                    <label for="updated_by">Updated by:</label>
                </div> 
                <button type="submit" name="edit_submit" id="edit_submit" class="button_control">Edit</button> 
                <a href="../../IMISS-System/2reception.php" class="button_control">Cancel</a> 
            </form>
        </div> 
        <?php } ?>
        </div> <!-- all_forms closer -->
    </div>
    </div>
    <script src="../../IMISS-System/SCRIPT/toggle_visibility.js"></script>
</body>
</html>  