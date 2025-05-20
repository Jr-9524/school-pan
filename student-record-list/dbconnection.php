<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "your_password";
    $db_name = "record-list";
    $conn = mysqli_connect($db_server,
                            $db_user,
                            $db_pass,
                            $db_name);
    
    // For Filters
    // $check_date = isset($_POST['check_date']) ? $conn->real_escape_string($_POST['check_date']) : null;
    // Subjects
    
    $date = isset($_POST['date']) ? $conn->real_escape_string($_POST['date']) : null;
    
?>