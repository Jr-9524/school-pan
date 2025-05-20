<?php 
    session_start();
    include("../dbconnection.php");
?>

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
                    <!-- Student already exist -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <!-- Success Adding Student -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['success']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <!-- Updating Student -->
                    <?php if (isset($_SESSION['info'])): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['info']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['info']); ?>
                    <?php endif; ?>
                </div>

                <form method="POST" action="../php-process/student-add-process.php">
                    <div class="student-info">
                        <div class="student-form-inputs row g-3 mb-4">
                            <div class="col-md-8 w-100">
                                <label for="student-id" class="form-label">Student ID</label>
                                <input type="text" name="student-id" class="form-control" required>
                            </div>

                            <div class="col-md-5">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>

                            <div class="col-md-5">
                                <label for="fname" class="form-label">First name</label>
                                <input type="text" name="fname" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <label for="mi" class="form-label">M.I.</label>
                                <input type="text" name="mi" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
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
        
        ?>
</body>
</html>