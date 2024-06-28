<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_admin"]) && ! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])) {
        header("Location: index_two.php");
    }

    /* submit for add */
    if(isset($_POST["add_submit"])) {
        $area = $_POST['area'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $specification = $_POST['specification'];
        $application = $_POST['application'];
        $updated_by = $_POST['updated_by'];

        $sql = "INSERT INTO `equipment-list-server`
                    (`area`, `brand`, `model`, `specification`, `application`, `updated_by`)
                VALUES
                    ('$area', '$brand', '$model', '$specification', '$application', '$updated_by')
                ";
        $result = mysqli_query($conn, $sql);

    if($result) {
        header("Location: ../../IMISS-System/PHP-Inventory/actions_server.php?scs=Added successfully.");
    } else {
        echo "Failed: " . mysqli_error($conn);
        }
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
        <div class="titlebar">server</div>
        <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
        <?php
            if (isset($_GET["dng"])) {
                $dng = $_GET["dng"];
                echo '<div class="danger_msg" role="alert">
                ' . $dng . '
                <a href="../../IMISS-System/PHP-Inventory/actions_server.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if(isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . '
                <a href="../../IMISS-System/PHP-Inventory/actions_server.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../../IMISS-System/PHP-Inventory/actions_server.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../../IMISS-System/PHP-Inventory/actions_server.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } 
        ?>
        <!-- CONTROLS ON THE TOP -->
        <div class="controls">
            <a href="../../IMISS-System/0inventory.php" class="button_control"><i class="fa-solid fa-arrow-left"></i>Back</a>
        </div>
        <form action="" method="POST" autocomplete="off">
            <div class="all_forms" style="margin-top: 0vh">
                <div class="inventory_spec">
                    <?php
                        $today = date("Y"); /* to get next id_year */
                        $sql = "SELECT MAX(id) as max_id
                                FROM `equipment-list-server`";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $next_id = $row['max_id'] + 1; /* to get the next auto-id */
                    ?>
                    <div class="input_field top_id">
                        <input type="text" name="next_id" id="next_id" value="<?php echo 'SRV-', $today, '-', $next_id ?>" disabled>
                        <label for="next_id">ICT Equipment Code:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="area" id="area" required>
                        <label for="area">Area:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="brand" id="brand" required>
                        <label for="brand">Brand:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="model" id="model" required>
                        <label for="model">Model:</label>
                    </div>
                    <div class="input_field">
                        <input type="text" name="application" id="application" required>
                        <label for="application">Application:</label>
                    </div>  
                    <div class="input_field">
                        <textarea name="specification" id="specification" style="height: 17.6vh;" required></textarea>
                        <label for="specification">Specification:</label>
                    </div> 
                    <?php 
                        if(!empty($_SESSION['reception_fname'])) { ?>
                            <div class="input_field no_display"> 
                                <?php $updated_name = $_SESSION['reception_fname']." ". $_SESSION['reception_mname']." ". $_SESSION['reception_lname']?>
                                <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                                <label for="updated_by">Updated by:</label> 
                            </div>
                        <?php } else if(!empty($_SESSION['superadmin_fname'])) { ?>
                            <div class="input_field no_display"> 
                                <?php $updated_name = $_SESSION['superadmin_fname']." ".$_SESSION['superadmin_mname']." ".$_SESSION['superadmin_lname']?>
                                <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                                <label for="updated_by">Updated by:</label> 
                            </div>
                        <?php } else { ?> 
                            <div class="input_field no_display"> 
                                <?php $updated_name = $_SESSION['admin_fname']." ".$_SESSION['admin_mname']." ".$_SESSION['admin_lname']?>
                                <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                                <label for="updated_by">Updated by:</label> 
                            </div>
                    <?php } ?>
                </div> <!-- closer for inventory_spec -->
            </div> <!-- closer for all_forms --> 
            <div class="inventory_controls">
                <button type="submit" name="add_submit" id="add_submit" class="button_control">Add</button>
                <a href="" class="button_control">Clear</a>
            </div>
        </form>

        <form action="" method="POST">
            <div class="input_field no_display">
                <input type="text" name="status" id="status" value="Inactive">
                    <label for="status">Status:</label>
            </div>
            <?php 
                if(!empty($_SESSION['reception_fname'])) { ?>
                    <div class="input_field no_display"> 
                        <?php $updated_name = $_SESSION['reception_fname']." ". $_SESSION['reception_mname']." ". $_SESSION['reception_lname']?>
                        <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                            <label for="updated_by">Updated by:</label> 
                        </div>
                <?php } else if(!empty($_SESSION['superadmin_fname'])) { ?>
                    <div class="input_field no_display"> 
                        <?php $updated_name = $_SESSION['superadmin_fname']." ".$_SESSION['superadmin_mname']." ".$_SESSION['superadmin_lname']?>
                        <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                            <label for="updated_by">Updated by:</label> 
                        </div>
                <?php } else { ?> 
                    <div class="input_field no_display"> 
                        <?php $updated_name = $_SESSION['admin_fname']." ".$_SESSION['admin_mname']." ".$_SESSION['admin_lname']?>
                        <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required> 
                            <label for="updated_by">Updated by:</label> 
                        </div>
                <?php } ?>
        <!-- TABLE DATA -->
        <div class="container" style="height: 50.5vh;">
        <table>
            <thead class="table_header">
            <tr> 
                <th scope="col">ict equipment code</th>
                <th scope="col">area</th>
                <th scope="col">brand</th>
                <th scope="col">model</th>
                <th scope="col">specification</th>
                <th scope="col">application</th>
                <th scope="col">status</th>
                <th scope="col">updated by</th>
            </tr>
            </thead>
            <tbody>
                    <?php
                        $sql = "SELECT CONCAT(id_name, '-', id_year, '-', id) AS full_id, 
                                id, area, brand, model, specification, application, status, updated_by
                                FROM `equipment-list-server`
                                ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            foreach($result as $row){
                    ?>
                <tr class="table_row"> 
                    <td><a href="../../IMISS-System/PHP-Inventory/functions_server.php?id=<?php echo $row['id']?>"><?php echo $row["full_id"]?></a></td>
                    <td><?php echo $row["area"]?></td>
                    <td><?php echo $row["brand"]?></td>
                    <td><?php echo $row["model"]?></td>
                    <td><?php echo $row["specification"]?></td>
                    <td><?php echo $row["application"]?></td>
                    <td><?php echo $row["status"]?></td>
                    <td><?php echo $row["updated_by"]?></td>
                </tr>
                <?php } } else { ?>
                    <td colspan="8">
                        <div class="empty_state">
                            <figure>
                                <img src="../../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no records found</figcaption>
                            </figure>
                        </div>
                    </td>
                <?php } ?>    
            </tbody>
        </table>
        </div> <!-- closer for container --> 
        </form>
        <!-- TABLE CONTROLS -->
        <div class="table_control">
            <?php
                $sql = "SELECT * FROM `equipment-list-server`
                        WHERE status = 'Active'";
                if($result = mysqli_query($conn, $sql)){
                    $row_count = mysqli_num_rows($result);
                }
            ?> 
            <?php
                $sql = "SELECT * FROM `equipment-list-server`
                        WHERE status = 'Inactive'";
                if($result = mysqli_query($conn, $sql)){
                    $row_count_one = mysqli_num_rows($result);
                }
            ?>
            <p>Total number of Active Equipment: <b><?php echo $row_count ?></b></p>
            <p>Total number of Inactive Equipment: <b><?php echo $row_count_one ?></b></p>
        </div>
    </div>
    </div> 
</body>
</html>