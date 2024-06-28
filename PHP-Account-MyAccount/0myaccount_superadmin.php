<?php
    session_start();
    if(isset($_SESSION['log_superadmin'])) {
        require "../../IMISS-System/db_conn.php"
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
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_superadmin.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if (isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . ' 
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_superadmin.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_superadmin.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_superadmin.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
        ?>
        <div class="my_account">  
            <div>
                <p class="account_name"><?php echo $_SESSION['superadmin_fname'], " ", $_SESSION['superadmin_mname'], " ", $_SESSION['superadmin_lname']; ?></p>
                <p>Super Admin</p> 
            <form action="" method="post" autocomplete="off">
                <div class="input_field">
                    <input type="text" name="id" value="<?php echo "SUPER-", $_SESSION['id'] ?>" disabled>
                    <label for="id">ID:</label>
                </div> 
                <div class="input_field">
                    <input type="text" name="username" value="<?php echo $_SESSION['username'] ?>" disabled>
                    <label for="username">Username:</label>
                </div>
                <?php
                    $id = $_SESSION['id'];
                    $sql = "SELECT password FROM `superadmin-list`
                            WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                <div class="input_field">
                    <input type="password" name="password" value="<?php echo $row["password"] ?>" disabled>
                    <label for="password">Password:</label>
                </div>
            </form> 
            <div class="input_field">
                <a href="../../IMISS-System/PHP-Account-ChangePass/0changepass_super.php" class="button_control">Change Password</a>
            </div>
            <a href="../../IMISS-System/PHP-Account-Settings/0logout_index_two.php" class="button_control" style="background-color: red; color: #fff;">LOG OUT <i class="fa-solid fa-right-from-bracket"></i></a>
            <a href="../../IMISS-System/2reception.php" class="button_control">Cancel</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php
    } else {
        header("Location: ../../IMISS-System/index_two.php");
        exit();
    }
    ?>