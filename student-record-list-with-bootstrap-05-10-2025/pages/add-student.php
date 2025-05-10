<?php include("../dbconnection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <script src="../js/index.js"></script>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <script src="../bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="header text-white text-center p-3">
        <h1 class="d-flex justify-content-center align-items-center gap-2" ><img src="../imgs/person.svg">Add Student</h1>
    </div>
        
    <div class="container py-3">
        <div class="card custom-rounded-top shadow-sm mb-0 form-container">
            <div class="card-body">
                <div class="bottom-border mb-2">
                    <h5 class="card-title mb-2 d-flex align-items-center">
                        <img src="../imgs/account_circle.svg" class="me-2" width="20"> Student Info
                    </h5>
                </div>

                <form method="POST" action="add-student.php">
                    <div class="student-info">
                        <div class="student-form-inputs row g-3 mb-4">
                            <div class="col-md-8 w-100">
                                <label for="student-id" class="form-label">Student ID</label>
                                <input type="text" name="student-id" class="form-control"required>
                            </div>

                            <div class="col-md-5">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control">
                    </div>

                            <div class="col-md-5">
                                <label for="fname" class="form-label">First name</label>
                                <input type="text" name="fname" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <label for="mi" class="form-label">M.I.</label>
                                <input type="text" name="mi" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                            <option value="">Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                            </div>

                            <div class="col-md-4">
                                <label for="enrol-status" class="form-label">Enrollment Status</label>
                                <select name="enrol-status" class="form-select">
                            <option value="" >Status</option>
                            <option value="Regular">Regular</option>
                            <option value="Irregular">Irregular</option>
                        </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="section" class="form-label">Section</label>
                                <select name="section" class="form-select">
                            <option value="">Section</option>
                            <?php 

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sectionList = mysqli_query($conn, "SELECT * FROM `section-tbl`");
                                
                                if (mysqli_num_rows($sectionList) > 0) {
                                    while ($section = mysqli_fetch_assoc($sectionList)) {
                                        echo "<option value=\"{$section['section']}\">{$section['section']}</option>";
                                    }
                                } else {
                                    echo "<option>No Sections Available</option>";
                                }      
                            ?>
                        </select>
                    </div>

                            </div>
                
                <div class="bottom-border mt-2 mb-2">
                    <h5 class="card-title mb-2 d-flex align-items-center">
                        <img src="../imgs/book.svg" class="me-2" width="20">Courses
                    </h5>
                </div>
                <div class="mb-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="selectAll" onclick="toggleCheckboxes(this)">
                        <label class="form-check-label" for="selectAll">
                            Select All Subjects
                        </label>
                    </div>

                    <div class="courses-checkbox-container ">
                    <?php
                        $subjectList = mysqli_query($conn, "SELECT * FROM `subject-code-tbl`");
                        
                        if (mysqli_num_rows($subjectList) > 0): 
                            while ($subject = mysqli_fetch_assoc($subjectList)) {
                                echo '<div class="course-checkbox-item form-check">';
                                echo '<input class="form-check-input course-checkbox" type="checkbox" name="subjects[]" value="' . htmlspecialchars($subject['subject-code']) . '" id="subj-' . htmlspecialchars($subject['subject-code']) . '">';
                                echo '<label class="form-check-label" for="subj-' . htmlspecialchars($subject['subject-code']) . '">' . htmlspecialchars($subject['subject-code']) . '</label>';
                                echo '</div>';
                            }
                            else:
                                echo '<p>No subjects available</p>';
                            endif;
                    ?> 
                    </div>
                    </div>

                <div class="student-form-button d-flex gap-2 mt-3 justify-content-end">
                    <button type="submit" name="action" value="add" class="btn btn-success">
                        Add
                    </button>
                    <button type="submit" name="action" value="update" class="btn btn-primary">
                        Update
                    </button>
                    <button type="button" onclick="location.href='../index.php'" class="btn btn-secondary">
                        Back
                    </button>
                    </div>


                </form>
            </div>
            </div>
            </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $studID = isset($_POST['student-id']) ? $conn->real_escape_string($_POST['student-id']) : null;
            $lastName = isset($_POST['lname']) ? $conn->real_escape_string($_POST['lname']) : null;
            $firstName = isset($_POST['fname']) ? $conn->real_escape_string($_POST['fname']) : null;
            $mid = isset($_POST['mi']) ? $conn->real_escape_string($_POST['mi']) : null;

            if ($_POST['action'] === 'add') {
                $check_sql = "SELECT * FROM `students-tbl` WHERE studentid = '$studID'";
                $check_result = $conn->query($check_sql);

                if ($check_result->num_rows > 0) {
                    echo "<div class='student-exist'>Student ID already exists</div>";
                } else {
                    $sql = "INSERT INTO `students-tbl` (studentid, lastName, firstName, mi, gender, section, enrollmentStatus)
                            VALUES ('$studID', '$lastName', '$firstName', '$mid', '$gender', '$section', '$status')";
                    
                    if ($conn->query($sql) === TRUE) {
                        if (!empty($_POST['subjects'])) {
                            foreach ($_POST['subjects'] as $subjectCode) {
                                $insertSubjectSql = "INSERT INTO `student-subjects` (studentid, `subject-code`)
                                                     VALUES ('$studID', '$subjectCode')";
                                if ($conn->query($insertSubjectSql) === FALSE) {
                                    echo "Error inserting subject: " . $conn->error . "<br>";
                                } 
                            }
                        }
                        echo "<script> window.location.href='add-student.php'; </script>";
                        exit();
                    } else {
                        echo "<div class='error'>Error: " . $conn->error . "</div>";
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
                    echo "Error inserting subject: " . $conn->error . "<br>";
                    }
                 }
            }

                if (!empty($updateFields)) {
                    $updateQuery = "UPDATE `students-tbl` SET " . implode(", ", $updateFields) . " WHERE `studentid` = '$studID'";
                    if ($conn->query($updateQuery) === TRUE) {
                        
                        echo "<script> window.location.href='add-student.php'; </script>";
                        exit();
                    } else {
                        echo "Error updating student: " . $conn->error . "<br>";
                    }
                } 
            }
                       
        }
        ?>
</body>
</html>