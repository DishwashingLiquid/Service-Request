<?php
    session_start();
    include "../../IMISS-System/db_conn.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../IMISS-System/AUTOMAILER/src/Exception.php';
    require '../../IMISS-System/AUTOMAILER/src/PHPMailer.php';
    require '../../IMISS-System/AUTOMAILER/src/SMTP.php'; 

    if(! isset($_SESSION["log_admin"])){
        header("Location: ../../IMISS-System/index_two.php");
    } 
    $id = $_GET["id"];  
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d');
    $now = date('H:i:s');

    if (isset($_POST["submit"])) { /* used send instead submit because email auto send requires send */ 
        $ict_equipment_code = $_POST['ict_equipment_code'];
        $description = $_POST['description'];
        $type_of_service = $_POST['type_of_service'];  
        $ict_component = $_POST['ict_component']; 
            $array_two = $_POST['ict_component_spec'];  /* implode array into pcs */
        $ict_component_spec = implode("<br>", $array_two); 
        $assessment = $_POST['assessment'];
        $remarks = $_POST['remarks'];  
        $service_rendered = $_POST['service_rendered'];  
        $status = $_POST['submit']; 
        $updated_by = $_POST['updated_by'];

    $sql = "UPDATE `request-list` SET 
            `ict_equipment_code` = '$ict_equipment_code',
            `description` = '$description',
            `type_of_service` = '$type_of_service', 
            `ict_component` = '$ict_component', 
            `ict_component_spec` = '$ict_component_spec',  
            `assessment` = '$assessment',
            `remarks` = '$remarks',
            `service_rendered` = '$service_rendered',
            `date_pending` = '$today',
            `time_pending` = '$now',
            `status` = '$status',
            `updated_by` = '$updated_by'
            WHERE id = $id";

    $result = mysqli_query($conn, $sql); 
    if ($result) {
        header("Location: ../../IMISS-System/14admin_active.php?scs=Request is Pending.");
    } else {
        echo "Failed: " . mysqli_error($conn);
    } 
    }  
 
    if (isset($_POST["send"])) { /* used send instead submit because email auto send requires send */
        $ict_equipment_code = $_POST['ict_equipment_code'];
        $description = $_POST['description']; 
        $type_of_service = $_POST['type_of_service'];  
        $ict_component = $_POST['ict_component']; 
            $array_two = $_POST['ict_component_spec'];  /* implode array into pcs */
        $ict_component_spec = implode("<br>", $array_two);
        $assessment = $_POST['assessment'];
        $remarks = $_POST['remarks'];
        $service_rendered = $_POST['service_rendered'];
        $status = $_POST['send'];
        $updated_by = $_POST['updated_by'];
    
    $sql = "UPDATE `request-list` SET 
            `ict_equipment_code` = '$ict_equipment_code',
            `description` = '$description',
            `date_resolved` = '$today',
            `time_resolved` = '$now',
            `type_of_service` = '$type_of_service', 
            `ict_component` = '$ict_component', 
            `ict_component_spec` = '$ict_component_spec',  
            `assessment` = '$assessment',
            `remarks` = '$remarks',
            `service_rendered` = '$service_rendered',
            `status` = '$status',
            `updated_by` = '$updated_by'
            WHERE id = $id";

    $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'servicerequest.armmc@gmail.com';
        $mail->Password = 'syozsoonjupjtdlu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('servicerequest.armmc@gmail.com');

        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);

        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];

        $mail->send();
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../../IMISS-System/14admin_active.php?scs=Request resolved successfully.");
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
        <div class="titlebar">active request</div>
        <div class="all_forms" style="margin-top: 1%;">
            <div>
            <h3>Complete this Form</h3>
            <?php 
                $sql = "SELECT CONCAT(a.date_requested, ' : ', a.time_requested) AS datetime_requested, 
                            CONCAT(MONTH(a.date_requested), '-', YEAR(a.date_requested), '-', a.id) AS full_id,  
                            a.id, a.end_user_id, a.ict_equipment_code, a.description, b.email, b.id,
                            CONCAT(b.end_user_fname, ' ', b.end_user_mname, ' ', b.end_user_lname) AS full_user,
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
                        WHERE a.id = $id LIMIT 1"; 
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?>  
            <form action="" method="POST" autocomplete="off"> 
            <div class="column"> 
                <div class="column_one">  
                    <fieldset id="type_of_service">
                        <legend>TYPE OF SERVICE</legend>
                            <input type="radio" id="remote" name="type_of_service" value="Remote" required>
                                <label for="remote">Remote</label> 
                            <input type="radio" id="physical" name="type_of_service" value="Physical">
                                <label for="physical">Physical</label> 
                    </fieldset>
                    <fieldset id="ict_component"> 
                        <legend style="text-align: center">ICT COMPONENT</legend>  
                        <input type="radio" id="hardware_check" class="ict_component" name="ict_component" value="Hardware" onchange="call_component()" required>
                                <label for="hardware_check">Hardware</label> 
                        <input type="radio" id="software_check" class="ict_component" name="ict_component" value="Software" onchange="call_component()">
                                <label for="software_check">Software</label>  
                    </fieldset>   
                            
                    <div class="specifications">   
                        <div id="button_hardware"> 
                            <fieldset> 
                            <legend style="text-align: center"><i>HARDWARE SPECIFICATIONS</i></legend> 
                                    <input type="checkbox" name="ict_component_spec[]" value="Desktop/Laptop/System Unit Troubleshooting" id="desktop" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="desktop">Desktop/Laptop/System Unit Troubleshooting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Input Device Troubleshooting" id="input" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="input">Input Device Troubleshooting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Output Device Troubleshooting" id="output" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="output">Output Device Troubleshooting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Protective Device Troubleshooting" id="device" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="device">Protective Device Troubleshooting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Storage Device Troubleshooting" id="storage" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="storage">Storage Device Troubleshooting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Printer Troubleshooting" id="printer" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="printer">Printer Troubleshooting</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Internet, Network & Cable Management" id="internet" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="internet">Internet, Network & Cable Management</label> <br>
                                    <input type="checkbox" name="ict_component_spec[]" value="Installation" id="install" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="install">Installation</label> <br> 
                                    <input type="checkbox" name="ict_component_spec[]" value="Preventive Maintenance" id="preventive" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="preventive">Preventive Maintenance</label> <br> 
                                    <input type="checkbox" name="ict_component_spec[]" value="Support" id="support" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="support">Support</label> <br>
                                    <input type="checkbox" onchange="call_others()" name="others_hardware" id="others_hardware" class="req_hard" onclick='call_hard("req_hard")' required disabled>
                                        <label for="others_hardware" style="font-size: 1.3vh;">Others <i style="font-size:1vh;">(specify):</i></label>   
                                        <input type="text" name="ict_component_spec[]" value="" id="others_hardware_spec" required disabled>
                            </fieldset>
                        </div>    
                        <div id="button_software"> 
                            <fieldset> 
                            <legend style="text-align: center"><i>SOFTWARE SPECIFICATIONS</i></legend> 
                                <input type="checkbox" name="ict_component_spec[]" value="DMAS" id="dmas" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="dmas">DMAS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="DMS" id="dms" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="dms">DMS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="EHR" id="ehr" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="ehr">EHR</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="ENGAS" id="engas" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="engas">ENGAS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="HIS" id="his" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="his">HIS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="HRIS" id="hris" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="hris">HRIS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="LIS" id="lis" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="lis">LIS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="MMS" id="mms" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="mms">MMS</label> <br> 
                                <input type="checkbox" name="ict_component_spec[]" value="PACS" id="pacs" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="pacs">PACS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="PIS" id="pis" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="pis">PIS</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="QMEUP" id="qmeup" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="qmeup">QMEUP</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="RIS" id="ris" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="ris">RIS</label> <br> 
                                <input type="checkbox" name="ict_component_spec[]" value="Website Posting" id="website" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="website">Website Posting</label> <br>
                                <input type="checkbox" name="ict_component_spec[]" value="FB Page Posting" id="fb_page" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="fb_page">FB Page Posting</label> <br> 
                                <input type="checkbox" onchange="call_others()" name="others_software" id="others_software" class="req_soft" onclick='call_soft("req_soft")' required disabled>
                                    <label for="others_software" style="font-size: 1.3vh;">Others <i style="font-size:1vh;">(specify):</i></label>  
                                    <input type="text" name="ict_component_spec[]" value="" id="others_software_spec" required disabled>  
                            </fieldset> 
                        </div> 
                    </div>
                </div> <!-- column one closer -->
                <div class="column_two">
                    <div class="input_field">
                        <input type="text" id="datetime_requested" name="datetime_requested" value="<?php echo $row['datetime_requested'] ?>" disabled>
                        <label for="datetime_requested">Date Requested:</label>  
                    </div>
                    <div class="for_inline">
                        <div class="input_field">
                            <input type="text" id="id" name="id" value="<?php echo $row['full_id'] ?>" disabled > 
                            <label for="id">Service Request No.:</label>   
                            <input type="text" id="name" name="name" value="<?php 
                                $end_user_name = $row["full_user"];
                                if(empty($end_user_name)) {
                                    echo "IMISS Manual Request";
                                } else {
                                    echo $row["full_user"];
                                }
                                ?>" disabled>
                            <label for="name" style="margin-left: 16.2vw;">Request By:</label> 
                        </div>
                    </div>
                    <div class="for_inline">
                        <div class="input_field">
                            <input type="text" id="ict_equipment_code" name="ict_equipment_code" value="<?php echo $row["full_d"], $row["full_e"], $row["full_f"], $row["full_g"], $row["full_h"],
                                    $row["full_i"], $row["full_j"], $row["full_k"], $row["full_l"], $row["full_m"] ?>">
                            <label for="ict_equipment_code">ICT Equipment Code:</label>
                            <input type="text" id="area" name="area" value="<?php echo $row["area_d"], $row["area_e"], $row["area_f"], $row["area_g"], $row["area_h"], 
                                    $row["area_i"], $row["area_j"], $row["area_k"], $row["area_l"], $row["area_m"]?>" disabled>
                            <label for="area" style="margin-left: 16.2vw;">Area:</label>  
                        </div>
                    </div>
                    <div class="no_display">  
                        <input type="email" name="email" value="<?php echo $row['email'] ?>">  
                        <input type="text" name="subject" value="Your Request is Resolved!"> 
                        <input type="text" name="message"
                            value="
                            <p><b>Thank you for trusting ARMMC IMISS.</b></p>
                            <br>
                            <p>We're constantly striving to provide a better service. We'd love if you could take 1min. to give us some feedback by visiting our survey link:</p>
                            <a href='https://tinyurl.com/ihomp-satisfaction-survey/'>https://tinyurl.com/ihomp-satisfaction-survey</a>
                        ">
                    </div>  
                    <div class="input_field">
                        <textarea name="description" id="description" required><?php echo $row['description'] ?></textarea>  
                        <label for="description">Description of Request:</label>
                    </div>
                    <div class="input_field">
                        <textarea name="assessment" id="assessment" required></textarea> 
                        <label for="assessment">Assessment:</label>
                    </div>
                    <div class="input_field">
                       <select name="remarks" id="remarks" required>
                       <option value="" disabled selected hidden></option>
                                <option value="Assessed">Assessed</option> 
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option> 
                       </select>
                       <label for="remarks">Remarks:</label>
                    </div>
                    <div class="input_field">
                       <select name="service_rendered" id="service_rendered" required>
                       <option value="" disabled selected hidden></option>
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
                </div>
            </div> <!-- column closer -->  
                <button type="submit" name="submit" class="button_control" value="Pending">Pending</button>
                <button type="submit" name="send" class="button_control" value="Resolved">Resolve</button>
                <a href="../../IMISS-System/14admin_active.php" class="button_control">Cancel</a>
            </form>   
            </div> <!-- empty div closer -->
        </div> <!-- all forms closer -->
    </div>
    </div> 
    <script src="../../IMISS-System/SCRIPT/checkbox_validate.js"></script>  
</body>
</html>   
