<?php
session_start();

// Check if session variables
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not
    header("Location: ../admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DispositionDiary Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap.min.css">

</head>

<body>
<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand">DD Admin</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="../logout.php" class="nav-link bg-warning">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Manage Details Section -->
    <div class="bg-dark text-white">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>

    <!-- Button Group -->
    <div class="row">
        <div class="col-md-12 bg-primary p-1">
            <div class="button text-center">
                <button><a href="index.php?users_active" class="nav-link bg-info my-1">View Active Users</a></button>
                <button><a href="index.php?insert_quote" class="nav-link bg-info my-1">Add Quote</a></button>
                <button><a href="index.php?faq_manage" class="nav-link bg-info my-1">Manage FAQ</a></button>
                <button><a href="index.php?analytics" class="nav-link bg-info my-1">Analytics</a></button>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container my-3">
        <?php
        // Include content based on the clicked button
        if(isset($_GET['users_active'])){
            include('users_active.php');
        }
        if(isset($_GET['insert_quote'])){
            include('insert_quote.php');
        }
        if(isset($_GET['faq_manage'])){
            include('faq_manage.php');
        }
        if(isset($_GET['analytics'])){
            include('analytics.php');
        }
        ?>
    </div>

    <!-- Footer -->
    <?php
	include('../templates/footer.php')
?>

</body>
</html>