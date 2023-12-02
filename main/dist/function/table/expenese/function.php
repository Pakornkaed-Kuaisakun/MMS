<?php
function get_total_all_records()
{
    $accID = $_SESSION["ID"];
    include('../../../../../server/connection/PDOconn.php');
    $statement = $conn->prepare("SELECT * FROM `expenese` WHERE `accID` = '$accID'");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}

function badge_type($type)
{
    include('../../array-data.php');
    if ($type == $expenese_type[1]) { //food
        echo '<span class="badge badge-primary">Food</span>';
    } else if ($type == $expenese_type[2]) { //travel
        echo '<span class="badge badge-dark">Travel</span>';
    } else if ($type == $expenese_type[3]) { //subscription_fee
        echo '<span class="badge badge-info">Subscription Fee</span>';
    } else if ($type == $expenese_type[4]) { //laundry
        echo '<span class="badge badge-success">Laundry</span>';
    } else if ($type == $expenese_type[5]) { //other
        echo '<span class="badge badge-warning">Other</span>';
    } else { //error
        echo '<span class="badge badge-danger">No comment</span>';
    }
}
?>