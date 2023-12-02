<?php
    $HOST = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DB_NAME = "mms";

    $conn = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB_NAME);
    date_default_timezone_set("Asia/Bangkok");
    mysqli_query($conn, "SET NAMES 'utf8' ");
?>