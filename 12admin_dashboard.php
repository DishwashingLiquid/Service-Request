<?php
    session_start();
    if(isset($_SESSION['log_admin'])) {
        require "db_conn.php";
        $admin_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="320;url=12admin_dashboard.php" />

    <link rel="stylesheet" href="../IMISS-System/index.css">
    <link rel="stylesheet" href="../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title>
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">Dashboard</div>
        <div class="dashboard">
        <div class="dashboard_icons">
            <a href="../IMISS-System/13admin_claim.php">
                <h3>Unassigned Requests</h3>
                <i class="fa-brands fa-get-pocket"></i> 
                    <?php
                        $sql = "SELECT id FROM `request-list`
                                WHERE status = 'On-going'
                                AND admin_id = 0";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        } 
                    ?>
                <div class="count">
                    <?php echo count($results); ?>
                </div>   
                <div class="refresh_update">update:
                    <?php
                        date_default_timezone_set("Asia/Manila");
                        echo date("y-m-d : H:i:s");
                    ?>
                </div> 
            </a>
            <a href="../IMISS-System/14admin_active.php">
                <h3>Active Requests</h3>
                <i class="fa-solid fa-ticket"></i>
                    <?php 
                        $sql = "SELECT id FROM `request-list`
                                WHERE status = 'On-going'
                                AND admin_id = '$admin_id' ";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        } 
                    ?>
                <div class="count">
                    <?php echo count($results); ?>
                </div>
                <div class="refresh_update">update:
                    <?php
                        date_default_timezone_set("Asia/Manila");
                        echo date("y-m-d : H:i:s");
                    ?>
                </div>
            </a>
            <a href="../IMISS-System/15admin_pending.php">
                <h3>Pending Requests</h3>
                <i class="fa-solid fa-spinner"></i>
                    <?php
                        $sql = "SELECT id from `request-list`
                                WHERE status = 'Pending'
                                AND admin_id = '$admin_id'";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        } 
                    ?>
                <div class="count">
                    <?php echo count($results); ?>
                </div>
                <div class="refresh_update">update:
                    <?php
                        date_default_timezone_set("Asia/Manila");
                        echo date("y-m-d : H:i:s");
                    ?>
                </div>
            </a>
            <a href="../IMISS-System/16admin_resolved.php">
                <h3>Resolved Requests</h3>
                <i class="fa-solid fa-circle-check"></i>
                    <?php
                        $sql = "SELECT id from `request-list`
                                WHERE status = 'Resolved'
                                AND admin_id = '$admin_id'";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        } 
                    ?>  
                <div class="count">
                    <?php echo count($results); ?>
                </div>
                <div class="refresh_update">update:
                    <?php
                        date_default_timezone_set("Asia/Manila");
                        echo date("y-m-d : H:i:s");
                    ?>
                </div>
            </a>
        </div>
        <div class="dashboard_record">
        <div class="records"> 
            <h3>Record for the Month of <?php echo date('F');?></h3>
            <p>Total Number of Requests Assigned: 
                    <?php
                        $current_month = date('m'); 
                        $sql = "SELECT id from `request-list`
                                WHERE status = 'On-going'
                                AND admin_id = '$admin_id'
                                AND MONTH(date_requested) = '$current_month'";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        } 
                    ?>  
                <span>
                    <?php echo count($results); ?>
                </span> 
            </p> 
            <p>Total Number of Requests Resolved: 
                    <?php
                        $current_month = date('m');
                        $sql = "SELECT id from `request-list`
                                WHERE status = 'Resolved'
                                AND admin_id = '$admin_id'
                                AND MONTH(date_requested) = '$current_month'";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        }
                    ?>
                <span>
                    <?php echo count($results); ?>
                </span>
            </p> 
        </div>
        <div class="records">
            <h3>Record for the Year <?php echo date('Y');?></h3>
            <p>Total Number of Requests Assigned: 
                    <?php
                        $current_year = date('Y'); 
                        $sql = "SELECT id from `request-list`
                                WHERE status = 'On-going'
                                AND admin_id = '$admin_id'
                                AND YEAR(date_requested) = '$current_year'";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        } 
                    ?>  
                <span>
                    <?php echo count($results); ?>
                </span> 
            </p> 
            <p>Total Number of Requests Resolved: 
                    <?php
                        $current_year = date('Y');
                        $sql = "SELECT id from `request-list`
                                WHERE status = 'Resolved'
                                AND admin_id = '$admin_id'
                                AND YEAR(date_requested) = '$current_year'";
                        $result = mysqli_query($conn, $sql);
                        $results = array();
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $results[] = $row;
                        }
                    ?>
                <span>
                    <?php echo count($results); ?>
                </span>
            </p> 
        </div>  
        </div> 
        <h4><em>Recently Resolved Requests</em></h4>
        <div class="dashboard_container"> 
        <table>
            <thead class="table_header">
            <tr>
                <th scope="col">service request no.</th>
                <th scope="col">date requested</th>
                <th scope="col">full name</th>
                <th scope="col">area</th>
                <th scope="col">ict equipment code</th>
                <th scope="col">description</th> 
                <th scope="col">type of service</th>  
                <th scope="col">ict component</th>   
                <th scope="col">ict component specifications</th>   
                <th scope="col">assessment</th>  
                <th scope="col">remarks</th>   
                <th scope="col">service rendered</th>
                <th scope="col">date pending</th>
                <th scope="col">date resolved</th>    
            </tr>
            </thead>
            <tbody>
                    <?php
                    $admin_id = $_SESSION['id'];  
                    $sql = "SELECT CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, 
                                CONCAT(a.date_pending, ' : ', a.time_pending) AS datetime_pending,
                                CONCAT(a.date_resolved, ' : ', a.time_resolved) AS datetime_resolved, 
                                a.end_user_id, a.admin_id, a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component,
                                a.ict_component_spec, a.assessment, a.remarks, a.service_rendered,
                                CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) as full_user,  b.id,
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
                            WHERE a.admin_id = '$admin_id'
                            AND a.status = 'Resolved'
                            ORDER BY datetime_requested DESC
                            LIMIT 8
                            "; 
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        foreach($result as $row) {
                    ?>
                <tr class="table_row">
                    <td><?php echo $row["full_id"] ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td> 
                    <td><?php 
                            $end_user_name = $row["full_user"];
                            if(empty($end_user_name)) {
                                echo "IMISS Manual Request";
                            } else {
                                echo $row["full_user"];
                            }
                            ?>
                        </td>
                    <td><?php echo $row["area_d"], $row["area_e"], $row["area_f"], $row["area_g"], $row["area_h"], 
                                $row["area_i"], $row["area_j"], $row["area_k"], $row["area_l"], $row["area_m"]?></td>
                    <td><?php echo $row["full_d"], $row["full_e"], $row["full_f"], $row["full_g"], $row["full_h"],
                                $row["full_i"], $row["full_j"], $row["full_k"], $row["full_l"], $row["full_m"] ?></td> 
                    <td><?php echo $row["description"] ?></td>
                    <td><?php echo $row["type_of_service"] ?></td> 
                    <td><?php echo $row["ict_component"] ?></td> 
                    <td><?php echo $row["ict_component_spec"] ?></td> 
                    <td><?php echo $row["assessment"] ?></td>
                    <td><?php echo $row["remarks"] ?></td>
                    <td><?php echo $row["service_rendered"]?></td>  
                    <td><?php
                        $datetime_pending = $row["datetime_pending"];
                        if($datetime_pending === "0000-00-00 : 00:00:00"){
                            echo "N/A";
                        } else {
                            echo $row["datetime_pending"];
                        }
                    ?></td>
                    <td><?php echo $row["datetime_resolved"]; ?></td> 
                </tr>
                <?php } } else { ?>
                    <td colspan="14">
                        <div class="empty_state" style="margin-top: 5vh;">
                            <figure>
                                <img style="height: 18vh; width: 10vw;" src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no records found</figcaption>
                            </figure>
                        </div>
                    </td>
                <?php }?>
            </tbody>
        </table>
        </div>
        </div>
        <!-- TABLE CONTROLS -->
        <div class="table_control">
            <?php
                $sql = "SELECT * FROM `request-list`
                            WHERE admin_id = '$admin_id'
                            AND status = 'Resolved'";
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
<?php
} else {
    header("Location: index_two.php");
    exit();
}
?>