<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])){
        header("Location: ../../IMISS-System/index_two.php");
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
        <div class="titlebar">resolved request</div>
        <div class="all_forms">
            <?php if(isset($_POST["delete_button"])) { ?>
            <div> <!-- div for delete -->
                <h3>Delete Resolved Request</h3>
                <form action="../../IMISS-System/PHP-Resolved/actions_function.php" method="POST" autocomplete="off">
                    <?php
                        /* this will let the id still submit */
                        $array = $_POST['select_id'];
                        $extract_id = implode(' , ', $array);

                        /* just for display */
                        $sql = "SELECT CONCAT(MONTH(date_requested), '-', YEAR(date_requested), '-') AS full_id
                                FROM `request-list`";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="input_field no_display"> <!-- this will let the id still submit -->
                        <input type="text" name="delete_item[]" id="delete_item" value="<?php echo $extract_id ?>">
                        <label for="delete_item"></label>
                    </div>
                    <div class="input_field"> <!-- just for display -->
                        <textarea id="for_delete"><?php
                                /* added the code below to remove last comma on array of ids */
                                $num_items = count($array);
                                $num_count = 0;

                                foreach($array as $value) {
                                    $values = $row['full_id'] . $value;
                                    echo $values;
                                    $num_count = $num_count + 1;

                                    if($num_count < $num_items){
                                        echo ", ";
                                    }
                                }
                        ?></textarea>
                        <label for="delete_item"></label>
                    </div>
                    <button type="submit" name="delete_submit" id="delete_submit" class="button_control">Delete</button>
                    <a href="../../IMISS-System/6resolved.php" class="button_control">Cancel</a>
                </form>
            </div>
            <?php } else { ?>
            <div> <!-- div for edit -->
                <h3>Edit Resolved Request</h3>
                <form action="../../IMISS-System/PHP-Resolved/actions_function.php" method="POST" autocomplete="off">
                <?php
                    $array = $_POST['select_id'];
                    $extract_id = implode(' , ', $array);
                    
                    $sql = "SELECT CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested,
                                CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id,
                                a.id, a.end_user_id, a.ict_equipment_code, a.description, a.assessment, a.remarks, 
                                a.service_rendered, a.type_of_service, a.ict_component, a.ict_component_spec,
                                b.id, b.email 
                            FROM `request-list` a
                            LEFT JOIN `end-user-list` b
                            ON a.end_user_id = b.id
                            WHERE a.id = $extract_id LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                    <div class="column">
                        <div class="column_one">
                            <fieldset id="ict_component">
                                <legend>TYPE OF SERVICE</legend>
                                <input type="radio" id="remote" name="type_of_service" value="Remote" <?php echo ($row['type_of_service'] === 'Remote')?'checked':'' ?>>
                                    <label for="remote">Remote</label>
                                <input type="radio" id="physical" name="type_of_service" value="Physical" <?php echo ($row['type_of_service'] === 'Physical')?'checked':'' ?>>
                                    <label for="physical">Physical</label>
                            </fieldset>
                            <fieldset id="ict_component">
                                <legend style="text-align: center">ICT COMPONENT</legend>
                                <input type="radio" id="hardware_check" class="ict_component" name="ict_component" value="Hardware" onchange="call_component()" <?php echo ($row['ict_component'] === 'Hardware')?'checked':'' ?>>
                                    <label for="hardware_check">Hardware</label>
                                <input type="radio" id="software_check" class="ict_component" name="ict_component" value="Software" onchange="call_component()" <?php echo ($row['ict_component'] === 'Software')?'checked':'' ?>>
                                    <label for="software_check">Software</label>
                            </fieldset>

                            <div class="specifications">
                            <div id="button_hardware">
                            <fieldset> 
                                    <legend style="text-align: center"><i>HARDWARE SPECIFICATIONS</i></legend>  
                                        <?php  
                                            $array_spec = $row['ict_component_spec'];
                                            $array_hard = explode("<br>", $array_spec);   

                                            $array = array('Desktop/Laptop/System Unit Troubleshooting', 'Input Device Troubleshooting', 'Output Device Troubleshooting', 'Protective Device Troubleshooting',
                                                        'Storage Device Troubleshooting', 'Printer Troubleshooting', 'Internet, Network & Cable Management', 'Installation', 
                                                        'Preventive Maintenance', 'Support'); /* to separate the other's value from the array */
    
                                            $others_hard = array_diff($array_hard, $array); 
                                        ?> 
                                        <input type="checkbox" name="ict_component_spec[]" value="Desktop/Laptop/System Unit Troubleshooting" id="desktop" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Desktop/Laptop/System Unit Troubleshooting', $array_hard))?'checked':''?> required disabled>
                                            <label for="desktop">Desktop/Laptop/System Unit Troubleshooting</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Input Device Troubleshooting" id="input" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Input Device Troubleshooting', $array_hard))?'checked':''?> required disabled>
                                            <label for="input">Input Device Troubleshooting</label> <br> 
                                        <input type="checkbox" name="ict_component_spec[]" value="Output Device Troubleshooting" id="output" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Output Device Troubleshooting', $array_hard))?'checked':''?> required disabled>
                                            <label for="output">Output Device Troubleshooting</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Protective Device Troubleshooting" id="device" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Protective Device Troubleshooting', $array_hard))?'checked':''?> required disabled>
                                            <label for="device">Protective Device Troubleshooting</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Storage Device Troubleshooting" id="storage" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Storage Device Troubleshooting', $array_hard))?'checked':''?> required disabled>
                                            <label for="storage">Storage Device Troubleshooting</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Printer Troubleshooting" id="printer" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Printer Troubleshooting', $array_hard))?'checked':''?> required disabled>
                                            <label for="printer">Printer Troubleshooting</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Internet, Network & Cable Management" id="internet" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Internet, Network & Cable Management', $array_hard))?'checked':''?> required disabled>
                                            <label for="internet">Internet, Network & Cable Management</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Installation" id="install" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Installation', $array_hard))?'checked':''?> required disabled>
                                            <label for="install">Installation</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Preventive Maintenance" id="preventive" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Preventive Maintenance', $array_hard))?'checked':''?> required disabled>
                                            <label for="preventive">Preventive Maintenance</label> <br>
                                        <input type="checkbox" name="ict_component_spec[]" value="Support" id="support" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php echo (in_array('Support', $array_hard))?'checked':''?> required disabled>
                                            <label for="support">Support</label> <br>
                                        <input type="checkbox" onchange="call_others()" name="others_hardware" id="others_hardware" class="req_hard" onclick='call_hard("req_hard")' 
                                            <?php if($row['ict_component'] === 'Hardware'){ echo (!empty($others_hard))?'checked':'';} ?> required disabled>
                                            <label for="others_hardware" style="font-size: 1.3vh;">Others <i style="font-size:1vh;">(specify):</i></label>   
                                        <input type="text" name="ict_component_spec[]" 
                                                value="<?php 
                                                    if($row['ict_component'] === 'Hardware'){
                                                    if(!empty($others_hard)){  
                                                        $other = implode($others_hard);
                                                        echo $other;
                                                    }}
                                                ?>" 
                                                id="others_hardware_spec" required disabled> 
                                </fieldset> 
                            </div>    
                            <div id="button_software"> 
                                <fieldset> 
                                <legend style="text-align: center"><i>SOFTWARE SPECIFICATIONS</i></legend> 
                                    <?php
                                        $array_spec = $row['ict_component_spec'];
                                        $array_soft = explode("<br>", $array_spec);

                                        $array = array('DMAS', 'DMS', 'EHR', 'ENGAS', 'HIS', 'HRIS', 'LIS', 'MMS', 'PACS', 'PIS', 'QMEUP', 'RIS',
                                                        'Website Posting', 'FB Page Posting'); /* to separate the other's value from the array */
                                       
                                        $others_soft = array_diff($array_hard, $array);
                                    ?>
                                    <input type="checkbox" name="ict_component_spec[]" value="DMAS" id="dmas" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('DMAS', $array_soft))?'checked':''?> required disabled>
                                        <label for="dmas">DMAS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="DMS" id="dms" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('DMS', $array_soft))?'checked':''?> required disabled>
                                        <label for="dms">DMS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="EHR" id="ehr" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('EHR', $array_soft))?'checked':''?> required disabled>
                                        <label for="ehr">EHR</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="ENGAS" id="engas" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('ENGAS', $array_soft))?'checked':''?> required disabled>
                                        <label for="engas">ENGAS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="HIS" id="his" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('HIS', $array_soft))?'checked':''?> required disabled>
                                        <label for="his">HIS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="HRIS" id="hris" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('HRIS', $array_soft))?'checked':''?> required disabled>
                                        <label for="hris">HRIS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="LIS" id="lis" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('LIS', $array_soft))?'checked':''?> required disabled>
                                        <label for="lis">LIS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="MMS" id="mms" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('MMS', $array_soft))?'checked':''?> required disabled>
                                        <label for="mms">MMS</label> <br> 
                                    <input type="checkbox" name="ict_component_spec[]" value="PACS" id="pacs" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('PACS', $array_soft))?'checked':''?> required disabled>
                                        <label for="pacs">PACS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="PIS" id="pis" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('PIS', $array_soft))?'checked':''?> required disabled>
                                        <label for="pis">PIS</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="QMEUP" id="qmeup" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('QMEUP', $array_soft))?'checked':''?> required disabled>
                                        <label for="qmeup">QMEUP</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="RIS" id="ris" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('RIS', $array_soft))?'checked':''?> required disabled>
                                        <label for="ris">RIS</label> <br> 
                                    <input type="checkbox" name="ict_component_spec[]" value="Website Posting" id="website" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('Website Posting', $array_soft))?'checked':''?> required disabled>
                                        <label for="website">Website Posting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="FB Page Posting" id="fb_page" class="req_soft" onclick='call_soft("req_soft")' 
                                    <?php echo (in_array('FB Page Posting', $array_soft))?'checked':''?> required disabled>
                                        <label for="fb_page">FB Page Posting</label> <br> 
                                        <input type="checkbox" onchange="call_others()" name="others_software" id="others_software" class="req_soft" onclick='call_soft("req_soft")' 
                                            <?php if($row['ict_component'] === 'Software'){ echo (!empty($others_soft))?'checked':'';}?> required disabled> 
                                            <label for="others_software" style="font-size: 1.3vh;">Others <i style="font-size:1vh;">(specify):</i></label>  
                                            <input type="text" name="ict_component_spec[]" 
                                                value="<?php
                                                    if($row['ict_component'] === 'Software'){
                                                    if(!empty($others_soft)){
                                                        $other = implode($others_soft);
                                                        echo $other;
                                                    }} 
                                                ?>" 
                                                id="others_software_spec" required disabled> 
                                </fieldset>  
                            </div>
                            </div> <!-- specifications closer -->
                        </div> <!-- column_one closer -->
                        <div class="column_two">
                            <div class="input_field no_display"> <!-- this will let the id still submit -->
                                <input type="text" name="edit_item[]" id="edit_item" value="<?php echo $extract_id ?>">
                                <label for="edit_item">ID:</label>
                            </div>
                            <div class="input_field">
                                <input type="text" id="datetime_requested" name="datetime_requested" value="<?php echo $row['datetime_requested'] ?>" disabled>
                                <label for="datetime_requested">Date Requested:</label>
                            </div>
                            <div class="for_inline">
                                <div class="input_field">
                                    <input type="text" id="id" name="id" value="<?php echo $row['full_id'] ?>" disabled>
                                    <label for="id">Service Request No.:</label>
                                    <input type="text" id="ict_equipment_code" name="ict_equipment_code" value="<?php echo $row['ict_equipment_code'] ?>">
                                    <label for="ict_equipment_code" style="margin-left: 16.2vw;">ICT Equipment Code:</label>
                                </div>
                            </div>
                            <div class="no_display">
                                <input type="email" name="email" value="<?php echo $row['email'] ?>">
                                <input type="text" name="subject" value="Your Request is Resolved!">
                                <input type="text" name="message" value="Thank you for trusting ARMMC IMISS">
                            </div>
                            <div class="input_field">
                                <textarea name="description" id="description" required><?php echo $row['description'] ?></textarea>
                                    <label for="description">Description of Request:</label>
                            </div>
                            <div class="input_field">
                                <textarea name="assessment" id="assessment" required><?php echo $row['assessment'] ?></textarea>
                                    <label for="assessment">Assessment:</label>
                            </div>

                            <div class="input_field">
                                <select name="remarks" id="remarks" required>
                                <option value="<?php echo $row['remarks'] ?>" selected hidden><?php echo $row['remarks'] ?></option>
                                    <option value="Assessed">Assessed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option> 
                                </select>
                                <label for="remarks">Remarks</label>
                            </div>
                            <div class="input_field">
                                <select name="service_rendered" id="service_rendered" required>
                                <option value="<?php echo $row['service_rendered'] ?>" selected hidden><?php echo $row['service_rendered'] ?></option>
                                    <option value="Website uploading">Website Uploading</option>
                                    <option value="End-User's enrollment">End-User's enrollment</option>
                                    <option value="Network connectivity">Network connectivity</option>
                                    <option value="System/Application concerns">System/Application concerns</option>
                                    <option value="Bizbox request for assistance">Bizbox request for assistance</option>
                                    <option value="End-Users training">End-Users training</option>
                                    <option value="ICT hardware without repair">ICT hardware without repair</option>
                                    <option value="ICT hardware with repair">ICT hardware with repair</option>
                                    <option value="ICT hardware with replacement of parts">ICT hardware with replacement of parts</option>
                                    <option value="Preventive maintenance">Preventive maintenance</option>
                                </select>
                                <label for="service_rendered">Service Rendered:</label>
                            </div>
                            <?php
                                if(!empty($_SESSION['reception_fname'])) { ?>
                                    <div class="input_field no_display">
                                        <?php $updated_name = $_SESSION['reception_fname']." ". $_SESSION['reception_mname']." ". $_SESSION['reception_lname'] ?>
                                        <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                                            <label for="updated_by">Updated by:</label>
                                    </div>
                                <?php } else if(!empty($_SESSION['superadmin_fname'])) { ?>
                                    <div class="input_field no_display">
                                        <?php $updated_name = $_SESSION['superadmin_fname']." ". $_SESSION['superadmin_mname']." ". $_SESSION['superadmin_lname'] ?>
                                        <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                                        <label for="updated_by">Updated by:</label>
                                    </div>
                                <?php } else { ?>
                                    <div class="input_field no_display">
                                        <?php $updated_name = $_SESSION['admin_fname']." ". $_SESSION['admin_mname']." ". $_SESSION['admin_lname']?>
                                        <input type="text" name="updated_by" id="updated_by" value="<?php echo "$updated_name" ?>" required>
                                        <label for="updated_by">Updated by:</label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div> <!-- column closer -->
                    <button type="submit" name="edit_submit" id="edit_submit" class="button_control">Edit</button>
                    <a href="../../IMISS-System/6resolved.php" class="button_control">Cancel</a>
                </form>
            </div> <!-- closer for edit -->
            <?php } ?>
        </div> <!-- closer for all_forms -->
    </div>
    </div>
    <script src="../../IMISS-System/SCRIPT/checkbox_validate_two.js"></script> 
    <script src="../../IMISS-System/SCRIPT/checkbox_validate.js"></script>  
</body>
</html>