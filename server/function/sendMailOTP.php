<?php
    session_start();
    $ID = $_SESSION['ID'];
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';

    include "../connection/conn.php";

    if(isset($_POST['confirm_OTP'])) {
        $currentPassword = mysqli_real_escape_string($conn, sha1(md5($_POST['currentPassword'])));
        $newPassword = mysqli_real_escape_string($conn, sha1(md5($_POST['newPassword'])));
        $confirmPassword = mysqli_real_escape_string($conn, sha1(md5($_POST['confirmPassword'])));

        if ($_SESSION['PASSWORD'] === $currentPassword) {
            if ($newPassword === $confirmPassword) {
            $OTP = rand(0, 999999);

            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pakornkiet2186@gmail.com';
            $mail->Password = 'qwtefycelowyoqkf';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('pakornkiet2186@gmail.com');
            $mail->addAddress($_POST['OTP-email']);

            $mail->isHTML(true);

            $mail->Subject = "OTP for change your Password.";
            $mail->Body = "
            ------------------- SECRET -------------------\n\r
            Dear, " . $_POST['OTP-name'] . "\n\r
            This is Email send for OTP to change your Password.\n\r
            OTP can be use One-Time for change password, In next time system will gernerate a new OTP and send to this email.\n\r
            OTP: " . $OTP . "\n\r
            created at " . date("Y-m-d h:i:s", time()) . "\n\r
            expired in 3 minutes
            ";

            $mail->send();

            $_SESSION['_password_'] = $newPassword;

            $update = "UPDATE `userdata` SET `OTP` = '$OTP' WHERE `ID` = '$ID'";
            $result = mysqli_query($conn, $update);

            $time = $_SERVER['REQUEST_TIME'];
            $_SESSION['expired'] = strtotime("+3 minutes", $time);

            header("Location: ../../main/account.php");

        } else {
            header("Location: ../../main/account.php?err=Your password is not match");
        }
    } else {
        header("Location: ../../main/account.php?err=Current Password is Wrong");
    }
    }

    if(isset($_POST["Re-OTP"])) {
        $OTP = rand(0, 999999);

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pakornkiet2186@gmail.com';
        $mail->Password = 'qwtefycelowyoqkf';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('pakornkiet2186@gmail.com');
        $mail->addAddress($_POST['OTP-email']);

        $mail->isHTML(true);

        $mail->Subject = "OTP for change your Password.";
        $mail->Body = "
                ------------------- SECRET -------------------\n\r
                Dear, " . $_POST['OTP-email'] . "\n\r
                This is Email send for OTP to change your Password.\n\r
                OTP can be use One-Time for change password, In next time system will gernerate a new OTP and send to this email.\n\r
                OTP: " . $OTP . "\n\r
                created at " . date("Y-m-d h:i:s", time()) . "\n\r
                expired in 3 minutes
                ";

        $mail->send();

        $update = "UPDATE `userdata` SET `OTP` = '$OTP' WHERE `ID` = '$ID'";
        $result = mysqli_query($conn, $update);

        $time = $_SERVER['REQUEST_TIME'];
        $_SESSION['current-time-otp'] = $time;
        $_SESSION['expired'] = strtotime("+3 minutes", $time);
        $_SESSION['OTP-cooldown'] = strtotime('+1 minutes 30 seconds', $time);

        header("Location: ../../main/account.php");

    }
?>