<?php
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    if(isset($_POST['send'])) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pakornkiet2186@gmail.com';
        $mail->Password = 'qwtefycelowyoqkf';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('pakornkiet2186@gmail.com');
        $mail->addAddress($_POST['email']);

        $mail->isHTML(true);

        $mail->Subject = "Test";
        $mail->Body = $_POST['message'];

        $mail->send();

        echo "send successfully";
    }
