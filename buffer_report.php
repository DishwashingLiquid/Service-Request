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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>IMISS System</title>
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">generate report</div>
        <!-- NOTIFICATION FOR SUCCESSFUL REPORT GENERATION -->
            <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert_msg" role="alert">
                ' . $msg . '
                <a href="7report.php"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
            ?> 
        <div class="report">  
        <form action="" method="POST">
           <!--  <div class="input_field">
                <input type="text" id="status" name="status" value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>"/>
                <label for="status">Status</label>
            </div>   -->
           <!--  <div class="input_field">
                <input type="text" id="department" name="department" value="<?php if (isset($_POST['department'])) echo $_POST['department']; ?>"/>
                <label for="department">Department</label>
            </div>   -->
            <div class="input_field"> 
                <select name="status" id="status" >
                    <option value="" disabled selected hidden></option>
                    <option value="On-going"
                        <?= isset($_POST['status']) == true ? ($_POST['status'] == 'On-going' ? 'selected':'') :'' ?>
                    >On-going</option> 
                    <option value="Pending"
                        <?= isset($_POST['status']) == true ? ($_POST['status'] == 'Pending' ? 'selected':'') :'' ?>
                    >Pending</option> 
                    <option value="Resolved"
                        <?= isset($_POST['status']) == true ? ($_POST['status'] == 'Resolved' ? 'selected':'') :'' ?>
                    >Resolved</option> 
                </select>
                <label for="status">Status:</label>
            </div> 
            <div class="input_field"> 
                <select name="department" id="department" >
                    <option value="" disabled selected hidden></option>
                    <option value="">IMISS Manual Request</option>
                        <?php
                            $sql = "SELECT department FROM `end-user-list`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <option value="<?php echo $row["department"] ?>"> <?php echo $row["department"] ?></option>
                        <?php } ?>
                </select>
                <label for="department">Department:</label>
            </div>  
                <button type="submit" class="button_control" name="submit">Preview</button>
                <a href="" class="button_control">Clear filter</a>  
            <br><br>
            <div>       
                <button type="submit" class="button_control" name="export_excel" >Generate Report</button>
            </div>         
        </form> 
        <div class="container">
        <table>
            <thead class="table_header">
                <tr>
                <th scope="col">status</th>
                    <th scope="col">service request no.</th>
                    <th scope="col">date requested</th>
                    <th scope="col">department</th>
                    <th scope="col">full name</th>
                    <th scope="col">ict equipment code</th>
                    <th scope="col">description</th>
                    <th scope="col">type of service</th>  
                    <th scope="col">ict component</th>  
                    <th scope="col">ict component specifications</th>  
                    <th scope="col">assessment</th>  
                    <th scope="col">remarks</th>    
                    <th scope="col">assigned to</th>    
                </tr>
            </thead>
            <tbody>
                <?php 
                 if(isset($_POST['submit'])) { 
                    $status = $_POST['status'];  
                    $department = $_POST['department']; 
                    if($department != "" || $status != "") {
                    $sql = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, b.department, b.end_user_name, c.id, c.admin_name
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            LEFT JOIN `admin-list` c
                            ON a.admin_id = c.id
                            WHERE a.status = '$status' || b.department = '$department'
                            ORDER BY datetime_requested DESC
                            "; 
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['status'];
                            $id = $row['full_id'];
                            $datetime_requested = $row['datetime_requested'];
                            $department = $row['department'];
                            $end_user_name = $row['end_user_name'];
                            $ict_equipment_code = $row['ict_equipment_code'];
                            $description = $row['description']; 
                            $type_of_service = $row['type_of_service'];
                            $ict_component = $row['ict_component'];
                            $ict_component_spec = $row['ict_component_spec']; 
                            $assessment = $row['assessment'];
                            $remarks = $row['remarks']; 
                            $admin_name = $row['admin_name']; 
                ?>
                <tr class="table_row">
                    <td><?php echo $status; ?></td>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td> 
                    <td><?php 
                    $department = $row['department']; 
                    if(empty($department)){
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["department"];
                    }
                    ?></td>
                    <td><?php 
                    $end_user_name = $row["end_user_name"];
                    if(empty($end_user_name)) {
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["end_user_name"];
                    }
                    ?></td>
                    <td><?php echo $ict_equipment_code; ?></td>
                    <td><?php echo $description; ?></td> 
                    <td><?php echo $type_of_service; ?></td> 
                    <td><?php echo $ict_component; ?></td> 
                    <td><?php echo $ict_component_spec; ?></td> 
                    <td><?php echo $assessment; ?></td>
                    <td><?php echo $remarks; ?></td>   
                    <td><?php echo $admin_name; ?></td>                       
                </tr>
                <?php } } else { ?> <!-- else for filter with no records found -->
                    <td colspan="13">
                        <div class="empty_state">
                            <figure>
                                <img src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no records found</figcaption>
                            </figure>
                        </div>
                    </td> 
                <?php } } else { ?> <!-- else for imiss manual request records -->
                <?php $sql = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, b.department, b.end_user_name, c.id, c.admin_name
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            LEFT JOIN `admin-list` c
                            ON a.admin_id = c.id
                            WHERE a.end_user_id = '0' || a.status = '$status'
                            ORDER BY datetime_requested DESC
                            "; 
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['status'];
                            $id = $row['full_id'];
                            $datetime_requested = $row['datetime_requested'];
                            $department = $row['department'];
                            $end_user_name = $row['end_user_name'];
                            $ict_equipment_code = $row['ict_equipment_code'];
                            $description = $row['description']; 
                            $type_of_service = $row['type_of_service'];
                            $ict_component = $row['ict_component'];
                            $ict_component_spec = $row['ict_component_spec']; 
                            $assessment = $row['assessment'];
                            $remarks = $row['remarks']; 
                            $admin_name = $row['admin_name']; 
                ?>
                <tr class="table_row">
                    <td><?php echo $status; ?></td>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td> 
                    <td><?php 
                    $department = $row['department']; 
                    if(empty($department)){
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["department"];
                    }
                    ?></td>
                    <td><?php 
                    $end_user_name = $row["end_user_name"];
                    if(empty($end_user_name)) {
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["end_user_name"];
                    }
                    ?></td>
                    <td><?php echo $ict_equipment_code; ?></td>
                    <td><?php echo $description; ?></td> 
                    <td><?php echo $type_of_service; ?></td> 
                    <td><?php echo $ict_component; ?></td> 
                    <td><?php echo $ict_component_spec; ?></td> 
                    <td><?php echo $assessment; ?></td>
                    <td><?php echo $remarks; ?></td>   
                    <td><?php echo $admin_name; ?></td>                       
                </tr>
                <?php } } } } else { ?> <!-- else for no filter selected yet -->
                    <td colspan="13">
                        <div class="empty_state">
                            <figure>
                                <img src="../IMISS-System/CSS/images/empty_state.jpg" alt="empty state">
                                <figcaption>no filter selected yet</figcaption>
                            </figure>
                        </div>
                    </td>
                <?php } ?>
            </tbody>
        </table>
        </div> <!-- closer for container -->
        </div> <!-- closer for report -->
    </div>
    </div>
</body>
</html>
                     


















BETTER DESIGN



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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Service Request System</title>
</head>
<body>
    <?php require "nav_bar.php" ?>
    <div class="section">
    <div class="paper">
        <div class="titlebar">generate report</div>
        <!-- NOTIFICATION FOR SUCCESSFUL REPORT GENERATION -->
            <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert_msg" role="alert">
                ' . $msg . '
                <a href="7report.php"><i class="fa-solid fa-xmark"></i></a>
                </div>';
            }
            ?> 
        <div class="report">  
        <form action="" method="POST"> 
            <div class="input_field"> 
                <select name="status" id="status" >
                    <option value="" disabled selected hidden></option>
                    <option value="On-going"
                        <?= isset($_POST['status']) == true ? ($_POST['status'] == 'On-going' ? 'selected':'') :'' ?>
                    >On-going</option> 
                    <option value="Pending"
                        <?= isset($_POST['status']) == true ? ($_POST['status'] == 'Pending' ? 'selected':'') :'' ?>
                    >Pending</option> 
                    <option value="Resolved"
                        <?= isset($_POST['status']) == true ? ($_POST['status'] == 'Resolved' ? 'selected':'') :'' ?>
                    >Resolved</option> 
                </select>
                <label for="status">Status:</label>
            </div> 
            <div class="input_field"> 
                <select name="department" id="department" >
                    <option value="" disabled selected hidden></option>
                    <option value="">IMISS Manual Request</option>
                        <?php
                            $sql = "SELECT department FROM `end-user-list`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <option value="<?php echo $row["department"] ?>"> <?php echo $row["department"] ?></option>
                        <?php } ?>
                </select>
                <label for="department">Department:</label>
            </div> 
                <!-- buttons for report -->
                    <button type="submit" class="button_control" name="submit">Preview</button>
                    <a href="" class="button_control">Clear filter</a> <br><br>
                    <div><button type="submit" class="button_control" name="export_excel" >Generate Report</button></div>         
        </form> 
        <div class="container">
        <table>
            <thead class="table_header">
                <tr>
                <th scope="col">status</th>
                    <th scope="col">service request no.</th>
                    <th scope="col">date requested</th>
                    <th scope="col">department</th>
                    <th scope="col">full name</th>
                    <th scope="col">ict equipment code</th>
                    <th scope="col">description</th>
                    <th scope="col">type of service</th>  
                    <th scope="col">ict component</th>  
                    <th scope="col">ict component specifications</th>  
                    <th scope="col">assessment</th>  
                    <th scope="col">remarks</th>    
                    <th scope="col">assigned to</th>    
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_POST['status']) && $_POST['status'] != '' && isset($_POST['department']) && $_POST['department'] != ''){
                    $status = $_POST['status'];
                    $department = $_POST['department'];
                    $sql = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, b.department, b.end_user_name, c.id, c.admin_name
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            LEFT JOIN `admin-list` c
                            ON a.admin_id = c.id
                            WHERE a.status = '$status' || b.department = '$department'
                            ORDER BY datetime_requested DESC
                            "; 
                    $result = mysqli_query($conn, $sql);
                } else {
                    $sql_one = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, b.department, b.end_user_name, c.id, c.admin_name
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            LEFT JOIN `admin-list` c
                            ON a.admin_id = c.id 
                            ORDER BY datetime_requested DESC
                            "; 
                    $result = mysqli_query($conn, $sql_one);
                } 
                
                if($result) {
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['status'];
                            $id = $row['full_id'];
                            $datetime_requested = $row['datetime_requested'];
                            $department = $row['department'];
                            $end_user_name = $row['end_user_name'];
                            $ict_equipment_code = $row['ict_equipment_code'];
                            $description = $row['description']; 
                            $type_of_service = $row['type_of_service'];
                            $ict_component = $row['ict_component'];
                            $ict_component_spec = $row['ict_component_spec']; 
                            $assessment = $row['assessment'];
                            $remarks = $row['remarks']; 
                            $admin_name = $row['admin_name']; ?>

                        <tr class="table_row">
                            <td><?php echo $status; ?></td>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $row["datetime_requested"]; ?></td> 
                            <td><?php 
                            $department = $row['department']; 
                            if(empty($department)){
                                echo "IMISS Manual Request";
                            } else {
                                echo $row["department"];
                            }
                            ?></td>
                            <td><?php 
                            $end_user_name = $row["end_user_name"];
                            if(empty($end_user_name)) {
                                echo "IMISS Manual Request";
                            } else {
                                echo $row["end_user_name"];
                            }
                            ?></td>
                            <td><?php echo $ict_equipment_code; ?></td>
                            <td><?php echo $description; ?></td> 
                            <td><?php echo $type_of_service; ?></td> 
                            <td><?php echo $ict_component; ?></td> 
                            <td><?php echo $ict_component_spec; ?></td> 
                            <td><?php echo $assessment; ?></td>
                            <td><?php echo $remarks; ?></td>   
                            <td><?php echo $admin_name; ?></td>                       
                        </tr>
                <?php } } }?>
            </tbody>
        </table>
        </div> <!-- closer for container -->
        </div> <!-- closer for report -->
    </div>
    </div>
</body>
</html>



ELSE FOR USER ID MANUAL Request


<?php $sql = "SELECT a.status, a.ict_equipment_code, a.description, a.type_of_service, a.ict_component, 
                                a.ict_component_spec, a.assessment, a.remarks, a.end_user_id, a.admin_id,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id, 
                                CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, b.department, b.end_user_name, c.id, c.admin_name
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            LEFT JOIN `admin-list` c
                            ON a.admin_id = c.id
                            WHERE a.end_user_id = '0' AND a.status = '$status'
                            ORDER BY datetime_requested DESC
                            "; 
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['status'];
                            $id = $row['full_id'];
                            $datetime_requested = $row['datetime_requested'];
                            $department = $row['department'];
                            $end_user_name = $row['end_user_name'];
                            $ict_equipment_code = $row['ict_equipment_code'];
                            $description = $row['description']; 
                            $type_of_service = $row['type_of_service'];
                            $ict_component = $row['ict_component'];
                            $ict_component_spec = $row['ict_component_spec']; 
                            $assessment = $row['assessment'];
                            $remarks = $row['remarks']; 
                            $admin_name = $row['admin_name']; 
                ?>
                <tr class="table_row">
                    <td><?php echo $status; ?></td>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row["datetime_requested"]; ?></td> 
                    <td><?php 
                    $department = $row['department']; 
                    if(empty($department)){
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["department"];
                    }
                    ?></td>
                    <td><?php 
                    $end_user_name = $row["end_user_name"];
                    if(empty($end_user_name)) {
                        echo "IMISS Manual Request";
                    } else {
                        echo $row["end_user_name"];
                    }
                    ?></td>
                    <td><?php echo $ict_equipment_code; ?></td>
                    <td><?php echo $description; ?></td> 
                    <td><?php echo $type_of_service; ?></td> 
                    <td><?php echo $ict_component; ?></td> 
                    <td><?php echo $ict_component_spec; ?></td> 
                    <td><?php echo $assessment; ?></td>
                    <td><?php echo $remarks; ?></td>   
                    <td><?php echo $admin_name; ?></td>                       
                </tr>