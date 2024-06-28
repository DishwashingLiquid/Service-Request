<?php
    session_start();
        $t=time();
        if (isset($_SESSION['last_timestamp']) && ($t - $_SESSION['last_timestamp'] > 900)) {
            session_destroy();
            session_unset();
            header('location: index.php');
        }else {
            $_SESSION['last_timestamp'] = time();
        }    
    if(isset($_SESSION['log_user'])) {
    
        require "db_conn.php";

        if(isset($_POST["submit"])) {  
            $end_user_name = $_SESSION['end_user_fname']." ".$_SESSION['end_user_mname']." ".$_SESSION['end_user_lname'];  
            $end_user_id = $_SESSION['id'];
            $description = $_POST['description']; 
            $ict_equipment_code = $_POST['ict_equipment_code']; 
        
        $sql = "INSERT INTO `request-list`
                    (`description`, `end_user_id`, `ict_equipment_code`) 
                VALUES
                    ('$description', '$end_user_id', '$ict_equipment_code')";
        
        $result = mysqli_query($conn, $sql);
        
            if ($result) {
                header("Location: ../IMISS-System/8user_dashboard.php?scs=Submitted Successfully");
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
     
    <link rel="stylesheet" href="../IMISS-System/index.css">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title> 
</head>
<body> 
    <?php require "../IMISS-System/nav_bar.php" ?>  
    <div class="section">
    <div class="paper">
        <div class="titlebar">create request</div>
        <div class="all_forms"> 
            <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
           <?php
                if (isset($_GET["dng"])) {
                    $dng = $_GET["dng"];
                    echo '<div class="danger_msg" role="alert">
                    ' . $dng . ' 
                    <a href="../IMISS-System/8user_dashboard.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                    </div>'; 
                } else if (isset($_GET["scs"])) {
                    $scs = $_GET["scs"];
                    echo '<div class="success_msg" role="alert">
                    ' . $scs . ' 
                    <a href="../IMISS-System/8user_dashboard.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                    </div>';
                } else if (isset($_GET["info"])) {
                    $info = $_GET["info"];
                    echo '<div class="info_msg" role="alert">
                    ' . $info . ' 
                    <a href="../IMISS-System/8user_dashboard.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                    </div>'; 
                } else if(isset($_GET["wng"])) {
                    $wng = $_GET["wng"];
                    echo '<div class="warning_msg" role="alert">
                    ' . $wng . ' 
                    <a href="../IMISS-System/8user_dashboard.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                    </div>';
                }
            ?>
            <div>
                <!-- <h3>Hello, <?php echo $_SESSION['end_user_fname'], " ", $_SESSION['end_user_mname'], " ", $_SESSION['end_user_lname']; ?>!</h3>  -->
                <p>Provide a brief description about your request.</p>
            <form action="" method="post"> 
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
                <div class="input_field">
                    <button type="submit" class="button_control" name="submit">Submit<i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </form>  
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php
}
else {
    header("Location: index.php");
    exit();
}
?>