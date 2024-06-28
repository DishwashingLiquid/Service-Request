<?php
    session_start();
    require "../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"])){
        header("Location: index.php");
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
    <?php require "nav_bar.php" ?>  
    <div class="section">
    <div class="paper">  
        <div class="titlebar">list of admin</div>
        <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
        <?php
            if (isset($_GET["msg"])) {
              $msg = $_GET["msg"];
              echo '<div class="alert_msg" role="alert">
              ' . $msg . ' 
              <a href="1admin.php"><i class="fa-solid fa-xmark"></i></a>
            </div>';
            }
            ?>
        <!-- CONTROLS ON THE TOP -->
        <div class="controls">
            <a href="../IMISS-System/PHP-Admin/add_admin.php" class="button_control">Add New</a>
           
            <form action="" method="post" autocomplete="off">
                <input type="text" name="search" placeholder="Search here" value="">
                <button class="button_control">Search</button>
            </form>
        </div>
        <!-- TABLE DATA --> 
        <div class="container">
        <table>
            <thead class="table_header">
            <tr>
                <th scope="col">id</th>
                <th scope="col">full name</th>
                <th scope="col">username</th>
                <th scope="col">password</th> 
                <th scope="col">actions</th> 
            </tr>
            </thead> 
            <tbody>  
                    <?php 
                        if(isset($_POST['search'])){
                            $searchKey = $_POST['search'];
                            $sql = "SELECT * FROM `admin-list`
                                    WHERE id LIKE '%$searchKey%'";
                        }else{
                            $sql = "SELECT * FROM `admin-list`";
                            $searchKey = "";
                        }
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_object($result)) {
                    ?>
                <tr class="table_row">
                <td><?php echo $row->id ?></td>
                <td><?php echo $row->admin_name ?></td>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->password ?></td> 
                <td> 
                    <a href="../IMISS-System/PHP-Admin/edit_admin.php?id=<?php echo $row->id ?>" class="edit_btn"><i class="fa-solid fa-pen-to-square"></i></a>  
                    
                    <a href="../IMISS-System/PHP-Admin/delete_admin.php?id=<?php echo $row->id ?>" class="delete_btn"><i class="fa-solid fa-trash"></i></a>
                </td>
                </tr>

                <?php
                    } 
                ?>
            </tbody> 
        </table>  
        </div>
        <!-- TABLE CONTROLS --> 
        <div class="table_control">

        </div>  
    </div>
    </div>
</body>
</html>

 


