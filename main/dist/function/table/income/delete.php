<?php
    session_start();
    include("../../../../../server/connection/conn.php");
    include("function.php");

    if(isset($_POST['delete_operation'])) {
        $delete_ID = $_POST['ID'];
        $accID = $_POST['accID'];

        $delete = "DELETE FROM `income` WHERE `ID` = '$delete_ID' AND `accID` = '$accID'";
        $result = mysqli_query($conn, $delete);

        if($result) {
            echo "Deleted";
        } else {
            echo "Somethings went Wrong";
        }
    } else {
        echo "Error";
    }
?>