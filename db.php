<?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "leave_system";

    $connect = new mysqli($servername, $username, $password, $database);

    if ($connect->connect_error) {
        die("Connection failed : " . $connect->connect_error);
    }

    $connect->set_charset("utf8");
?>