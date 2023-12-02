<?php
//total income

$income = "SELECT SUM(amount) FROM `income` WHERE `accID` = '$ID'";
$stmt = $conn->prepare($income);
$stmt->execute();
$stmt->bind_result($income);
$stmt->fetch();
$stmt->close();

//total expenese
$expenese = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID'";
$stmt = $conn->prepare($expenese);
$stmt->execute();
$stmt->bind_result($expenese);
$stmt->fetch();
$stmt->close();

//total saving
$saving = "SELECT SUM(amount) FROM `saving` WHERE `accID` = '$ID'";
$stmt = $conn->prepare($saving);
$stmt->execute();
$stmt->bind_result($saving);
$stmt->fetch();
$stmt->close();

//type expenese
$e_food = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `type` = 'food'";
$stmt = $conn->prepare($e_food);
$stmt->execute();
$stmt->bind_result($e_food);
$stmt->fetch();
$stmt->close();

$e_travel = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `type` = 'travel'";
$stmt = $conn->prepare($e_travel);
$stmt->execute();
$stmt->bind_result($e_travel);
$stmt->fetch();
$stmt->close();

$e_subscription_fee = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `type` = 'subscription_fee'";
$stmt = $conn->prepare($e_subscription_fee);
$stmt->execute();
$stmt->bind_result($e_subscription_fee);
$stmt->fetch();
$stmt->close();

$e_laundry = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `type` = 'laundry'";
$stmt = $conn->prepare($e_laundry);
$stmt->execute();
$stmt->bind_result($e_laundry);
$stmt->fetch();
$stmt->close();

$e_other = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `type` = 'other'";
$stmt = $conn->prepare($e_other);
$stmt->execute();
$stmt->bind_result($e_other);
$stmt->fetch();
$stmt->close();

//check

$total = $income - ($expenese + $saving);
$target_saving = 0.3 * $income;

if($income == null) {
    $income = 0;
}
if($expenese == null) {
    $expenese = 0;
}
if($e_food == null) {
    $e_food = 0;
}
if($e_travel == null) {
    $e_travel = 0;
}
if($e_subscription_fee == null) {
    $e_subscription_fee = 0;
}
if($e_laundry == null) {
    $e_laundry = 0;
}
if($e_other == null) {
    $e_other = 0;
}
if($saving == null) {
    $saving = 0;
}
?>