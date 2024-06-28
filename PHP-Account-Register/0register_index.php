<?php
    require "../../IMISS-System/db_conn.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link rel="stylesheet" href="../../IMISS-System/index.css">
    <link rel="stylesheet" href="../../IMISS-System/CSS/fontawesome/css/all.css">
    <title>Login</title>  
</head>
<body> 
    <div class="section_paper">
    <div class="register_paper"> 
        <div> 
            <form action="../../IMISS-System/PHP-Account-Register/0register_actions.php" method="post" autocomplete="off">
                <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
                <?php
                    if (isset($_GET["dng"])) {
                        $dng = $_GET["dng"];
                        echo '<div class="danger_msg" role="alert">
                        ' . $dng . ' 
                        <a href="../../IMISS-System/PHP-Account-Register/0register_index.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>'; 
                    } else if (isset($_GET["scs"])) {
                        $scs = $_GET["scs"];
                        echo '<div class="success_msg" role="alert">
                        ' . $scs . ' 
                        <a href="../../IMISS-System/PHP-Account-Register/0register_index.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>';
                    } else if (isset($_GET["info"])) {
                        $info = $_GET["info"];
                        echo '<div class="info_msg" role="alert">
                        ' . $info . ' 
                        <a href="../../IMISS-System/PHP-Account-Register/0register_index.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>'; 
                    } else if(isset($_GET["wng"])) {
                        $wng = $_GET["wng"];
                        echo '<div class="warning_msg" role="alert">
                        ' . $wng . ' 
                        <a href="../../IMISS-System/PHP-Account-Register/0register_index.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>';
                    }
                ?>
                <div class="input_field">  
                    <input type="text" name="division" id="division" required>  
                    <label for="division">Enter Division:</label> 
                </div>
                <div class="input_field">
                    <input type="text" name="area" id="area" required>
                    <label for="area">Enter Area/Section/Unit</label>
                </div>
                <div class="input_field">
                    <input type="text" name="end_user_fname" id="end_user_fname" required>  
                    <label for="end_user_fname">Enter First Name:</label> 
                </div>  
                <div class="input_field">
                    <input type="text" name="end_user_mname" id="end_user_mname" required>  
                    <label for="end_user_mname">Enter Middle Name:</label> 
                </div>  
                <div class="input_field">
                    <input type="text" name="end_user_lname" id="end_user_lname" required>  
                    <label for="end_user_lname">Enter Last Name:</label> 
                </div>   
                <div class="input_field">
                    <input type="text" name="contact_no" id="contact_no" required>  
                    <label for="contact_no">Enter Contact Number:</label> 
                </div>
                <div class="input_field">
                    <input type="text" name="email" id="email" required>  
                    <label for="email">Enter Email Address:</label> 
                </div>
                <div class="input_field">
                    <input type="text" name="username" id="username" required>  
                    <label for="username">Enter Username:</label> 
                </div>   
                <div class="input_field">
                    <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_user()" style="margin-left: 17vw;"></i>
                    <input type="password" name="password" id="password" required>  
                    <label for="password">Enter Password:</label> 
                </div>
                <div class="input_field">
                <button type="submit" name="register" class="button_control button_login" >REGISTER</button>
                <a href="../../IMISS-System/index.php" class="button_control button_login" >HAVE AN ACCOUNT?</a> 
                </div> 
            </form> 
        </div> 
    </div>
    </div> 
    <script src="../../IMISS-System/SCRIPT/toggle_visibility.js"></script>
</body>
</html>