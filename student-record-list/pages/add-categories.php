<?php 
    session_start();
    include "../dbconnection.php";
?>
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
                    <!-- error -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <!-- success -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['success']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <!-- allready exist -->
                     <?php if (isset($_SESSION['info'])): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['info']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php unset($_SESSION['info']); ?>
                    <?php endif; ?>
                </div>
                    <form class="add-sub" method="POST" action="../php-process/categories-add.php">
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

                    <form class="add-sub" method="POST" action="../php-process/categories-add.php">
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
</body>
</html>