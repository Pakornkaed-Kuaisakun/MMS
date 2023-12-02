<?php  
    session_start();
    include("../../../server/connection/conn.php");
    $ID = $_SESSION['ID'];

    $update = "UPDATE `userdata` SET `OTP` = '' WHERE `ID` = '$ID'";
    $result = mysqli_query($conn, $update);
    unset($_SESSION['_password_']);
    unset($_SESSION['expired']);

    header("Location: ../../account.php");
    exit();
?>