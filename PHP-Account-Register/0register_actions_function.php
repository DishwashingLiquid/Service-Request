<?php
    require "../../IMISS-System/db_conn.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../IMISS-System/AUTOMAILER/src/Exception.php';
    require '../../IMISS-System/AUTOMAILER/src/PHPMailer.php';
    require '../../IMISS-System/AUTOMAILER/src/SMTP.php';

    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass']; 
    if($password === $confirm_pass) {
        if(isset($_POST["register"])) {
            $division = $_POST['division'];
            $area = $_POST['area'];
            $end_user_fname = $_POST['end_user_fname'];
            $end_user_mname = $_POST['end_user_mname'];
            $end_user_lname = $_POST['end_user_lname'];
            $contact_no = $_POST['contact_no'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $is_approved = $_POST['is_approved'];

            $sql = "INSERT INTO `end-user-list`
                    (`id`, `division`, `area`, `end_user_fname`, `end_user_mname`, `end_user_lname`, 
                    `contact_no`, `email`, `username`, `password`, `is_approved`)
                VALUES 
                    (NULL, '$division', '$area', '$end_user_fname', '$end_user_mname', '$end_user_lname',
                    '$contact_no', '$email', '$username', '$password',  '$is_approved')";
            
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
            header("Location: ../../IMISS-System/index.php?scs=Added successfully.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
        }
    } else {
        echo "Confirm password is incorrect";
        header("Location: ../../IMISS-System/PHP-Account-Register/0register_index.php?dng=Confirm password is incorrect.");
    }

?>