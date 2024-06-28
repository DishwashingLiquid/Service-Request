<?php
    session_start();
    include "../../IMISS-System/db_conn.php";  
    if(! isset($_SESSION["log_reception"])){
        header("Location: ../../IMISS-System/index_two.php");
    } 
    $id = $_GET["id"];
 
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
    <?php require "../../IMISS-System/nav_bar.php" ?> 
    <div class="section">
    <div class="paper"> 
        <div class="titlebar">pending request</div>
        <div class="all_forms">
            <div> 
                <h3>Print this Request</h3> 
            <?php
                $sql = "SELECT * FROM `request-list`
                        WHERE id = $id LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?> 
            <form action="" method="post" autocomplete="off" novalidate> 
                    <div class="not_column">
                    <div class="input_field">
                        <input type="text" id="date" name="date" value="<?php echo $row['date'] ?>" disabled>
                        <label for="date">Date Requested:</label>  
                    </div>
                    <div class="input_field">
                        <input type="text" id="id" name="id" value="<?php echo $row['id'] ?>" disabled >
                        <label for="id">Service Request No.:</label>  
                    </div>  
                    <div style="display: none;">
                        <input type="date" id="date_resolved" name="date_resolved" value="<?php echo date('Y-m-d');?>" > 
                        <input type="email" name="email" value="<?php echo $row['email'] ?>">  
                        <input type="text" name="subject" value="Your Request is Resolved!"> 
                        <input type="text" name="message" value="Thank you for trusting ARMMC IMISS"> 
                    </div>   
                    </div>   
                <div class="for_column">  
                        <fieldset>
                            <legend>TYPE OF SERVICE</legend>
                                <input type="radio" id="remote" name="type_of_service" value="Remote"
                                        <?php echo ($row['type_of_service'] === 'Remote')?'checked':'' ?>>
                                <label for="remote">Remote</label> 
                                <input type="radio" id="physical" name="type_of_service" value="Physical"
                                        <?php echo ($row['type_of_service'] === 'Physical')?'checked':'' ?>>
                                <label for="physical">Physical</label> 
                        </fieldset> 
                        <fieldset>
                            <legend>COMPUTER COMPONENT</legend>
                            <div class="input_line"> 
                                <input type="radio" id="hardware" name="com_component" value="Hardware - " 
                                        <?php echo ($row['com_component'] === 'Hardware - ')?'checked':'' ?>>
                                <label for="hardware">Hardware</label>   
                                <input type="radio" id="software" name="com_component" value="Software - " 
                                        <?php echo ($row['com_component'] === 'Software - ')?'checked':'' ?>>
                                <label for="software">Software</label>  
                                <br>
                                <label class="italic" for="com_component_spec">Specify:</label> 
                                <input type="text" id="com_component_spec" name="com_component_spec" value="<?php echo $row['com_component_spec'] ?>" required> 
                            </div>  
                        </fieldset>
                        <fieldset>
                            <legend>NETWORK</legend>
                            <div class="input_line">
                                <input type="radio" id="lan" name="network" value="LAN" 
                                        <?php echo ($row['network'] === 'LAN')?'checked':'' ?>>
                                <label for="lan">LAN</label>   
                                <input type="radio" id="internet" name="network" value="INTERNET" 
                                        <?php echo ($row['network'] === 'INTERNET')?'checked':'' ?>>
                                <label for="internet">INTERNET</label>  
                                <label class="italic" for="network_spec">Others (Specify):</label> 
                                <input type="text" id="network_spec" name="network_spec" value="<?php echo $row['network_spec'] ?>"> 
                            </div> 
                        </fieldset>
                        <fieldset>
                            <legend>SYSTEM</legend>
                            <div class="input_line"> 
                                <select name="system" id="system">
                                <option value="<?php echo $row['system'] ?>" selected hidden><?php 
                                        $system = $row['system'];
                                        if (!empty($system)) {
                                        echo $row['system'];
                                        } else {
                                            echo "Select System:";
                                        }?></option>
                                    <option value="HIS">HIS</option>
                                    <option value="PIS">PIS</option>
                                    <option value="MMS">MMS</option>
                                    <option value="DMAS">DMAS</option>
                                    <option value="QMEUP">QMEUP</option>
                                    <option value="EHR">EHR</option>
                                    <option value="PACS">PACS</option> 
                                </select>   
                                <label class="italic" for="system_spec">Others (Specify):</label> 
                                <input type="text" id="system_spec" name="system_spec" value="<?php echo $row['system_spec'] ?>"> 
                            </div>  
                        </fieldset>
                        <fieldset>
                            <legend>OTHERS</legend> 
                            <div class="input_line"> 
                                <select name="others" id="others" >
                                <option value="<?php echo $row['others'] ?>" selected hidden><?php 
                                        $others = $row['others'];
                                        if (!empty($others)) {
                                        echo $row['others'];
                                        } else {
                                            echo "Select Others:";
                                        }?></option>
                                    <option value="Website">Website</option>
                                    <option value="FB Page">FB Page</option>
                                    <option value="Training">Training</option>
                                    <option value="Preventive Maintenance">Preventive Maintenance</option>  
                                </select>  
                                <label class="italic" for="others_spec">Others (Specify):</label> 
                                <input type="text" id="others_spec" name="others_spec" value="<?php echo $row['others_spec'] ?>"> 
                            </div>  
                        </fieldset> 
                      
                    <textarea name="description" id="description"><?php echo $row['description'] ?></textarea>  
                    <textarea name="assessment" id="assessment"><?php echo $row['assessment'] ?></textarea> 
                    <textarea name="remarks" id="remarks"><?php echo $row['remarks'] ?></textarea> 
                </div>
                <button onclick="window.print();" class="button_control">Print</button>
                <a href="../../IMISS-System/6resolved.php" class="button_control">Cancel</a>
            </form>
            </div> 
        </div>
    </div>
    </div> 
</body>
</html>