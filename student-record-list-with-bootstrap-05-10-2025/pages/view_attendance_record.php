<?php include("../dbconnection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/index.js"></script>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <script src="../bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="header text-white text-center p-3">
        <h1 class="d-flex justify-content-center align-items-center gap-2" ><img src="../imgs/article.svg">Attendance List</h1>
    </div>

    <div class="container py-4">
        <div class="card custom-rounded-top shadow-sm mb-0">
            <div class="card-body">    
        <form action="view_attendance_record.php" method="POST">
                        <div>
                            <h5 class="card-title mb-2 d-flex align-items-center">
                                <img src="../imgs/filter.svg" class="me-2" width="20"> Filters
                            </h5>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label for="sectionFilter" class="form-label">Section</label>
                                <select name="section" class="form-select">
                                    <option value="">Select an option</option>
                        <?php 
                            $sectionList = mysqli_query($conn, "SELECT * FROM `section-tbl`");
                            if (mysqli_num_rows($sectionList) > 0) {
                                while ($sectionRow = mysqli_fetch_assoc($sectionList)) {
                                    $selected = ($sectionRow['section'] === $section) ? 'selected' : '';
                                    echo "<option value=\"{$sectionRow['section']}\" $selected>{$sectionRow['section']}</option>";
                                }
                            } else {
                                echo "<option>No Sections Available</option>";
                            }      
                        ?>
                    </select>
                            </div>
                                    
                            <div class="col-md-3">
                                <label for="sectionFilter" class="form-label">Course Code</label>
                                <select name="subject-code" class="form-select">
                                    <option value="">Select an option</option>
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
                                    
                            <div class="col-md-3">
                                <label for="sectionFilter" class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="">Select an option</option>
                        <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                            </div>
                                    
                            <div class="col-md-3">
                                <label for="sectionFilter" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" value="<?= isset($date) ? $date : '' ?>">
                            </div>
                        </div>
                                    
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end w-100">
                                <button type="submit" name="action" value="view" class="btn btn-primary me-2 fw-bold">
                                    Apply Filters
                    </button>
                                <button type="button" onclick="location.href='attendance_check.php'" name="action" value="view" class="btn btn-secondary fw-bold">
                                    Back
                                </button>
                    </div>
                </div>
            </form>
        </div>

            <div class="attendance-list-table">
                <table class="table table-hover align-middle">
  <thead class="table-dark text-center">
    <tr>
                            <th scope="col" class="text-center">Student ID</th>
                            <th scope="col" class="text-center">Last Name</th>
                            <th scope="col" class="text-center">First Name</th>
                            <th scope="col" class="text-center">M.I.</th>
                            <th scope="col" class="text-center">Gender</th>
                            <th scope="col" class="text-center">Section</th>
                            <th scope="col" class="text-center">Subject</th>
                            <th scope="col" class="text-center">Time In</th>
    </tr>
  </thead>

  <tbody>
  <?php
$date = isset($_POST['date']) ? $_POST['date'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$subjectRow = isset($_POST['subject-code']) ? $_POST['subject-code'] : '';
$sectionRow = isset($_POST['section']) ? $_POST['section'] : '';

$sql = "SELECT
    s.studentid,
    s.lastName,
    s.firstName,
    s.mi,
    s.gender,
    s.section AS student_section,
    a.`subject-code`,
    a.section AS attendance_section,
    a.scan_dateTime
FROM
    `students-tbl` s
JOIN
    attendance_record a ON s.studentid = a.studentid
WHERE
    1"; 
$params = [];
$types = "";

if (!empty($sectionRow)) {
    $sql .= " AND s.section = ?";
    $params[] = $sectionRow;
    $types .= "s";
}

if (!empty($subjectRow)) {
    $sql .= " AND a.`subject-code` = ?";
    $params[] = $subjectRow;
    $types .= "s";
}

if (!empty($gender)) {
    $sql .= " AND s.gender = ?";
    $params[] = $gender;
    $types .= "s";
}

if (!empty($date)) {
    $sql .= " AND DATE(a.scan_dateTime) = ?";
    $params[] = $date;
    $types .= "s";
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedTime = date('H:i', strtotime($row['scan_dateTime']));
        echo "<tr>
                <td>{$row['studentid']}</td>
                <td>{$row['lastName']}</td>
                <td>{$row['firstName']}</td>
                                            <td class='text-center'>{$row['mi']}</td>
                                            <td class='text-center'>{$row['gender']}</td>
                                            <td class='text-center'>{$row['student_section']}</td>
                                            <td class='text-center'>{$row['subject-code']}</td>
                                            <td class='text-center'>{$formattedTime}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
    echo "Searching for: Section = $sectionRow, Subject = $subjectRow, Gender = $gender, Date = $date";
}

$conn->close();
?>
  </tbody>
</table>
            </div>
        </div>
    </div>

</body>
</html>