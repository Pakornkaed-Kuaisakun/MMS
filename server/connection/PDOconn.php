<?php
    $DB_USER = "root";
    $DB_PASS = "";
    $DB_HOST = "localhost";
    $DB_NAME = "mms";

    try {
        $conn = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $e->getMessage();
    }