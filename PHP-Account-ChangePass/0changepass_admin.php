<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
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
        <div class="titlebar">my account</div>
        <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
        <?php
            if (isset($_GET["dng"])) {
                $dng = $_GET["dng"];
                echo '<div class="danger_msg" role="alert">
                ' . $dng . ' 
                <a href="../../IMISS-System/PHP-Account-ChangePass/0changepass_admin.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if (isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . ' 
                <a href="../../IMISS-System/PHP-Account-ChangePass/0changepass_admin.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../../IMISS-System/PHP-Account-ChangePass/0changepass_admin.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../../IMISS-System/PHP-Account-ChangePass/0changepass_admin.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
        ?>
        <div class="my_account">
            <div>
                <p class="account_name">Change Password</p> 
                <form action="../../IMISS-System/PHP-Account-ChangePass/0changepass_admin_function.php" method="POST">
                    <?php 
                        $id = $_SESSION['id'];
                        $sql = "SELECT password FROM `admin-list`
                                WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?> 
                    <div class="input_field no_display">
                        <input type="password" name="password" id="password" value="<?php echo $row['password'];?>">
                        <label for="password">Password:</label>
                    </div>
                    <div class="input_field"> 
                        <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_current()"></i>
                        <input type="password" name="current_password" id="current_password" required>
                        <label for="current_password">Current Password:</label> 
                    </div>
                    <div class="input_field">
                        <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_new()"></i>
                        <input type="password" name="new_password" id="new_password" required>
                        <label for="new_password">New Password:</label>
                    </div>
                    <div class="input_field">
                        <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_confirm()"></i>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <label for="confirm_password">Confirm Password:</label>
                    </div> 
                    <div class="input_field">
                        <button type="submit" name="admin_submit" class="button_control">Save</button>
                        <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_admin.php" class="button_control">Cancel</a>
                    </div>
                </form> 
            </div> <!-- closer for empty div -->
        </div> <!-- closer for my_account -->
    </div>
    </div>
    <script src="../../IMISS-System/SCRIPT/toggle_visibility.js"></script>
</body>
</html>
