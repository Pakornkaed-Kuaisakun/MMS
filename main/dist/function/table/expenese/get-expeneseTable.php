<?php
session_start();
include("../../../../../server/connection/PDOconn.php");
include("function.php");
include('../../array-data.php');

$accID = $_SESSION['ID'];

$query = "SELECT * FROM `expenese` ";
$query .= "WHERE `accID` = '$accID' ";
$output = array();
if (isset($_POST['search']["value"])) {
    $query .= "AND (`amount` LIKE '%" . $_POST['search']["value"] . "%' ";
    $query .= "OR `type` LIKE '%" . $_POST['search']['value'] . "%' ";
    $query .= "OR `comment` LIKE '%" . $_POST['search']['value'] . "%' ";
    $query .= "OR `time` LIKE '%" . $_POST['search']['value'] . "%' ) ";
}
if (isset($_POST['order'])) {
    $query .= "ORDER BY " . $_POST['order']['0']['column'] . " " . $_POST['order']['0']['dir'] . " ";
} else {
    $query .= "ORDER BY `ID` DESC ";
}

if ($_POST['length'] != -1) {
    $query .= "LIMIT " . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$cnt = 1;
foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $cnt;
    $sub_array[] = $row['amount'];
    if ($row['comment'] != null) {
        $sub_array[] = '<button type="button" name="view" id="' . $row['ID'] . '" class="btn btn-info btn-sm view"><i class="fas fa-eye"></i> View</button>';
    } else {
        $sub_array[] = '<span class="badge badge badge-pill badge-danger">No comment</span>';
    }

    if ($row['type'] == "food") { //food
        $sub_array[] = '<span class="badge badge-pill badge-primary">Food</span>';
    } else if ($row['type'] == "travel") { //travel
        $sub_array[] = '<span class="badge badge-pill badge-dark">Travel</span>';
    } else if ($row['type'] == "subscription_fee") { //subscription_fee
        $sub_array[] = '<span class="badge badge-pill badge-info">Subscription Fee</span>';
    } else if ($row['type'] == "laundry") { //laundry
        $sub_array[] = '<span class="badge badge-pill badge-success">Laundry</span>';
    } else if ($row['type'] == "other") { //other
        $sub_array[] = '<span class="badge badge-pill badge-warning">Other</span>';
    } else { //error
        $sub_array[] = '<span class="badge badge-pill badge-danger">No comment</span>';
    }

    $sub_array[] = $row['time'];
    $sub_array[] = $row['created_at'];
    $sub_array[] = '<button type="button" name="update" id="' . $row["ID"] . '" class="btn btn-success btn-sm update"><i class="fas fa-edit"></i> Edit</button>';
    $sub_array[] = '<button type="button" name="delete" id="' . $row["ID"] . '" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Delete</button>';

    $cnt = $cnt + 1;

    $data[] = $sub_array;
}

$output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_all_records(),
    "data" => $data
);

echo json_encode($output);
?>