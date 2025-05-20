<?php 
    session_start();
    include "../dbconnection.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $section = isset($_POST['section']) ? $conn->real_escape_string($_POST['section']) : null;
        $subjectCode = isset($_POST['subject-code']) ? $conn->real_escape_string($_POST['subject-code']) : null;
        $status = isset($_POST['enrol-status']) ? $conn->real_escape_string($_POST['enrol-status']) : null;
        $gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : null;
        $studID = isset($_POST['student-id']) ? $conn->real_escape_string($_POST['student-id']) : null;
        $lastName = isset($_POST['lname']) ? $conn->real_escape_string($_POST['lname']) : null;
        $firstName = isset($_POST['fname']) ? $conn->real_escape_string($_POST['fname']) : null;
        $mid = isset($_POST['mi']) ? $conn->real_escape_string($_POST['mi']) : null;
        $delData = isset($_POST['studentid']) ? $conn->real_escape_string($_POST['studentid']) : null;
        
        if ($_POST['action'] === 'add') {
            $check_sql = "SELECT * FROM `students-tbl` WHERE studentid = '$studID'";
            $check_result = $conn->query($check_sql);
            if ($check_result->num_rows > 0) {
                $_SESSION['error'] = "Student ID already exists.";
                header("Location: ../pages/add-student.php");
                exit();
            } else {
                $sql = "INSERT INTO `students-tbl` (studentid, lastName, firstName, mi, gender, section, enrollmentStatus)
                        VALUES ('$studID', '$lastName', '$firstName', '$mid', '$gender', '$section', '$status')";
                
                if ($conn->query($sql) === TRUE) {
                    if (!empty($_POST['subjects'])) {
                        foreach ($_POST['subjects'] as $subjectCode) {
                            $insertSubjectSql = "INSERT INTO `student-subjects` (studentid, `subject-code`)
                                                 VALUES ('$studID', '$subjectCode')";
                            if ($conn->query($insertSubjectSql) === FALSE) {
                                $_SESSION['error'] = "Error inserting subject: " . $conn->error;
                                header("Location: ../pages/add-student.php");
                                exit();
                            } 
                        }
                    }
                    $_SESSION['success'] = "Student added successfully!";
                    header("Location: ../pages/add-student.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "Error adding student: " . $conn->error;
                        header("Location: ../pages/add-student.php");
                        exit();
                    }
                }
            } elseif ($_POST['action'] === 'update') {
                $updateFields = [];
                
                if (!empty($lastName)) {
                    $updateFields[] = "lastName = '$lastName'";
                }
                if (!empty($firstName)) {
                    $updateFields[] = "firstName = '$firstName'";
                }
                if (!empty($mid)) {
                    $updateFields[] = "mi = '$mid'";
                }
                if (!empty($gender)) {
                    $updateFields[] = "gender = '$gender'";
                }
                if (!empty($section)) {
                    $updateFields[] = "section = '$section'";
                }
                if (!empty($status)) {
                    $updateFields[] = "enrollmentStatus = '$status'";
                }
                if (!empty($subject)) {
                    $updateFields = "subjects = '$subject'";
                }
                
                if (isset($_POST['subjects'])) {
                    $deleteSubjectsQuery = "DELETE FROM `student-subjects` WHERE studentid = '$studID'";
                    $conn->query($deleteSubjectsQuery);

                    foreach ($_POST['subjects'] as $subjectCode) {
                    $subjectCode = $conn->real_escape_string($subjectCode);
                    $insertSubjectSql = "INSERT INTO `student-subjects` (studentid, `subject-code`) VALUES ('$studID', '$subjectCode')";
                    
                    if ($conn->query($insertSubjectSql) === FALSE) {
                        $_SESSION['error'] = "Error inserting subject: " . $conn->error;
                        header("Location: ../pages/add-student.php");
                        exit();
                    }
                 }
            }
                
                $checkStudent = "SELECT * FROM `students-tbl` WHERE studentid = '$studID'";
                $result = $conn->query($checkStudent);
                if ($result->num_rows === 0) {
                    $_SESSION['error'] = "Cannot update. Student with ID '$studID' does not exist.";
                    header("Location: ../pages/add-student.php");
                    exit();
                }   

                if (!empty($updateFields)) {
                    $updateQuery = "UPDATE `students-tbl` SET " . implode(", ", $updateFields) . " WHERE `studentid` = '$studID'";
                    if ($conn->query($updateQuery) === TRUE) {
                        $_SESSION['info'] = "Student info updated successfully.";
                        header("Location: ../pages/add-student.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "Error updating student: " . $conn->error;
                        header("Location: ../pages/add-student.php");
                        exit();
                    }
                } 
            }
                       
        }
?>