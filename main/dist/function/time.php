<?php
function countDaysBetweenDates($startDate, $endDate)
{
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);
    return $interval->days;
}

$startDate = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('last day of this month', time()));

if($total > 0) {
    $daysBetween = countDaysBetweenDates($startDate, $endDate);
    $moneyperDay = intdiv($total, $daysBetween);
} else {
    if($startDate != $endDate) {
        if($total > 0) {
            $daysBetween = countDaysBetweenDates($startDate, $endDate);
            $moneyperDay = intdiv($total, $daysBetween); 
        } else {
            $daysBetween = countDaysBetweenDates($startDate, $endDate);
            $moneyperDay = intdiv($saving, $daysBetween);
        }
    } else {
        $moneyperDay = $total;
    }
    
}

?>