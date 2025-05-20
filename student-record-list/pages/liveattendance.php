<?php
    include("../dbconnection.php");

    $section = $_POST['section'] ?? '';
    $subjectCode = $_POST['subject-code'] ?? ''; 
    $attendanceQuery = mysqli_query($conn, "SELECT studentid, section, `subject-code`, DATE_FORMAT(scan_dateTime, '%h:%i %p') AS scan_time
    FROM `attendance_record` 
    WHERE DATE(scan_dateTime) = CURDATE()
    AND section = '$section'
    AND `subject-code` = '$subjectCode'");
    if (mysqli_num_rows($attendanceQuery) > 0) {
        while ($row = mysqli_fetch_assoc($attendanceQuery)) {
            echo "<tr>";
            echo "<td>{$row['studentid']}</td>";
            echo "<td>{$row['section']}</td>";
            echo "<td>{$row['subject-code']}</td>";
            echo "<td>{$row['scan_time']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found.</td></tr>";
    }
?>