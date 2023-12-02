<?php

$Monday = date("Y-m-d", strtotime("this week"));
$Tuesday = date("Y-m-d", strtotime("this week + 1 day"));
$Wednesday = date("Y-m-d", strtotime("this week + 2 days"));
$Thursday = date("Y-m-d", strtotime("this week + 3 days"));
$Friday = date("Y-m-d", strtotime("this week + 4 days"));
$Saturday = date("Y-m-d", strtotime("this week + 5 days"));
$Sunday = date("Y-m-d", strtotime("this week + 6 days"));

$Mf = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Monday'";
$stmt = $conn->prepare($Mf);
$stmt->execute();
$stmt->bind_result($Mon);
$stmt->fetch();
$stmt->close();

$Tf = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Tuesday'";
$stmt = $conn->prepare($Tf);
$stmt->execute();
$stmt->bind_result($Tue);
$stmt->fetch();
$stmt->close();

$Wf = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Wednesday'";
$stmt = $conn->prepare($Wf);
$stmt->execute();
$stmt->bind_result($Wed);
$stmt->fetch();
$stmt->close();

$Thf = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Thursday'";
$stmt = $conn->prepare($Thf);
$stmt->execute();
$stmt->bind_result($Thu);
$stmt->fetch();
$stmt->close();

$Ff = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Friday'";
$stmt = $conn->prepare($Ff);
$stmt->execute();
$stmt->bind_result($Fri);
$stmt->fetch();
$stmt->close();

$Sf = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Saturday'";
$stmt = $conn->prepare($Sf);
$stmt->execute();
$stmt->bind_result($Sat);
$stmt->fetch();
$stmt->close();

$Sunf = "SELECT SUM(amount) FROM `expenese` WHERE `accID` = '$ID' AND `time` = '$Sunday'";
$stmt = $conn->prepare($Sunf);
$stmt->execute();
$stmt->bind_result($Sun);
$stmt->fetch();
$stmt->close();

if ($Mon == null) $Mon = 0;
if ($Tue == null) $Tue = 0;
if ($Wed == null) $Wed = 0;
if ($Thu == null) $Thu = 0;
if ($Fri == null) $Fri = 0;
if ($Sat == null) $Sat = 0;
if ($Sun == null) $Sun = 0;

$data_eiw = array(
    array("label" => date("D", strtotime($Monday)), "y" => $Mon),
    array("label" => date("D", strtotime($Tuesday)), "y" => $Tue),
    array("label" => date("D", strtotime($Wednesday)), "y" => $Wed),
    array("label" => date("D", strtotime($Thursday)), "y" => $Thu),
    array("label" => date("D", strtotime($Friday)), "y" => $Fri),
    array("label" => date("D", strtotime($Saturday)), "y" => $Sat),
    array("label" => date("D", strtotime($Sunday)), "y" => $Sun)
)
?>