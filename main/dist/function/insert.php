<?php
    session_start();
    include("../../../server/connection/conn.php");

    if(isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        $ID = $_POST['ID'];
        $type = $_POST['type'];
        $group = $_POST['group'];

        $insert = "INSERT INTO `moneydata` (`accID`, `amount`, `type`, `expenese_group`) VALUES ('$ID','$amount','$type','$group')";
        $result = mysqli_query($conn, $insert);

        header("Location: ../../dashboard.php?success='Insert complete'");
    }
?>