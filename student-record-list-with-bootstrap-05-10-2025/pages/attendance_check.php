<?php include("../dbconnection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Check</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../css/attendanceqr.css">
    <script src="../html5-qrcode.min.js"></script>
    <script src="../bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/qrscan.js"></script>
    <script src="../js/index.js"></script>
</head>
<body>

    <div class="header text-white text-center p-3">
        <h1 class="d-flex justify-content-center align-items-center gap-2" ><img src="../imgs/qr_code.svg">Qr Attendance</h1>
    </div>

    <div class="container py-3">
        <div class="card custom-rounded-top shadow-sm mb-0 form-container">
            <div class="card-body">
                <div class="bottom-border mb-2 d-flex justify-content-between align-items-center" >
                    <div>
                        <h5 class="card-title d-flex align-items-center">
                            <img src="../imgs/qr_code_3.svg" class="me-2" width="20"> Qr Attendance Check
                        </h5>
                    </div>

                    <div class="btn-group mb-2">
                        <a href="../index.php" class="btn btn-secondary">Back</a>
                        <a href="view_attendance_record.php" class="btn btn-primary">View Records</a>
                    </div>
                </div>
                

    <form action="attendance_check.php" method="POST" id="qrForm">
                    <div class="student-info">
                        <div class="student-form-inputs row g-3 mb-4">

                        <div class="col-md-8 w-50">
                            <label for="section" class="form-label">Section</label>
                <select name="section" class="form-select" id='section_select' required>
                                <option value="">Select Section</option>
                    <?php 
                        $sectionList = mysqli_query($conn, "SELECT * FROM `section-tbl`");
                        if (mysqli_num_rows($sectionList) > 0) {
                            while ($sectionRow = mysqli_fetch_assoc($sectionList)) {
                                $selected = ($sectionRow['section'] === ($section ?? '')) ? 'selected' : '';
                                echo "<option value=\"{$sectionRow['section']}\" $selected>{$sectionRow['section']}</option>";
                            }
                        } else {
                            echo "<option>No Sections Available</option>";
                        }      
                    ?>
                </select>
            </div>
                        
                        <div class="col-md-8 w-50">
                            <label for="subject-code" class="form-label">Course Code</label>
                    <select name="subject-code" class="form-select" id="subject_select" required>
                                <option value="">Select Course Code</option>
                        <?php 
                            $subjectList = mysqli_query($conn, "SELECT * FROM `subject-code-tbl`");
                            if (mysqli_num_rows($subjectList) > 0) {
                                while ($subjectRow = mysqli_fetch_assoc($subjectList)) {
                                    $selected = ($subjectRow['subject-code'] === $subjectCode) ? 'selected' : '';
                                    echo "<option value=\"{$subjectRow['subject-code']}\" $selected>{$subjectRow['subject-code']}</option>";
                                }
                            } else {
                                echo "<option>No Subjects Available</option>";
                            }      
                        ?>
                    </select>
            </div>

                        <div class="col-md-8 w-100">
                            <label for="qr_Text" class="form-label">Student ID</label>
                            <input type="text" name="qr_Text" id="qr_Text" placeholder="Student ID" class="form-control" readonly>
                        </div>

                    </div>

                    <button type="submit" value="view" id="start_scan"></button>   
                </form>
            </div>
        </div>

        <div class="scanner-container mb-4" id="scannerContainer">
        <div id="qr-video" class="qr-video"></div>
        </div>

    </div>
    
    
    <?php include("attendance_save.php"); ?>
</body>
</html>
