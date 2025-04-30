<?php include("../dbconnection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body>
    <div class="text-center m-3 " style="border: 1px solid #ccc;">
        <form action="view_attendance_record.php" method="POST">
                <div class="filter-select-container d-flex justify-content-center"> 
                    <select name="section" class="dropdown-item">
                        <option value="">Section</option>
                        <?php 
                            include('dbconnection.php');

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

                    <select name="subject-code" class="dropdown-item">
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

                    <select name="gender" class="dropdown-item">
                        <option value="">Gender</option>
                        <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>

                    <input type="date" name="date" class="form-control border-0" value="<?= isset($date) ? $date : '' ?>">


                    <button type="submit" name="action" value="view" class="btn btn-primary text-nowrap">
                        Filter Search
                    </button>

                    
                    </div>
                </div>
            </form>
            <button type="button" onclick="location.href='attendance_check.php'" name="action" value="view" class="btn btn-primary text-nowrap ms-2">
                        QR
                    </button>
        </div>

<table class="table table-bordered table-striped">
  <thead class="table-dark text-center">
    <tr>
      <th>Student ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>M.I.</th>
      <th>Gender</th>
      <th>Section</th>
      <th>Subject</th>
      <th>Time In</th>
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
                <td class='td-center'>{$row['mi']}</td>
                <td class='td-center'>{$row['gender']}</td>
                <td>{$row['student_section']}</td>
                <td>{$row['subject-code']}</td>
                <td>{$formattedTime}</td>
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

</body>
</html>