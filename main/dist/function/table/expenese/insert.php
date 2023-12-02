<?php
session_start();
include("../../../../../server/connection/conn.php");
include('function.php');

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Edit') {
        $accID = $_POST['accID'];
        $update_ID = $_POST['ID'];
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $date = mysqli_real_escape_string($conn, $_POST['datetime']);

        $update = "UPDATE `expenese` SET `amount` = '$amount', `type` = '$type', `comment` = '$comment', `time` = '$date' WHERE `ID` = '$update_ID' AND `accID` = '$accID'";
        $result = mysqli_query($conn, $update);
        if ($result) {
            echo "Updated";
        } else {
            echo "Somethings went wrong";
        }
    } else if ($_POST['operation'] == 'Add') {
        $accID = $_POST['accID'];
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $date = mysqli_real_escape_string($conn, $_POST['datetime']);

        $insert = "INSERT INTO `expenese` (`accID`, `type`, `amount`, `comment`, `time`) VALUES ('$accID', '$type', '$amount', '$comment', '$date')";
        $result = mysqli_query($conn, $insert);

        if ($result) {
            echo "Add 1 Row Completed";
        } else {
            echo "Somethings went Wrong";
        }
    } else {
        echo "Error";
    }
}
?>