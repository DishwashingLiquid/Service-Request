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
            <form action="../../IMISS-System/PHP-Account-Register/0register_actions_function.php" method="post" autocomplete="off">
                <?php 
                    $division = $_POST['division'];
                    $area = $_POST['area'];
                    $end_user_fname = $_POST['end_user_fname'];
                    $end_user_mname = $_POST['end_user_mname'];
                    $end_user_lname = $_POST['end_user_lname'];
                    $contact_no = $_POST['contact_no'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];  
                ?>
                <div class="display_field">
                    <label for="division">Division:</label> <br>
                        <input type="text" name="division" id="division" value="<?php echo $division ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="area">Area/Section/Unit:</label>
                        <input type="text" name="area" id="area" value="<?php echo $area ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="end_user_fname">First Name:</label> <br>
                        <input type="text" name="end_user_fname" id="end_user_fname" value="<?php echo $end_user_fname ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="end_user_mname">Middle Name:</label> <br>
                        <input type="text" name="end_user_mname" id="end_user_mname" value="<?php echo $end_user_mname ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="end_user_lname">Last Name:</label> <br>
                        <input type="text" name="end_user_lname" id="end_user_lname" value="<?php echo $end_user_lname ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="contact_no">Contact Number:</label> <br>
                        <input type="text" name="contact_no" id="contact_no" value="<?php echo $contact_no ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="email">Email Address:</label> <br>
                        <input type="text" name="email" id="email" value="<?php echo $email ?>" readonly>
                </div>
                <div class="display_field">
                    <label for="username">Username:</label> <br>
                        <input type="text" name="username" id="username" value="<?php echo $username ?>" readonly>
                </div>   
                <div class="display_field"> 
                    <label for="password">Password:</label> <br>
                        <input type="password" name="password" id="password" value="<?php echo $password ?>">
                </div>
                <div class="display_field no_display"> 
                    <label for="is_approved">Is Approved:</label> <br>
                        <input type="text" name="is_approved" id="is_approved" value="false">
                </div>
                <div class="input_field">
                    <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_confirm()" style="margin-left: 17vw;"></i>
                    <input type="password" name="confirm_pass" id="confirm_password" required>
                        <label for="confirm_pass">Confirm Password:</label>
                </div> 
                <div class="no_display">     
                    <input type="text" name="subject" value="Your registration is complete!"> 
                    <input type="text" name="message"
                        value="
                            <p><b>Thank you for joining ARMMC IMISS System.</b></p>
                            <p>An email will be sent once your registration is approved.</p>
                            <br>
                            <p>We're constantly striving to provide a better service. We'd love if you could take 1min. to give us some feedback by visiting our survey link:</p>
                            <a href='https://tinyurl.com/ihomp-satisfaction-survey/'>ihomp-satisfaction-survey</a>
                            ">
                </div> 
                <div class="input_field">
                    <button type="submit" name="register" class="button_control button_login" >CONFIRM</button>
                    <a href="../../IMISS-System/index.php" class="button_control button_login" >HAVE AN ACCOUNT?</a> 
                </div> 
            </form> 
        </div> 
    </div>
    </div> 
    <script src="../../IMISS-System/SCRIPT/toggle_visibility.js"></script>
</body>
</html>