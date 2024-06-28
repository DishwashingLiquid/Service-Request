<?php
    session_start();
    require "../../IMISS-System/db_conn.php";
    if(! isset($_SESSION["log_reception"]) && ! isset($_SESSION["log_superadmin"])) {
        header("Location: ../../IMISS-System/index_two.php");
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../IMISS-System/AUTOMAILER/src/Exception.php';
    require '../../IMISS-System/AUTOMAILER/src/PHPMailer.php';
    require '../../IMISS-System/AUTOMAILER/src/SMTP.php';

    /* submit for approve */
    if(isset($_POST["approve_submit"])) { 
        $email = $_POST['email'];
        $is_approved = $_POST['is_approved']; 
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $updated_by = $_POST['updated_by'];

        $array = $_POST['approve_item'];
        $extract_id = implode(' , ', $array);

        $sql = "UPDATE `end-user-list` SET
                `is_approved` = '$is_approved',
                `updated_by` = '$updated_by'
                WHERE id = $extract_id";

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
            header("Location: ../../IMISS-System/3end-user_approve.php?scs=Added Successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }