<?php
    include("../dbconnection.php");

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $qr_scan = $_POST['qr_Text'] ?? null;
        $subject_code = $_POST['subject-code'] ?? null;
        $section = $_POST['section'] ?? null;
        $date = isset($_POST['date']) ? $_POST['date'] : '';

            if (empty($subject_code) || empty($section)) {
                echo "<div class='alert alert-warning text-center m-auto' role='alert' style='width: 300px;'>
                    <strong>Warning:</strong> Select Section and Subject.
                </div>";
            } else {  

            $checkQuery = "SELECT s.*, ss.* 
            FROM `students-tbl` s 
            JOIN `student-subjects` ss ON s.studentid = ss.studentid 
            WHERE s.studentid = '$qr_scan' 
            AND ss.`subject-code` = '$subject_code'
            AND s.section = '$section'";

            $check_result = $conn->query($checkQuery);

            if ($check_result->num_rows > 0) {

                $checkAttendanceQuery = "SELECT * FROM attendance_record 
                                         WHERE studentid = '$qr_scan' 
                                         AND `subject-code` = '$subject_code' 
                                         AND section = '$section'
                                         AND DATE(scan_dateTime) = DATE(NOW())";
            
                $attendance_result = $conn->query($checkAttendanceQuery);
            
                if ($attendance_result->num_rows > 0) {      
                    echo "<div class='alert alert-info text-center m-auto' role='alert' style='width: 300px;'>
                            <strong>Notice!</strong> Already recorded today!
                          </div>";
                } else {
                    $insert_sql = "INSERT INTO attendance_record (studentid, `subject-code`, section, scan_dateTime) 
                                   VALUES ('$qr_scan', '$subject_code', '$section', NOW())";
            
                    if ($conn->query($insert_sql) === TRUE) {
                        echo "<div class='alert alert-success text-center m-auto' role='alert' style='width: 300px;'>
                                <strong>Success!</strong> Attendance successfully recorded!
                              </div>";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                }
            } else {
                echo "<div class='alert alert-primary text-center m-auto' role='alert' style='width: 300px;'>
                        <strong>No Match</strong> No matching student data found.
                      </div>";
            }            
        }

        sleep(0.5);
        exit;
    } 

        $conn->close();
    ?>