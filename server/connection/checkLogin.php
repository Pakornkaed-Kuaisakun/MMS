<?php
function check_login()
{
    if (strlen($_SESSION["ID"]) === 0) {
        $_SESSION["ID"] = "";
        header("Location: https://localhost/MMS/Login.php");
    }
}
?>