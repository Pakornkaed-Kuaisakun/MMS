<?php 
//Beta: not use
if(!isset($_SESSION['ID']) || $_SESSION['ID'] == "") {
    header("Location: https://localhost/MMS/ERROR/SESSION_ERROR.html");
    exit();
}

?>