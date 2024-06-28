<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])) {
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
        <div class="titlebar">end-user</div>
        <div class="all_forms">
        <?php if(isset($_POST["approve_button"])) { ?>
        <div> <!-- div for approve -->
            <h3>Approve End-User</h3>
            <form action="../../IMISS-System/PHP-End-User-Approve/actions_function.php" method="post" autocomplete="off">
                <?php
                    /* this will let the id still submit */
                    $array = $_POST['select_id'];
                    $extract_id = implode(' , ', $array);

                    /* just for display */
                    $sql = "SELECT * FROM `end-user-list`
                            WHERE id = $extract_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                    <div class="input_field no_display"> <!-- this will let the id still submit -->
                        <input type="text" name="approve_item[]" id="approve_item" value="<?php echo $extract_id ?>">
                        <label for="approve_item"></label>
                    </div> 
                    <div class="input_field"> <!-- just for display -->
                        <textarea id="for_approve" disabled><?php
                                /* added the code below to remove last comma on array of ids */
                                $num_items = count($array);
                                $num_count = 0;

                                foreach($array as $value) {
                                    $values = $row['id_name'] . $value;
                                    echo $values;
                                    $num_count = $num_count + 1;

                                    if($num_count < $num_items) {
                                        echo ", ";
                                    }
                                }
                        ?></textarea>
                        <label for="approve_item"></label>
                    </div>
                    <div class="input_field no_display"> <!-- for submitting data to actions_functions -->
                        <input type="text" name="division" id="division" value="<?php echo $row['division'] ?>">
                        <input type="text" name="area" id="area" value="<?php echo $row['area']?>">
                        <input type="text" name="end_user_fname" id="end_user_fname" value="<?php echo $row['end_user_fname'] ?>">
                        <input type="text" name="end_user_mname" id="end_user_mname" value="<?php echo $row['end_user_mname'] ?>">
                        <input type="text" name="end_user_lname" id="end_user_lname" value="<?php echo $row['end_user_lname'] ?>">
                        <input type="text" name="contact_no" id="contact_no" value="<?php echo $row['contact_no'] ?>">
                        <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>">
                        <input type="text" name="username" id="username" value="<?php echo $row['username'] ?>">
                        <input type="text" name="password" id="password" value="<?php echo $row['password'] ?>">
                        <input type="text" name="is_approved" id="is_approved" value="true"> 
                        <input type="text" name="subject" value="Your account is approved!"> 
                        <input type="text" name="message"
                            value="
                                <p><b>Welcome to ARMMC IMISS System.</b></p>
                                <p>You can now login on the IMISS System using the username and password you registered.</p>
                                <br>
                                <p>We're constantly striving to provide a better service. We'd love if you could take 1min. to give us some feedback by visiting our survey link:</p>
                                <a href='https://tinyurl.com/ihomp-satisfaction-survey/'>ihomp-satisfaction-survey</a>
                                "> 
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
                    <button type="submit" name="approve_submit" id="approve_submit" class="button_control">Approve</button>
                    <a href="../../IMISS-System/3end-user_approve.php" class="button_control">Cancel</a>
            </form>
        </div>
        <?php } ?>
        </div>
    </div>
    </div>
</body>
</html>