<?php include "./dbconnection.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="./js/index.js"></script>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <script src="/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="header text-white text-center p-3">
        <h1 class="d-flex justify-content-center align-items-center gap-2"><img src="./imgs/school.svg"> Student Record List</h1>
    </div>

    <div class="container py-4">
        <div class="card custom-rounded-top shadow-sm mb-0">
            <div class="card-body">
                <form action="index.php" method="GET">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 d-flex align-items-center">
                            <img src="./imgs/filter.svg" alt="Filter" class="me-2" width="20"> Filters
                        </h5>

                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle fw-bold" type="button" id="actionsDropdown" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./imgs/cog.svg" alt="Settings" width="20" class="me-1"> Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdown">
                                <li>
                                    <a class="dropdown-item" href="./pages/add-student.php">
                                        Update Student
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./pages/add-categories.php">
                                        Add Course and Section
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./pages/attendance_check.php">
                                    Check Attendance
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row g-3 filter-inputs">
                        <div class="col-md-2">
                            <label for="sectionFilter" class="form-label">Section</label>
                            <select name="section" class="form-select" id="sectionFilter">
                                <option value="">All Sections</option>
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
                                
                        <div class="col-md-2">
                            <label for="subjectFilter" class="form-label">Subject</label>
                            <select name="subject-code" class="form-select" id="subjectFilter">
                                <option value="">All Subjects</option>
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
                                
                        <div class="col-md-2">
                            <label for="statusFilter" class="form-label">Status</label>
                            <select name="status" class="form-select" id="statusFilter">
                                <option value="">All Statuses</option>
                                <option value="Regular" <?= $status == 'Regular' ? 'selected' : '' ?>>Regular</option>
                                <option value="Irregular" <?= $status == 'Irregular' ? 'selected' : '' ?>>Irregular</option>
                            </select>
                        </div>
                                
                        <div class="col-md-2">
                            <label for="genderFilter" class="form-label">Gender</label>
                            <select name="gender" class="form-select" id="genderFilter">
                                <option value="">All Genders</option>
                                <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                                
                        <div class="col-md-4">
                            <label for="searchInput" class="form-label">Search Student ID</label>
                                <div class="input-group d-flex">
                                    <input type="text" class="form-control flex-grow-1" id="searchInput" name="search" placeholder="Student ID" value="<?= htmlspecialchars($search) ?>">
                                    <button class="btn btn-primary flex-shrink-0" type="submit" name="action" value="view">
                                        <img src="./imgs/search.svg" alt="Search" width="20">
                                    </button>
                                </div>
                        </div>

                    </div>
                                
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" name="action" value="view" class="btn btn-primary me-2 fw-bold">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="student-list-table-container table-responsive shadow-sm">
            <table class="table table-hover align-middle">
                <thead >
                    <tr>
                        <th scope="col" class="text-center">Student ID</th>
                        <th scope="col" class="text-center">Last Name</th>
                        <th scope="col" class="text-center">First Name</th>
                        <th scope="col" class="text-center">M.I.</th>
                        <th scope="col" class="text-center">Gender</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Section</th>
                        <th scope="col" class="text-center">Subject Code</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if ($subjectCode) {
                            $conditions[] = "sc.`subject-code` = '$subjectCode'";
                            $joinClause = "JOIN `student-subjects` AS sc ON st.studentid = sc.studentid";
                            $selectClause = "st.studentid, st.section, st.lastName, st.firstName, st.mi, st.gender, st.enrollmentStatus, sc.`subject-code`";
                        } else {
                            $joinClause = ""; 
                            $selectClause = "DISTINCT st.studentid, st.section, st.lastName, st.firstName, st.mi, st.gender, st.enrollmentStatus";
                        }

                        $whereClause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

                        $student_list = "SELECT $selectClause
                                        FROM `students-tbl` AS st
                                        $joinClause
                                        $whereClause";

                        $result = $conn->query($student_list);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['studentid']}</td>
                                        <td>{$row['lastName']}</td>
                                        <td>{$row['firstName']}</td>
                                        <td class='text-center'>{$row['mi']}</td>
                                        <td class='text-center'>{$row['gender']}</td>
                                        <td class='text-center'>{$row['enrollmentStatus']}</td>
                                        <td class='text-center'>{$row['section']}</td>";  
                                if ($subjectCode) {
                                    echo "<td class='text-center'>{$row['subject-code']}</td>";
                                } else {
                                    echo "<td class='text-center'>-</td>";
                                }

                                echo "<td class='text-center'>
                                        <form action='./php-process/delete_student.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this student?\");'>
                                            <input type='hidden' name='studentid' value='" . $row['studentid'] . "'>
                                            <button type='submit' name='delete' value='Delete' class='btn btn-sm btn-outline-danger'>
                                                Delete
                                            </button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center py-3'>No records found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>  
    
</body>
</html>
