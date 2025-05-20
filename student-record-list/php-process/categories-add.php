<?php 
    session_start();
    include "../dbconnection.php";
    $subCode = isset($_POST["sub-code"]) ? $conn->real_escape_string($_POST["sub-code"]) : '';
    $subName = isset($_POST["sub-name"]) ? $conn->real_escape_string($_POST["sub-name"]) : '';
    $sec = isset($_POST["sec-name"]) ? $conn->real_escape_string($_POST["sec-name"]) : '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_POST['action'] === 'add') {
            $check_sql = "SELECT * FROM `subject-code-tbl` WHERE `subject-code` = '$subCode'";
            $check_result = $conn->query($check_sql);
            if ($check_result->num_rows > 0) {
                $_SESSION['info'] = "Subject Code already exists.";
                header("Location: ../pages/add-categories.php");
                exit();
            } else {
                $sql = "INSERT INTO `subject-code-tbl` (`subject-code`, `subject-name`) VALUES ('$subCode', '$subName')";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['success'] = "Subject Successfully Added.";
                    header("Location: ../pages/add-categories.php"); 
                    exit();
                } else {
                    echo "Error: " . $conn->error;
                } 
            }
        } elseif ($_POST['action'] === 'update') {
            $update_sql = "UPDATE `subject-code-tbl` SET `subject-name` = '$subName' WHERE `subject-code` = '$subCode'";
            if ($conn->query($update_sql) === TRUE) {
                $_SESSION['info'] = "Subject Successfully Updated.";
                header("Location: ../pages/add-categories.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }     
        } elseif ($_POST['action'] === 'delete') {
            $check_related = "SELECT COUNT(*) as total FROM `attendance_record` WHERE `subject-code` = '$subCode'";
            $related_result = $conn->query($check_related);
            $row = $related_result->fetch_assoc();
            if ($row['total'] > 0) {
                $_SESSION['error'] = "Cannot delete subject — attendance records exist for this subject code.";
                header("Location: ../pages/add-categories.php");
                exit();
            } else {
                $delete_sql = "DELETE FROM `subject-code-tbl` WHERE `subject-code` = '$subCode'";
                if ($conn->query($delete_sql) === TRUE) {
                    $_SESSION['error'] = "Subject Successfully Deleted.";
                    header("Location: ../pages/add-categories.php");
                    exit();
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
        } elseif ($_POST['action'] === 'sec-add') {
            $check_sql = "SELECT * FROM `section-tbl` WHERE `section` = '$sec'";
            $check_result = $conn->query($check_sql);
            if ($check_result->num_rows > 0) {
                $_SESSION['error'] = "Section already exists.";
                header("Location: ../pages/add-categories.php");
                exit();
            } else {
                $sql = "INSERT INTO `section-tbl` (`section`) VALUES ('$sec')";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['success'] = "Section Successfully Added.";
                    header("Location: ../pages/add-categories.php"); 
                    exit();
                } else {
                    echo "Error: " . $conn->error;
                } 
            }
        } elseif ($_POST['action'] === 'sec-delete') {
            $check_related = "SELECT COUNT(*) as total FROM `attendance_record` WHERE `section` = '$sec'";
            $related_result = $conn->query($check_related);
            if ($related_result && $related_result->num_rows > 0) {
                $row = $related_result->fetch_assoc();
                if ($row['total'] > 0) {
                    $_SESSION['error'] = "Cannot delete section — attendance records exist for this section.";
                    header("Location: ../pages/add-categories.php");
                    exit();
                }
            }
            $delete_sql = "DELETE FROM `section-tbl` WHERE `section` = '$sec'";
            if ($conn->query($delete_sql) === TRUE) {
                $_SESSION['success'] = "Section Successfully Deleted.";
                header("Location: ../pages/add-categories.php");
                exit();
            } else {
                $_SESSION['error'] = "Error deleting section: " . $conn->error;
                header("Location: ../pages/add-categories.php");
                exit();
            }
        }
        $conn->close();
    }
?>