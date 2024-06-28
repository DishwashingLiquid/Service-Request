<?php
    session_start();
    require "../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: index_two.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="320;url=1admin.php"/>
    
    <link rel="stylesheet" href="../IMISS-System/index.css">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title>
</head>
<body>
    <?php require "nav_bar.php" ?>  
    <div class="section">
    <div class="paper">  
        <div class="titlebar">imiss staff</div>
        <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
        <?php
            if (isset($_GET["dng"])) {
                $dng = $_GET["dng"];
                echo '<div class="danger_msg" role="alert">
                ' . $dng . ' 
                <a href="../IMISS-System/1admin.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if (isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . ' 
                <a href="../IMISS-System/1admin.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../IMISS-System/1admin.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../IMISS-System/1admin.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
        ?>
        <!-- CONTROLS ON THE TOP -->
        <form action="../IMISS-System/PHP-Admin/actions.php" method="POST"> <!-- used form to add, delete and edit with checkbox work -->
        <div class="controls"> 
            <button type="submit" name="add_button" id="add_button" class="button_control">Add New</button> 
            <button type="submit" name="delete_button" id="delete_button" class="button_control no_display">Delete</button> 
            <button type="submit" name="edit_button" id="edit_button" class="button_control no_display">Edit</button> 
            <!-- <div class="search_field">
                <input type="text"> 
                <div class="inside_search"> --> <!-- used for the button to go inside the search input -->
                   <!--  <button type="submit" name="search_button" id="search_button" class="button_control">Search</button> 
                </div>
            </div> -->
        </div>
        <!-- TABLE DATA --> 
        <div class="container">
        <table>
            <thead class="table_header">
            <tr>
                <th scope="col"><input type="checkbox"  
                            class="select_all" 
                            value="one"
                            onclick='call_all("select_all")'>
                </th>
                <th scope="col">id</th>
                <th scope="col">first name</th>
                <th scope="col">middle name</th>
                <th scope="col">last name</th>
                <th scope="col">username</th>
                <th scope="col">password</th>  
                <th scope="col">updated by</th>  
            </tr>
            </thead>

            <tbody>
                    <?php
                    $sql = "SELECT CONCAT(id_name, id) AS full_id, id, admin_fname, admin_mname, admin_lname, username, password, updated_by FROM `admin-list`
                            ORDER BY id ASC";
                    $result = mysqli_query($conn, $sql);  
                    if(mysqli_num_rows($result) > 0) {
                     foreach($result as $row) {
                    ?>
                <tr class="table_row">
                <td><input type="checkbox" 
                            name="select_id[]"  
                            value="<?= $row['id']; ?>" 
                            class="select_id" 
                            onclick='call_action("select_id")'>
                </td>
                <td><?php echo $row["full_id"] ?></td>
                <td><?php echo $row["admin_fname"] ?></td>
                <td><?php echo $row["admin_mname"] ?></td>
                <td><?php echo $row["admin_lname"] ?></td>
                <td><?php echo $row["username"] ?></td>
                <td><?php echo $row["password"] ?></td>
                <td><?php echo $row["updated_by"] ?></td>
                </tr>

                <?php } } else { ?>
                    <td colspan="8">
                        <div class="empty_state">
                            <figure>
                                <img src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no records found</figcaption>
                            </figure>
                        </div>
                    </td>
                <?php }?>
            </tbody>
        </table>  
        </div> 
        </form>
        <!-- TABLE CONTROLS -->
        <div class="table_control">
            <?php
                $sql = "SELECT * FROM `admin-list`";
                if($result = mysqli_query($conn, $sql)){
                    $row_count = mysqli_num_rows($result);
                }
            ?> 
            <p>Total number of rows: <?php echo $row_count ?></p>
        </div>
    </div>
    </div>   
    <script src="../IMISS-System/SCRIPT/button_disabled.js"></script>
</body>
</html> 