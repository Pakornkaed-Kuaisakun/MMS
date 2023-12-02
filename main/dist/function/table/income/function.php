<?php
    function get_total_all_records() {
        $accID = $_SESSION["ID"];
        include('../../../../../server/connection/PDOconn.php');
        $statement = $conn->prepare("SELECT * FROM `income` WHERE `accID` = '$accID'");
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }
?>