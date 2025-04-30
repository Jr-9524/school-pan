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
    <script src="../js/qrscan.js"></script>
    <script src="../js/index.js"></script>
</head>
<body>

    <button type="button" onclick="location.href='../index.php'">Back</button>
    <button type="button" onclick="location.href='view_attendance_record.php'">View</button>

    <h1 class="text-center mt-5 mb-5">Attendance Check</h1>

    <form action="attendance_check.php" method="POST" id="qrForm">
        <div class="filter-select-container d-flex justify-content-around align-items-end flex-wrap gap-3 m-auto border" style="width: 300px;">

            <div>
                <select name="section" class="form-select" id='section_select' required>
                    <option value="">Section</option>
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
                        
            <div>
                    <select name="subject-code" class="form-select" id="subject_select" required>
                        <option value="">Subject</option>
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
                <input type="text" name="qr_Text" id="qr_Text" placeholder="Student ID" readonly>
                <button type="submit" value="view" class="btn btn-primary" id="start_scan"> Start Scan</button>
        </div>
    </form>

    <div class="scanner-container mt-2" id="scannerContainer">
        <div id="qr-video" class="qr-video"></div>
    </div>
    
    
    <?php include("attendance_save.php"); ?>
</body>
</html>
