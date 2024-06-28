<?php 
    session_start();
    require "../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_admin"]) && ! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])) {
         header("Location: index_two.php");
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMISS System</title>

    <link rel="stylesheet" href="../IMISS-System/index.css">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">ICT Equipment Inventory</div>
            <div class="inventory"> 
                <div class="inventory_one">
                    <a href="../IMISS-System/PHP-Inventory/actions_desktop.php"><i class="fa-solid fa-computer"></i><p>Desktop</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_laptop.php"><i class="fa-solid fa-laptop"></i><p>Laptop</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_ups.php"><i class="fa-regular fa-hard-drive"></i><p>UPS</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_printer.php"><i class="fa-solid fa-print"></i><p>Printer</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_scanner.php"><i class="fa-solid fa-fax"></i><p>Scanner</p></a> 
                </div>
                <div class="inventory_two">
                    <a href="../IMISS-System/PHP-Inventory/actions_server.php"><i class="fa-solid fa-server"></i><p>Server</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_router.php"><i class="fa-solid fa-network-wired"></i><p>Router</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_switch.php"><i class="fa-solid fa-memory"></i></i><p>Switch</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_kiosk.php"><i class="fa-solid fa-tablet-screen-button"></i><p>Kiosk</p></a>
                    <a href="../IMISS-System/PHP-Inventory/actions_tv.php"><i class="fa-solid fa-tv"></i><p>TV</p></a> 
                </div>
            </div> 
    </div>
    </div>   
</body>
</html>