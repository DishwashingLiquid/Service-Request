<?php 
    session_start();
    require "../IMISS-System/db_conn.php"; 
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: index_two.php");
    }   
    if(isset($_POST['export_excel']) ) {
        $admin_id = $_POST['admin_id'];
        $service_rendered = $_POST['service_rendered'];
        $from_origdate = $_POST['from_date'];
        $to_origdate = $_POST['to_date'];
        /* convert the format to align with db */
        $from_date = date("Y-m-d", strtotime($from_origdate));
        $to_date = date("Y-m-d", strtotime($to_origdate));      
        if($admin_id != "" || $service_rendered != "" || $from_date != "" || $to_date != "")  {
            $sql = "SELECT a.status, 
                        CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                        CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested,
                        b.division, a.end_user_id, CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) as full_user,
                        a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, a.ict_component_spec, a.assessment, a.remarks, a.service_rendered,
                        CONCAT(a.date_resolved, ' : ', a.time_resolved) AS datetime_resolved, 
                        a.admin_id, CONCAT(c.admin_fname, ' ', c.admin_mname, ' ', c.admin_lname) as full_admin,
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
                    WHERE a.status = 'Resolved'
                        AND (a.date_requested >= '$from_date' 
                        AND a.date_requested <= '$to_date' 
                        AND (a.admin_id = '$admin_id' OR '$admin_id' = 'All')
                        AND (a.service_rendered = '$service_rendered' OR '$service_rendered' = 'All'))
                    ORDER BY datetime_requested DESC
                    ";  
            $result = mysqli_query($conn, $sql);
            $records = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $records[] = $row;
                }
                $filename = "export_report".date('Ymd') . ".xls";
                    header("Content-Type: application/vnd.ms-excel");
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                $show_column = false;
                if(!empty($records)) {
                    foreach($records as $record) {
                        if(!$show_column) {
                            echo implode("\t", array_keys($record)) . "\n";
                            $show_column = true;
                        }
                            echo implode("\t", array_values($record)) . "\n";
                        }
                    }
                    exit;
            } }  
    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>IMISS System</title>

    <link rel="stylesheet" type="text/css" href="../IMISS-System/FILTER/css files/jquery-ui.css">
    <script type="text/javascript" src="../IMISS-System/FILTER/js files/jquery-ui.js"></script>
    <script type="text/javascript" src="../IMISS-System/FILTER/js files/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="../IMISS-System/FILTER/js files/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $( function () {
            $( "#from" ).datepicker();
        });
        $( function() {
            $( "#to" ).datepicker();
        });
    </script>
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">generate report</div>
        <!-- NOTIFICATION FOR SUCCESSFUL REPORT GENERATION -->
        <?php
            if (isset($_GET["dng"])) {
                $dng = $_GET["dng"];
                echo '<div class="danger_msg" role="alert">
                ' . $dng . ' 
                <a href="../IMISS-System/7report.php" id="danger_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if (isset($_GET["scs"])) {
                $scs = $_GET["scs"];
                echo '<div class="success_msg" role="alert">
                ' . $scs . ' 
                <a href="../IMISS-System/7report.php" id="success_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            } else if (isset($_GET["info"])) {
                $info = $_GET["info"];
                echo '<div class="info_msg" role="alert">
                ' . $info . ' 
                <a href="../IMISS-System/7report.php" id="info_close"><i class="fa-solid fa-xmark"></i></a>
                </div>'; 
            } else if(isset($_GET["wng"])) {
                $wng = $_GET["wng"];
                echo '<div class="warning_msg" role="alert">
                ' . $wng . ' 
                <a href="../IMISS-System/7report.php" id="warning_close"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
        ?> 
        <div class="report">  
        <form action="" method="POST" autocomplete="off">
            <div class="input_field"> 
                <select name="admin_id" id="admin_id">
                <!-- <option value="" disabled selected hidden></option> -->
                <option value="All">Select All</option>
                        <?php  
                            $sql = "SELECT DISTINCT a.admin_id, b.id, CONCAT(b.admin_fname, ' ', b.admin_mname, ' ', b.admin_lname) AS full_name
                                    FROM `request-list` a
                                    LEFT JOIN `admin-list` b
                                    ON a.admin_id = b.id
                                    ORDER BY admin_id ASC";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                <option value="<?php echo $row['admin_id'] ?>"><?php echo $row["full_name"] ?></option>
                        <?php } ?>
                </select>  
                <label for="admin_id" >Select IMISS Staff:</label> 
            </div>
            <div class="input_field">
                <select name="service_rendered" id="service-rendered">
                <!-- <option value="" disabled selected hidden></option> -->
                <option value="All">Select All</option>
                    <?php
                        $sql = "SELECT DISTINCT service_rendered
                                FROM `request-list`
                                ";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)){
                    ?>
                <option value="<?php echo $row['service_rendered'] ?>"><?php echo $row['service_rendered']; ?></option>
                        <?php } ?>
                </select>
                <label for="service_rendered">Service Rendered:</label>
            </div>
            <div class="input_field">
                <input type="text" name="from_date" id="from" required>
                <label for="from_date">From:</label>
            </div>
            <div class="input_field">
                <input type="text" name="to_date" id="to" required>
                <label for="to_date">To:</label>
            </div>
                <button type="submit" class="button_control" name="submit">Preview</button>
                <a href="" class="button_control">Clear filter</a><br><br>
                <div><button type="submit" class="button_control" name="export_excel" >Generate Report</button></div>         
        </form> 
        <div class="container_one">
        <div class="container">
        <table>
            <thead class="table_header">
                <tr> 
                    <th scope="col">service request no.</th>
                    <th scope="col">date requested</th>
                    <th scope="col">division</th>
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
                    <th scope="col">assigned to</th>    
                </tr>
            </thead>
            <tbody>
                <?php 
                 if(isset($_POST['submit'])) {  
                    $admin_id = $_POST['admin_id']; 
                    $service_rendered = $_POST['service_rendered'];
                    $from_origdate = $_POST['from_date']; 
                    $to_origdate = $_POST['to_date']; 
                    /* convert the format to align with db */
                    $from_date = date("Y-m-d", strtotime($from_origdate));  
                    $to_date = date("Y-m-d", strtotime($to_origdate));  
                    if($admin_id != "" || $service_rendered != "" || $from_date != "" || $to_date != "") {
                    $sql = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.service_rendered, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, 
                                CONCAT(a.date_pending, ' : ', a.time_pending) AS datetime_pending,
                                CONCAT(a.date_resolved, ' : ', a.time_resolved) AS datetime_resolved, 
                                b.division, CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) as full_user,
                                c.id, CONCAT(c.admin_fname, ' ', c.admin_mname, ' ', c.admin_lname) as full_admin,
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
                            WHERE a.status = 'Resolved'
                                AND (a.date_requested >= '$from_date' 
                                AND a.date_requested <= '$to_date' 
                                AND (a.admin_id = '$admin_id' OR '$admin_id' = 'All')
                                AND (a.service_rendered = '$service_rendered' OR '$service_rendered' = 'All'))
                            ORDER BY datetime_requested DESC
                            ";   
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                            $id = $row['full_id'];
                            $datetime_requested = $row['datetime_requested'];
                            $division = $row['division'];
                            $end_user_name = $row['full_user'];
                            $ict_equipment_code = $row['ict_equipment_code'];
                            $description = $row['description']; 
                            $type_of_service = $row['type_of_service'];
                            $ict_component = $row['ict_component'];
                            $ict_component_spec = $row['ict_component_spec']; 
                            $assessment = $row['assessment'];
                            $remarks = $row['remarks']; 
                            $service_rendered = $row['service_rendered'];
                            $datetime_pending = $row['datetime_pending'];
                            $datetime_resolved = $row['datetime_resolved'];
                            $admin_name = $row['full_admin']; 
                ?>
                <tr class="table_row"> 
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td> 
                    <td><?php 
                    $division = $row['division']; 
                    if(empty($division)){
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["division"];
                    }
                    ?></td>
                    <td><?php 
                    $end_user_name = $row["full_user"];
                    if(empty($end_user_name)) {
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["full_user"];
                    }
                    ?></td>
                      <td><?php echo $row["area_d"], $row["area_e"], $row["area_f"], $row["area_g"], $row["area_h"], 
                                    $row["area_i"], $row["area_j"], $row["area_k"], $row["area_l"], $row["area_m"]?></td>
                    <td><?php echo $row["full_d"], $row["full_e"], $row["full_f"], $row["full_g"], $row["full_h"],
                                    $row["full_i"], $row["full_j"], $row["full_k"], $row["full_l"], $row["full_m"] ?></td> 
                    <td><?php echo $description; ?></td> 
                    <td><?php echo $type_of_service; ?></td> 
                    <td><?php echo $ict_component; ?></td> 
                    <td><?php echo $ict_component_spec; ?></td> 
                    <td><?php echo $assessment; ?></td>
                    <td><?php echo $remarks; ?></td>   
                    <td><?php echo $service_rendered; ?></td>
                    <td><?php
                        $datetime_pending = $row["datetime_pending"];
                        if($datetime_pending === "0000-00-00 : 00:00:00") {
                            echo "N/A";
                        } else {
                            echo $row["datetime_pending"];
                        }
                    ?></td>
                    <td><?php echo $datetime_resolved ?></td>
                    <td><?php echo $admin_name; ?></td>                       
                </tr>
                <?php } } else { ?> <!-- else for filter with no records found -->
                    <td colspan="14">
                        <div class="empty_state">
                            <figure>
                                <img src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no records found</figcaption>
                            </figure>
                        </div>
                    </td> 
                <?php } } else { ?> <!-- else for no filter selected yet but preview is clicked -->
                    <td colspan="14">
                        <div class="empty_state">
                            <figure>
                                <img src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no filter selected yet</figcaption>
                            </figure>
                        </div>
                    </td>
                <?php  } } else { ?> <!-- else for no filter selected yet -->
                <?php  
                    $sql = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.service_rendered, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, 
                                CONCAT(a.date_pending, ' : ', a.time_pending) AS datetime_pending,
                                CONCAT(a.date_resolved, ' : ', a.time_resolved) AS datetime_resolved, 
                                b.division, CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) as full_user,
                                c.id, CONCAT(c.admin_fname, ' ', c.admin_mname, ' ', c.admin_lname) as full_admin,
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
                            WHERE a.status = 'Resolved'
                            ORDER BY datetime_requested DESC
                            ";  
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                            $id = $row['full_id'];
                            $datetime_requested = $row['datetime_requested'];
                            $division = $row['division'];
                            $end_user_name = $row['full_user'];
                            $ict_equipment_code = $row['ict_equipment_code'];
                            $description = $row['description']; 
                            $type_of_service = $row['type_of_service'];
                            $ict_component = $row['ict_component'];
                            $ict_component_spec = $row['ict_component_spec']; 
                            $assessment = $row['assessment'];
                            $remarks = $row['remarks']; 
                            $service_rendered = $row['service_rendered'];
                            $datetime_pending = $row['datetime_pending'];
                            $datetime_resolved = $row['datetime_resolved'];
                            $admin_name = $row['full_admin']; 
                ?>
                <tr class="table_row"> 
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td> 
                    <td><?php 
                    $division = $row['division']; 
                    if(empty($division)){
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["division"];
                    }
                    ?></td>
                    <td><?php 
                    $end_user_name = $row["full_user"];
                    if(empty($end_user_name)) {
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["full_user"];
                    }
                    ?></td>
                    <td><?php echo $row["area_d"], $row["area_e"], $row["area_f"], $row["area_g"], $row["area_h"], 
                                    $row["area_i"], $row["area_j"], $row["area_k"], $row["area_l"], $row["area_m"]?></td>
                    <td><?php echo $row["full_d"], $row["full_e"], $row["full_f"], $row["full_g"], $row["full_h"],
                                    $row["full_i"], $row["full_j"], $row["full_k"], $row["full_l"], $row["full_m"] ?></td> 
                    <td><?php echo $description; ?></td> 
                    <td><?php echo $type_of_service; ?></td> 
                    <td><?php echo $ict_component; ?></td> 
                    <td><?php echo $ict_component_spec; ?></td> 
                    <td><?php echo $assessment; ?></td>
                    <td><?php echo $remarks; ?></td>   
                    <td><?php echo $service_rendered; ?></td>
                    <td><?php
                        $datetime_pending = $row["datetime_pending"];
                        if($datetime_pending === "0000-00-00 : 00:00:00"){
                            echo "N/A";
                        } else {
                            echo $row["datetime_pending"];
                        }
                    ?></td>
                    <td><?php echo $datetime_resolved ?></td>
                    <td><?php echo $admin_name; ?></td>                       
                </tr>
                <?php } } }?>
            </tbody>
        </table>
        </div> <!-- closer for container -->
        <!-- TABLE CONTROLS -->
        <div class="table_control" style="margin-left">
            <?php
                if(isset($_POST['submit'])) {
                $sql = "SELECT * FROM `request-list`
                            WHERE status = 'Resolved' 
                            AND (date_requested >= '$from_date' 
                            AND date_requested <= '$to_date' 
                            AND (admin_id = '$admin_id' OR '$admin_id' = 'All')
                            AND (service_rendered = '$service_rendered' OR '$service_rendered' = 'All'))";
                if($result = mysqli_query($conn, $sql)){
                    $row_count = mysqli_num_rows($result);
                }
            ?> 
            <p>Total number of rows: <?php echo $row_count ?></p>
            <?php } ?>
        </div>
        </div>
        </div> <!-- closer for report -->
    </div>
    </div>
</body>
</html>