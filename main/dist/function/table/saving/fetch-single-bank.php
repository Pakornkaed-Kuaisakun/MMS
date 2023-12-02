<?php
include('../../../../../server/connection/PDOconn.php');
include('function.php');
include('../../array-data.php');
if (isset($_POST["ID"])) {
    $output = array();
    $statement = $conn->prepare(
        "SELECT * FROM `bank` 
  WHERE `ID` = '" . $_POST["ID"] . "' 
  LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["bankName"] = $row["bankName"];
        $output["bankNumber"] = $row["bankNumber"];
        $output["bankOwner"] = $row["bankOwner"];
        $output["ownerPrefix"] = $row["ownerPrefix"];
        $output["status"] = $row["status"];
        $output["bankFullName"] = $bankList[$row['bankName']];
    }
    echo json_encode($output);
}
?>