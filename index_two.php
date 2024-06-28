<?php
    require "db_conn.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link rel="stylesheet" href="../IMISS-System/index.css">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
    <title>Login</title>  
</head>
<body> 
    <div class="section_paper">
    <div class="login_tabs">
        <div class="header">   
            <h2>IMISS SYSTEM</h2>  
            <img src="../IMISS-System/CSS/images/logo.png" alt="ARMMC Logo">
        </div>
        <div class="tabs"> 
        <input class="input no_display" name="tabs" type="radio" id="admin" checked="checked"/>
        <label class="label" for="admin">IMISS Staff</label>
            <div class="panel">
            <form id="admin-login" action="../IMISS-System/PHP-Account-Settings/0login_admin.php" method="post" autocomplete="off">
                <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
                <?php
                    if (isset($_GET["dng"])) {
                        $dng = $_GET["dng"];
                        echo '<div class="danger_msg" role="alert">
                        ' . $dng . ' 
                        <a href="../IMISS-System/index_two.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>'; 
                    } else if (isset($_GET["scs"])) {
                        $scs = $_GET["scs"];
                        echo '<div class="success_msg" role="alert">
                        ' . $scs . ' 
                        <a href="../IMISS-System/index_two.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>';
                    } else if (isset($_GET["info"])) {
                        $info = $_GET["info"];
                        echo '<div class="info_msg" role="alert">
                        ' . $info . ' 
                        <a href="../IMISS-System/index_two.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>'; 
                    } else if(isset($_GET["wng"])) {
                        $wng = $_GET["wng"];
                        echo '<div class="warning_msg" role="alert">
                        ' . $wng . ' 
                        <a href="../IMISS-System/index_two.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>';
                    }
                ?>   
                    <div class="input_field">  
                        <input type="text" name="username" id="username" required>  
                        <label for="username">Enter Username:</label>
                    </div>
                    <div class="input_field">
                        <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_admin()" style="margin-left: 17vw;"></i>
                        <input type="password" name="password" id="admin_password" required>  
                        <label for="password">Enter Password:</label> 
                    </div>  
                    <div class="input_field">
                    <button type="submit" class="button_control button_login">LOGIN AS IMISS STAFF</button>
                    </div>
                </form>
            </div>
        <input class="input no_display" name="tabs" type="radio" id="reception"/>
        <label class="label" for="reception">Reception</label>
            <div class="panel">
            <form id="reception-login" action="../IMISS-System/PHP-Account-Settings/0login_reception.php" method="post" autocomplete="off">
                <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
                <?php
                    if (isset($_GET["dng"])) {
                        $dng = $_GET["dng"];
                        echo '<div class="danger_msg" role="alert">
                        ' . $dng . ' 
                        <a href="../IMISS-System/index_two.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>'; 
                    } else if (isset($_GET["scs"])) {
                        $scs = $_GET["scs"];
                        echo '<div class="success_msg" role="alert">
                        ' . $scs . ' 
                        <a href="../IMISS-System/index_two.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>';
                    } else if (isset($_GET["info"])) {
                        $info = $_GET["info"];
                        echo '<div class="info_msg" role="alert">
                        ' . $info . ' 
                        <a href="../IMISS-System/index_two.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>'; 
                    } else if(isset($_GET["wng"])) {
                        $wng = $_GET["wng"];
                        echo '<div class="warning_msg" role="alert">
                        ' . $wng . ' 
                        <a href="../IMISS-System/index_two.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                        </div>';
                    }
                ?>   
                    <div class="input_field">  
                        <input type="text" name="username" id="username" required>  
                        <label for="username">Enter Username:</label>
                    </div>
                    <div class="input_field">
                        <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_reception()" style="margin-left: 17vw;"></i>
                        <input type="password" name="password" id="reception_password" required>  
                        <label for="password">Enter Password:</label> 
                    </div>  
                    <div class="input_field">
                    <button type="submit" class="button_control button_login">LOGIN AS RECEPTION</button>
                    </div>
                </form>
            </div>
        <input class="input no_display" name="tabs" type="radio" id="superadmin"/>
        <label class="label" for="superadmin">Superadmin</label>
            <div class="panel">
                <form id="superadmin-login" action="../IMISS-System/PHP-Account-Settings/0login_superadmin.php" method="post" autocomplete="off">
                    <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
                    <?php
                        if (isset($_GET["dng"])) {
                            $dng = $_GET["dng"];
                            echo '<div class="danger_msg" role="alert">
                            ' . $dng . ' 
                            <a href="../IMISS-System/index_two.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                            </div>'; 
                        } else if (isset($_GET["scs"])) {
                            $scs = $_GET["scs"];
                            echo '<div class="success_msg" role="alert">
                            ' . $scs . ' 
                            <a href="../IMISS-System/index_two.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                            </div>';
                        } else if (isset($_GET["info"])) {
                            $info = $_GET["info"];
                            echo '<div class="info_msg" role="alert">
                            ' . $info . ' 
                            <a href="../IMISS-System/index_two.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                            </div>'; 
                        } else if(isset($_GET["wng"])) {
                            $wng = $_GET["wng"];
                            echo '<div class="warning_msg" role="alert">
                            ' . $wng . ' 
                            <a href="../IMISS-System/index_two.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                            </div>';
                        }
                    ?>   
                            <div class="input_field">  
                                <input type="text" name="username" id="username" required>  
                                <label for="username">Enter Username:</label>
                            </div>
                            <div class="input_field">
                                <i class="fa-solid fa-eye-slash eye_toggle" onclick="toggle_superadmin()" style="margin-left: 17vw;"></i>
                                <input type="password" name="password" id="superadmin_password" required>  
                                <label for="password">Enter Password:</label> 
                            </div>  
                            <div class="input_field">
                            <button type="submit" class="button_control button_login">LOGIN AS SUPERADMIN</button>
                            </div>
                        </form>
                         </div>
        </div> 
    </div>
    </div> 
    <script src="../IMISS-System/SCRIPT/toggle_visibility.js"></script>
</body>
</html>