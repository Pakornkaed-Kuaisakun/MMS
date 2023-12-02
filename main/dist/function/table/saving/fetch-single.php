<?php
include('../../../../../server/connection/PDOconn.php');
include('function.php');
if (isset($_POST["ID"])) {
    $output = array();
    $statement = $conn->prepare(
        "SELECT * FROM `saving` 
  WHERE ID = '" . $_POST["ID"] . "' 
  LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["amount"] = $row["amount"];
        $output["comment"] = $row["comment"];
        $output["time"] = $row["time"];
        $output["bank"] = $row["bankID"];
    }
    echo json_encode($output);
}
?>