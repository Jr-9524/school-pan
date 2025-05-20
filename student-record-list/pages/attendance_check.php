<?php include("../dbconnection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Check</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../css/attendanceqr.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../bootstrap.bundle.min.js"></script>
    <script src="../html5-qrcode.min.js"></script>
    <script src="../js/qrscan.js"></script>
    <script src="../js/index.js"></script>
</head>
<body>

    <div class="header text-white text-center p-3">
        <h1 class="d-flex justify-content-center align-items-center gap-2">
            <img src="../imgs/qr_code.svg" alt="QR Icon"> Qr Attendance
        </h1>
    </div>

    <div class="container py-4">
        <div class="row g-3">
            <div class="col-md-4" style="min-width: fit-content;">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center">
                            <img src="../imgs/qr_code_3.svg" class="me-2" width="20" alt="QR Icon"> Qr Attendance Check
                        </h5>
                    </div>

                    <div class="card-body">
                        <div id="qr-video" class="qr-video"></div>

                        <form action="attendance_check.php" method="POST" id="qrForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="section_select" class="form-label">Section</label>
                                    <select name="section" class="form-select" id="section_select" required>
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

                                <div class="col-md-6">
                                    <label for="subject_select" class="form-label">Course Code</label>
                                    <select name="subject-code" class="form-select" id="subject_select" required>
                                        <option value="">Select Course Code</option>
                                        <?php 
                                          $subjectList = mysqli_query($conn, "SELECT * FROM `subject-code-tbl`");
                                          if (mysqli_num_rows($subjectList) > 0) {
                                            while ($subjectRow = mysqli_fetch_assoc($subjectList)) {
                                              $selected = ($subjectRow['subject-code'] === ($subjectCode ?? '')) ? 'selected' : '';
                                              echo "<option value=\"{$subjectRow['subject-code']}\" $selected>{$subjectRow['subject-code']}</option>";
                                            }
                                          } else {
                                            echo "<option>No Subjects Available</option>";
                                          }      
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="qr_Text" class="form-label">Student ID</label>
                                <input type="text" name="qr_Text" id="qr_Text" class="form-control" placeholder="Student ID" readonly>
                            </div>

                            <div class="d-none">
                                <button type="submit" id="start_scan">Submit</button>
                            </div>
                        </form>
                    </div>
                     <div id="result" class="mt-4"></div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center">
                            <img src="../imgs/articleblack.svg" class="me-2" width="20"> Attendance Records
                        </h5>

                        <div class="btn-group w-30">
                                <a href="../index.php" class="btn btn-secondary btn-sm ">Back</a>
                                <a href="view_attendance_record.php" class="btn btn-primary btn-sm ">View Records</a>
                            </div>
                    </div>

                    <div class="card-body">
                        <div class="container mt-2" style="max-height: 500px; overflow-y: auto; ">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Section</th>
                                        <th>Subject Code</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
