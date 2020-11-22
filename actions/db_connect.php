<?php 
    // This avoids mysql_connect() deprecation error.
    error_reporting( ~E_DEPRECATED & ~E_NOTICE );

    // Defines standard access information for the database to be used by all other pages.
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cflms-marinbalabanov-codereview-11";

    // Connect method called by most other pages in this project.
    $connect = mysqli_connect($localhost, $username, $password, $dbname);

    // Tests the database connection.
    if($connect->connect_error) {
        die("connection failed: " . $connect->connect_error);
    } else {
        // echo "<h4>Successfully Connected</h4>";
    }
?>