<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course and Section</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <script src="../bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/index.js"></script>
</head>
<body>
    <div class="header text-white text-center p-3">
        <h1 class="d-flex justify-content-center align-items-center gap-2"><img src="../imgs/history.svg">Course and Section</h1>
    </div>
    
    <div class="add-course-form container py-3">
        <div class="card custom-rounded-top shadow-sm mb-0">
            <div class="card-body">
                <div class="bottom-border mb-2">
                    <h5 class="mb-3 d-flex align-items-center">
                        <img src="../imgs/book.svg" class="me-2" width="20">Add Course
                    </h5>
                </div>
                    <form class="add-sub" method="POST">
                        <div class="row g-3 mb-4">
                            <div class="col-md-5 w-50">
                                <label for="sub-code" class="form-label">Course Code</label>
                                <input type="text" id="sub-code" name="sub-code" class="form-control" required value="<?php echo isset($subCode) ? htmlspecialchars($subCode) : ''; ?>">
                            </div>
                            <div class="col-md-5 w-50">
                                <label for="sub-name" class="form-label">Course Description</label>
                                <input type="text" id="sub-name" name="sub-name" class="form-control" value="<?php echo isset($subName) ? htmlspecialchars($subName) : ''; ?>">
                            </div>
                            <div class="d-flex gap-2 mt-3 justify-content-end">
                                <div class="col-md-6 d-flex align-items-end justify-content-end gap-2">
                                    <button type="submit" name="action" value="add" class="btn btn-success">Add</button>
                                    <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
                                    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="bottom-border mb-2">
                        <h5 class="mb-3 d-flex align-items-center">
                            <img src="../imgs/book.svg" class="me-2" width="20">Add Section
                        </h5>
                </div>

                    <form class="add-sub" method="POST">
                        <div class="row g-3 mb-4">
                            <div class="col-md-5 w-100">
                                <label for="sec-name" class="form-label">Section</label>
                                <input type="text" name="sec-name" required class="form-control" value="<?php echo isset($sec) ? htmlspecialchars($sec) : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 mt-3 justify-content-end">
                            <div class="col-md-6 d-flex align-items-end justify-content-end gap-2">
                                <button type="submit" name="action" value="sec-add" class="btn btn-success">Add</button>
                                <button type="submit" name="action" value="sec-delete" class="btn btn-danger">Delete</button>
                                <button type="button" onclick="location.href='../index.php'" class="btn btn-secondary">Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            

        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include("../dbconnection.php");

                if ($_POST['action'] === 'add') {
                    $check_sql = "SELECT * FROM `subject-code-tbl` WHERE `subject-code` = '$subCode'";
                    $check_result = $conn->query($check_sql);

                    if ($check_result->num_rows > 0) {
                        echo "<div class='subCode-exist'>Subject Code already exists.</div>";
                    } else {
                        $sql = "INSERT INTO `subject-code-tbl` (`subject-code`, `subject-name`) VALUES ('$subCode', '$subName')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='subCode-added'>Subject Successfully Added.</div>";
                            header("Refresh:0"); 
                            exit();
                        } else {
                            echo "Error: " . $conn->error;
                        } 
                    }
                } elseif ($_POST['action'] === 'update') {
                    $update_sql = "UPDATE `subject-code-tbl` SET `subject-name` = '$subName' WHERE `subject-code` = '$subCode'";
                    if ($conn->query($update_sql) === TRUE) {
                        echo "<div class='subCode-updated'>Subject Successfully Updated.</div>";
                        header("Refresh:0"); 
                        exit();
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }     
                } elseif ($_POST['action'] === 'delete') {
                    $delete_sql = "DELETE FROM `subject-code-tbl` WHERE `subject-code` = '$subCode'";
                    if ($conn->query($delete_sql) === TRUE) {
                        echo "<div class='subCode-deleted'>Subject Successfully Deleted.</div>";
                        header("Refresh:0"); 
                        exit();
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                } elseif ($_POST['action'] === 'sec-add') {
                    $check_sql = "SELECT * FROM `section-tbl` WHERE `section` = '$sec'";
                    $check_result = $conn->query($check_sql);

                    if ($check_result->num_rows > 0) {
                        echo "<div class='section-exist'>Section already exists.</div>";
                    } else {
                        $sql = "INSERT INTO `section-tbl` (`section`) VALUES ('$sec')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='section-added'>Section Successfully Added.</div>";
                            header("Refresh:0"); 
                            exit();
                        } else {
                            echo "Error: " . $conn->error;
                        } 
                    }
                } elseif ($_POST['action'] === 'sec-delete') {
                    $delete_sql = "DELETE FROM `section-tbl` WHERE `section` = '$sec'";
                    if ($conn->query($delete_sql) === TRUE) {
                        echo "<div class='sec-deleted'>Section Successfully Deleted.</div>";
                        header("Refresh:0");
                        exit();
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }
                $conn->close();
            }
        ?>
</body>
</html>