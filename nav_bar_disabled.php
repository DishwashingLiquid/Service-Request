<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../IMISS-System/index.css">
    <link rel="stylesheet" href="../../IMISS-System/CSS/fontawesome/css/all.css">
    <title>IMISS System</title>
</head>

<body>
    <div class="nav_disabled">
    <nav>
        <img src="../../IMISS-System/CSS/images/logo.png" alt="ARMMC Logo"> 
        <h2 class="srs">imiss system</h2>
        <?php if (isset($_SESSION["log_reception"])): ?>  
            <a href="1admin.php"><i class="fa-solid fa-user-plus"></i><span class="hidden">IMISS Staff</span></a>
            <a href="3end-user.php"><i class="fa-solid fa-user-plus"></i><span class="hidden">End-User</span></a>
            <a href="4on-going.php"><i class="fa-solid fa-ticket"></i><span class="hidden">On-going Request</span></a>
            <a href="5pending.php"><i class="fa-solid fa-spinner"></i><span class="hidden">Pending Request</span></a>
            <a href="6resolved.php"><i class="fa-solid fa-circle-check"></i><span class="hidden">Resolved Request</span></a>
            <a href="0history.php"><i class="fa-solid fa-clock-rotate-left"></i><span class="hidden">History</span></a>
            <a href="0inventory.php"><i class="fa-solid fa-file-lines"></i><span class="hidden">Inventory</span></a>
            <a href="7report.php"><i class="fa-solid fa-chart-line"></i><span class="hidden">Report</span></a>
            <div class="my_account">
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_reception.php">
                    <div class="greetings">
                        <i class="fa-solid fa-circle-user"></i>
                        <span class="hidden">Hello,</span>
                    </div>
                    <div class="account_name">
                        <span class="hidden"><?php echo $_SESSION["reception_fname"], " ", $_SESSION['reception_lname'] ?>!</span>
                    </div></a>  
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["log_user"])): ?>
            <a href="8user_dashboard.php"><i class="fa-solid fa-circle-plus"></i><span class="hidden">Create Request</span></a> 
            <a href="9user_active.php"><i class="fa-solid fa-ticket"></i><span class="hidden">Active Request</span></a>  
            <a href="10user_resolved.php"><i class="fa-solid fa-circle-check"></i><span class="hidden">Resolved Request</span></a>
           <!--  <a href="11user_report.php"><i class="fa-solid fa-chart-line"></i><span class="hidden">Report</span></a> -->
            <div class="my_account">
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_user.php">
                    <div class="greetings">
                        <i class="fa-solid fa-circle-user"></i>
                        <span class="hidden">Hello,</span>
                    </div>
                    <div class="account_name">
                        <span class="hidden"><?php echo $_SESSION["end_user_fname"], " ", $_SESSION['end_user_lname'] ?>!</span>
                    </div></a>  
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["log_admin"])): ?>
            <a href="12admin_dashboard.php"><i class="fa-solid fa-chart-line"></i><span class="hidden">Dashboard</span></a>     
            <a href="13admin_claim.php"><i class="fa-brands fa-get-pocket"></i><span class="hidden">Claim Request</span></a>     
            <a href="14admin_active.php"><i class="fa-solid fa-ticket"></i><span class="hidden">Active Request</span></a>   
            <a href="15admin_pending.php"><i class="fa-solid fa-spinner"></i><span class="hidden">Pending Request</span></a>   
            <a href="16admin_resolved.php"><i class="fa-solid fa-circle-check"></i><span class="hidden">Resolved Request</span></a>   
            <a href="0history.php"><i class="fa-solid fa-clock-rotate-left"></i><span class="hidden">History</span></a>
            <a href="0inventory.php"><i class="fa-solid fa-file-lines"></i><span class="hidden">Inventory</span></a>
            <!--   <a href="17admin_report.php"><i class="fa-solid fa-chart-line"></i><span class="hidden">Report</span></a> -->   
            <div class="my_account">
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_admin.php">
                    <div class="greetings">
                        <i class="fa-solid fa-circle-user"></i>
                        <span class="hidden">Hello,</span>
                    </div>
                    <div class="account_name">
                        <span class="hidden"><?php echo $_SESSION["admin_fname"], " ", $_SESSION['admin_lname'] ?>!</span>
                    </div></a>   
            </div>
        <?php endif; ?>  
        <?php if (isset($_SESSION["log_superadmin"])): ?>
            <a href="2reception.php"><i class="fa-solid fa-user-plus"></i><span class="hidden">Reception</span></a>
            <a href="1admin.php"><i class="fa-solid fa-user-plus"></i><span class="hidden">IMISS Staff</span></a>
            <a href="3end-user.php"><i class="fa-solid fa-user-plus"></i><span class="hidden">End-User</span></a>
            <a href="4on-going.php"><i class="fa-solid fa-ticket"></i><span class="hidden">On-going Request</span></a>
            <a href="5pending.php"><i class="fa-solid fa-spinner"></i><span class="hidden">Pending Request</span></a>
            <a href="6resolved.php"><i class="fa-solid fa-circle-check"></i><span class="hidden">Resolved Request</span></a>
            <a href="0history.php"><i class="fa-solid fa-clock-rotate-left"></i><span class="hidden">History</span></a>
            <a href="0inventory.php"><i class="fa-solid fa-file-lines"></i><span class="hidden">Inventory</span></a>
            <a href="7report.php"><i class="fa-solid fa-chart-line"></i><span class="hidden">Report</span></a>
            <div class="my_account">
                <a href="../../IMISS-System/PHP-Account-MyAccount/0myaccount_superadmin.php">
                    <div class="greetings">
                        <i class="fa-solid fa-circle-user"></i>
                        <span class="hidden">Hello,</span>
                    </div>
                    <div class="account_name">
                        <span class="hidden"><?php echo $_SESSION["superadmin_fname"], " ", $_SESSION['superadmin_lname'] ?>!</span>
                    </div></a>  
            </div>
        <?php endif; ?>  
    </nav>
    </div>
</body>
</html>

