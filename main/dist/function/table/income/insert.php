<?php
    session_start();
    include("../../../../../server/connection/conn.php");
    include('function.php');

    if(isset($_POST['operation'])) {
        if($_POST['operation'] == 'Edit') {
            $accID = $_POST['accID'];
            $update_ID = $_POST['ID'];
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
            $date = mysqli_real_escape_string($conn, $_POST['datetime']);

            $update = "UPDATE `income` SET `amount` = '$amount', `comment` = '$comment', `time` = '$date' WHERE `ID` = '$update_ID' AND `accID` = '$accID'";
            $result = mysqli_query($conn, $update);
            if ($result) {
                echo "Updated";
            } else {
                echo "Somethings went wrong";
            }
        } else if($_POST['operation'] == 'Add') {
            $accID = $_POST['accID'];
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
            $date = mysqli_real_escape_string($conn, $_POST['datetime']);

            $insert = "INSERT INTO `income` (`accID`, `amount`, `comment`, `time`) VALUES ('$accID', '$amount', '$comment', '$date')";
            $result = mysqli_query($conn, $insert);

            if($result) {
                echo "Add 1 Row Completed";
            } else {
                echo "Somethings went Wrong";
            }
        } else {
            echo "Error";
        }
    }
?>