<?php
    session_start();
    require "../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_admin"]) && ! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: index_two.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../IMISS-System/index.css">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title>
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">ICT Equipment History</div>
        <!-- NOTIFICATION FOR ADD/EDIT/DELETE -->
        <?php
            if (isset($_GET["dng"])) {
                $dng = $_GET["dng"];
                echo '<div class="danger_msg" role="alert">
                ' . $dng . ' 
                <a href="../IMISS-System/0history.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if (isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . ' 
                <a href="../IMISS-System/0history.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../IMISS-System/0history.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../IMISS-System/0history.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
        ?>
        <!-- CONTROLS ON THE TOP -->
        <form action="" method="post" autocomplete="off">
        <div class="controls" display="flex">
            <div class="input_field" id="for_ict_code"> 
                <select name="ict_equipment_code" id="ict_equipment_code" required>
                <option value="" disabled selected hidden></option>
                        <?php  
                            $sql = "SELECT DISTINCT ict_equipment_code 
                                    FROM `request-list`
                                    ORDER BY ict_equipment_code ASC";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                <option value="<?php echo $row['ict_equipment_code'] ?>"><?php echo $row["ict_equipment_code"] ?></option>
                        <?php } ?>
                </select>   
                <label for="ict_equipment_code">Select ICT Equipment Code:</label> 
                <button type="submit" name="view_button" id="view_button" class="button_control">View</button>     
            </div>
        </div> 
        </form> 
        <!-- TABLE DATA --> 
        <div class="container">    
        <table>
            <thead class="table_header">
            <tr>
              <!--   <th scope="col"><input type="checkbox"
                                class="select_all"
                                value="one"
                                onclick='call_all("select_all")'>
                </th> -->
                <th scope="col">date requested</th>
                <th scope="col">area</th>
                <th scope="col">service request no.</th>
                <th scope="col">description</th>
                <th scope="col">type of service</th>
                <th scope="col">ict component</th>
                <th scope="col">ict component spec</th>
                <th scope="col">assessment</th>
                <th scope="col">remarks</th>
                <th scope="col">service rendered</th>
                <th scope="col">assigned to</th>
                <th scope="col">date pending</th>
                <th scope="col">date resolved</th>
                <th scope="col">status</th> 
            </tr>
            </thead>

            <tbody>
                <?php 
                 if(isset($_POST['view_button'])) {   
                    $ict_equipment_code = $_POST['ict_equipment_code']; 
                    $sql = "SELECT CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id,
                                    CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested,
                                    CONCAT(a.date_pending, ' : ', a.time_pending) AS datetime_pending,
                                    CONCAT(a.date_resolved, ' : ', a.time_resolved) AS datetime_resolved, a.*, 
                                    CONCAT(b.admin_fname, ' ', b.admin_mname, ' ', b.admin_lname) as full_admin,  b.id,
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
                            FROM `request-list`  a
                            LEFT JOIN `admin-list` b
                            ON a.admin_id = b.id
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
                            WHERE ict_equipment_code = '$ict_equipment_code'
                            ORDER BY datetime_requested DESC";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        foreach($result as $row) {
                ?>
                <tr class="table_row">
                <!--  <td><input type="checkbox"
                                name="select_id[]"
                                value="<?php= $row['id']; ?>"
                                class="select_id"
                                onclick='call_action("select_id")'>
                    </td> -->  
                    <td><?php echo $row["datetime_requested"] ?></td>
                    <td><?php echo $row["area_d"], $row["area_e"], $row["area_f"], $row["area_g"], $row["area_h"], 
                                    $row["area_i"], $row["area_j"], $row["area_k"], $row["area_l"], $row["area_m"]?></td> 
                    <td><?php echo $row["full_id"] ?></td>
                    <td><?php echo $row["description"] ?></td>
                    <td><?php echo $row["type_of_service"] ?></td>
                    <td><?php echo $row["ict_component"] ?></td>
                    <td><?php echo $row["ict_component_spec"] ?></td>
                    <td><?php echo $row["assessment"] ?></td>
                    <td><?php echo $row["remarks"] ?></td>
                    <td><?php echo $row["service_rendered"] ?></td>
                    <td><?php echo $row["full_admin"] ?></td>
                    <td><?php 
                        $datetime_pending = $row['datetime_pending'];
                        if($datetime_pending === "0000-00-00 : 00:00:00"){
                            echo "N/A";
                        } else {
                            echo $row["datetime_pending"];
                        } 
                    ?></td>
                    <td><?php 
                        $datetime_resolved = $row['datetime_resolved'];
                        if($datetime_resolved === "0000-00-00 : 00:00:00"){
                            echo "N/A";
                        } else {
                            echo $row["datetime_resolved"];
                        }
                    ?></td>
                    <td><?php echo $row["status"] ?></td>   
                </tr>
                <?php } } else { ?>
                    <td colspan="11">
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
        </div> <!-- closer for container --> 
        <?php }  else { ?>
                    <td colspan="12">
                        <div class="empty_state">
                            <figure>
                                <img src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no code selected yet</figcaption>
                            </figure>
                        </div>
                    </td>
                <?php }?>
        <!-- TABLE CONTROLS -->  
        <div class="table_control">
            <?php
                if(isset($_POST['view_button'])) {
                $sql = "SELECT * FROM `request-list`
                         WHERE ict_equipment_code = '$ict_equipment_code'";
                if($result = mysqli_query($conn, $sql)){
                    $row_count = mysqli_num_rows($result);
                }
            ?> 
            <p>Total number of rows: <?php echo $row_count ?></p>
            <?php } ?>
        </div>
    </div>
    </div>
    <script src="../IMISS-System/SCRIPT/button_disabled.js"></script>
</body>
</html>