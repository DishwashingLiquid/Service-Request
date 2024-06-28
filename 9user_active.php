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
    require "../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_user"])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../IMISS-System/index.php">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title>
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">active request</div>
        <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
        <?php
            if (isset($_GET["dng"])) {
                $dng = $_GET["dng"];
                echo '<div class="danger_msg" role="alert">
                ' . $dng . ' 
                <a href="../IMISS-System/9user_active.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if (isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . ' 
                <a href="../IMISS-System/9user_active.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../IMISS-System/9user_active.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../IMISS-System/9user_active.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
        ?>
        <!-- CONTROLS ON THE TOP -->
        <div class="controls"> 
                <br>
                <br>
                <br>  
            </div>
        <!-- TABLE DATA -->
        <div class="container">
        <table>
            <thead class="table_header">
            <tr>
                <th scope="col">service request no.</th>
                <th scope="col">date requested</th>  
                <th scope="col">area</th>
                <th scope="col">ict equipment code</th> 
                <th scope="col">description</th> 
                <th scope="col">assigned to</th>   
                <th scope="col">status</th>   
            </tr>
            </thead>

            <tbody>
                    <?php
                    $end_user_id = $_SESSION['id'];    
                    $sql = "SELECT   CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                    CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, 
                                    a.id AS take_id, a.ict_equipment_code, a.description, a.status, a.end_user_id, a.admin_id,
                                    b.id, c.id, CONCAT(c.admin_fname, ' ', c.admin_mname, ' ', c.admin_lname) as full_admin,
                                    CONCAT(d.id_name, '-', d.id_year, '-', d.id) AS full_d, d.area AS area_d,
                                    CONCAT(e.id_name, '-', e.id_year, '-', e.id) AS full_e, e.area AS area_e,
                                    CONCAT(f.id_name, '-', f.id_year, '-', f.id) AS full_f, f.area AS area_f,
                                    CONCAT(g.id_name, '-', g.id_year, '-', g.id) AS full_g, g.area AS area_g,
                                    CONCAT(h.id_name, '-', h.id_year, '-', h.id) AS full_h, h.area AS area_h,
                                    CONCAT(i.id_name, '-', i.id_year, '-', i.id) AS full_i, i.area AS area_i,
                                    CONCAT(j.id_name, '-', j.id_year, '-', j.id) AS full_j, j.area AS area_j,
                                    CONCAT(k.id_name, '-', k.id_year, '-', k.id) AS full_k, k.area AS area_k,
                                    CONCAT(l.id_name, '-', l.id_year, '-', l.id) AS full_l, l.area AS area_l,
                                    CONCAT(m.id_name, '-', m.id_year, '-', m.id) AS full_m, m.area AS area_m
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id 
                            LEFT JOIN `admin-list` c
                            ON a.admin_id = c.id
                            
                            LEFT JOIN `equipment-list-desktop` d
                            ON a.ict_equipment_code =  CONCAT(d.id_name, '-', d.id_year, '-', d.id)
                            LEFT JOIN `equipment-list-laptop` e
                            ON a.ict_equipment_code = CONCAT(e.id_name, '-', e.id_year, '-', e.id)
                            LEFT JOIN `equipment-list-ups` f
                            ON a.ict_equipment_code = CONCAT(f.id_name, '-', f.id_year, '-', f.id)
                            LEFT JOIN `equipment-list-printer` g
                            ON a.ict_equipment_code = CONCAT(g.id_name, '-', g.id_year, '-', g.id)
                            LEFT JOIN `equipment-list-scanner` h
                            ON a.ict_equipment_code = CONCAT(h.id_name, '-', h.id_year, '-', h.id)
                            LEFT JOIN `equipment-list-server` i
                            ON a.ict_equipment_code = CONCAT(i.id_name, '-', i.id_year, '-', i.id)
                            LEFT JOIN `equipment-list-router` j
                            ON a.ict_equipment_code = CONCAT(j.id_name, '-', j.id_year, '-', j.id)
                            LEFT JOIN `equipment-list-switch` k
                            ON a.ict_equipment_code = CONCAT(k.id_name, '-', k.id_year, '-', k.id)
                            LEFT JOIN `equipment-list-kiosk` l
                            ON a.ict_equipment_code = CONCAT(l.id_name, '-', l.id_year, '-', l.id)
                            LEFT JOIN `equipment-list-tv` m
                            ON a.ict_equipment_code = CONCAT(m.id_name, '-', m.id_year, '-', m.id)

                            WHERE a.end_user_id = '$end_user_id'
                            AND a.status != 'Resolved'
                            ORDER BY datetime_requested DESC
                            ";
                     
                    $result = mysqli_query($conn, $sql); 
                    if(mysqli_num_rows($result) > 0) {
                        foreach($result as $row) {
                    ?>
                <tr class="table_row">
                    <td>
                    <?php
                        $status = $row['status'];
                        if($status === 'Pending'){ ?>
                           <a href="../IMISS-System/PHP-Dashboard-User/view_request.php?id=<?php echo $row["take_id"] ?>"><?php echo $row["full_id"]; ?></a> 
                        <?php } else {
                            echo $row["full_id"];
                        }
                    ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td>  

                    <td><?php echo $row["area_d"], $row["area_e"], $row["area_f"], $row["area_g"], $row["area_h"], 
                                    $row["area_i"], $row["area_j"], $row["area_k"], $row["area_l"], $row["area_m"]?></td>
                    <td><?php echo $row["full_d"], $row["full_e"], $row["full_f"], $row["full_g"], $row["full_h"],
                                    $row["full_i"], $row["full_j"], $row["full_k"], $row["full_l"], $row["full_m"] ?></td> 
                    
                    <td><?php echo $row["description"] ?></td> 
                    <td><?php 
                        $admin_id = $row['admin_id'];
                        if (!empty($admin_id)) {
                        echo $row["full_admin"];
                        } else {
                            echo "--";
                        } ?></td>    
                    <td><?php 
                        $status = $row['status'];
                        if (!empty($admin_id)) {
                            echo $row["status"];
                        }else {
                            echo "<i>Not yet assigned</i>";
                        }
                         ?></td>  
                </tr>

                <?php } } else { ?>
                    <td colspan="7">
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
        <!-- TABLE CONTROLS -->
        <div class="table_control">
            <?php
                $sql = "SELECT * FROM `request-list`
                            WHERE end_user_id = '$end_user_id'
                            AND status != 'Resolved'";
                if($result = mysqli_query($conn, $sql)){
                    $row_count = mysqli_num_rows($result);
                }
            ?> 
            <p>Total number of rows: <?php echo $row_count ?></p>
        </div>
    </div>
    </div>
</body>
</html>