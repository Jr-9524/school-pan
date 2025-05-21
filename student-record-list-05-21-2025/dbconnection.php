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
    $section = isset($_GET['section']) ? $conn->real_escape_string($_GET['section']) : null;
    $subjectCode = isset($_GET['subject-code']) ? $conn->real_escape_string($_GET['subject-code']) : null;
    $status = isset($_GET['enrol-status']) ? $conn->real_escape_string($_GET['enrol-status']) : null;
    $gender = isset($_GET['gender']) ? $conn->real_escape_string($_GET['gender']) : null;
    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : null;
    $check_date = isset($_POST['check_date']) ? $conn->real_escape_string($_POST['check_date']) : null;
    
    $conditions = [];
    if ($section) $conditions[] = "st.section = '$section'";
    if ($status) $conditions[] = "st.enrollmentStatus = '$status'";
    if ($gender) $conditions[] = "st.gender = '$gender'";
    if ($search) $conditions[] = "st.studentid LIKE '%$search%'";

    // Subjects
    $subCode = isset($_POST["sub-code"]) ? $conn->real_escape_string($_POST["sub-code"]) : '';
    $subName = isset($_POST["sub-name"]) ? $conn->real_escape_string($_POST["sub-name"]) : '';
    $sec = isset($_POST["sec-name"]) ? $conn->real_escape_string($_POST["sec-name"]) : '';
    
    $date = isset($_POST['date']) ? $conn->real_escape_string($_POST['date']) : null;
    
    $delData = isset($_POST['studentid']) ? $conn->real_escape_string($_POST['studentid']) : null;
    
    
?>