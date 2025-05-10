<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Check</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../css/attendanceqr.css">
    <script src="../html5-qrcode.min.js"></script>
</head>
<div class="container d-flex gap-5">

<button type="button" onclick="location.href='../index.php'">Back</button>

    <div class="container border border-2 border-primary rounded">

    <form action="attendance_check.php" method="POST">
        <div class="filter-select-container d-flex justify-content-around align-items-end flex-wrap gap-3">

            <div>
                <select name="section" class="form-select" required>
                    <option value="">Section</option>
                    <?php 
                        include('../dbconnection.php');
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
                <select name="subject-code" class="form-select" required>
                    <option value="">Subject</option>
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
                    
            <div>
                <select name="gender" class="form-select">
                    <option value="All">Gender</option>
                    <option value="Male" <?= ($gender ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($gender ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
                        
            <div class="d-flex align-items-center gap-2">
                <input type="date" name="check_date" class="form-control"
                value="<?= htmlspecialchars($check_date ?? '') ?>" required>
                <button type="submit" name="action" value="view" class="btn btn-primary">
                    <img src="../images/search.svg" alt="Search" width="20" height="20">
                </button>
            </div>

        </div>
    </form>

        <div class="d-flex justify-content-around">
            <h2><?= ($section ?: 'Section') ?></h2>
            <h2><?= ($subjectCode ?: 'Subject') ?></h2>
            <h2><?= ($gender ?: 'Gender') ?></h2>
            <h2><?= ($check_date ?: 'Date') ?></h2>
        </div>


    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">M.I.</th>
                <th scope="col">Date & Time</th>
            </tr>
        </thead>
        <tbody id="table-body">

<?php                  
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'view') {
            include("../dbconnection.php");
            $sql = "SELECT 
                        s.studentid, 
                        s.lastName, 
                        s.firstName, 
                        s.mi, 
                        s.gender,
                        s.enrollmentStatus AS status,
                        a.scan_dateTime AS scan_dateTime,
                        s.section,
                        a.`subject-code`
                    FROM 
                        attendance_record a
                    JOIN 
                        `students-tbl` s ON a.studentid = s.studentid
                    WHERE 1=1";

            if (!empty($section)) {
                $sql .= " AND s.section = '" . mysqli_real_escape_string($conn, $section) . "'";
            }
            if (!empty($subjectCode)) {
                $sql .= " AND a.`subject-code` = '" . mysqli_real_escape_string($conn, $subjectCode) . "'";
            }
            if (!empty($status)) {
                $sql .= " AND s.enrollmentStatus = '" . mysqli_real_escape_string($conn, $status) . "'";
            }
            if (!empty($gender) && $gender !== 'All') {
                $sql .= " AND s.gender = '" . mysqli_real_escape_string($conn, $gender) . "'";
            }
            if (!empty($check_date)) {
                $sql .= " AND DATE(a.scan_dateTime) = '" . mysqli_real_escape_string($conn, $check_date) . "'";
            }

            $sql .= " ORDER BY a.scan_dateTime DESC";

            $result = mysqli_query($conn, $sql);
            $numRows = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $numRows++;
                echo "<tr>";
                echo "<td>{$numRows}</td>";
                echo "<td>{$row['lastName']}</td>";
                echo "<td>{$row['firstName']}</td>";
                echo "<td>{$row['mi']}</td>";
                echo "<td>" . date('Y-m-d h:i A', strtotime($row['scan_dateTime'])) . "</td>";
                echo "</tr>";

            }
                
            }

            $conn->close();
    ?>
</div>
</div>

        </tbody>
    </table>
</div>
</body>
</html>