<?php
$bg_warn = "background: yellow";
$bg_red = "background: #dc3545;";

$alert_e = "";
$alert_m = "";
$alert_s = "";
$alert_t = "";

if ($total <= $saving && $total != 0) {
    $warning = $bg_warn;
} else if ($total == 0) {
    $alert_t = $bg_red;
}

if ($moneyperDay == 90) {
    $alert_m = $bg_warn;
} else if ($moneyperDay < 90) {
    $alert_m = $bg_red;
}

if ($saving <= $target_saving*0.4 && $saving > 0) {
    if($total >= $target_saving) {
        $update = "UPDATE `saving` SET `amount` = '$target_saving' WHERE `accID` = '$ID'";
        $result = mysqli_query($conn, $update);
        header("Location: Refresh: 1");
        exit();
    } else {
        $alert_s = $bg_warn;
    }
}

if ($expenese >= $income) {
    $alert_e = $bg_red;
} else if ($expenese > ($income / 3)) {
    $alert_e = $bg_warn;
}
//no-debt
if ($total < 0 && $saving >= $total) {
    $new_saving = $saving - abs($total);
    $update = "UPDATE `saving` SET `amount` = '$new_saving' WHERE `accID` = '$ID'";
    $result = mysqli_query($conn, $update);
    header("Location: dashboard.php");
} else if ($saving < $total && $total < $expenese) {
    $debt = $saving - $total;
    $debt = "You have debt: " . $debt . " THB";
    $alert_s = $bg_red;
}