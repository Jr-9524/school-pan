<?php 
    include "../dbconnection.php";

    if (isset($_POST['delete'])) {
        $delData = $conn->real_escape_string($_POST['studentid']);
        $subjectCode = $_GET['subject-code'] ?? ''; 
    
        if (empty($subjectCode)) {
            $deletesubdata = "DELETE FROM `student-subjects` WHERE studentid = '$delData'";
            $conn->query($deletesubdata);
        
            $delDatastud = "DELETE FROM `students-tbl` WHERE studentid = '$delData'";
            if ($conn->query($delDatastud)){
                header("Location: ../index.php");
                exit();
            }
        } else {
            $deletesubdata = "DELETE FROM `student-subjects` WHERE studentid = '$delData' AND `subject-code` = '$subjectCode'";
            if ($conn->query($deletesubdata)) {
                header("Location: ../index.php");
                exit();
            }
        }
    }

    $conn->close();

?>