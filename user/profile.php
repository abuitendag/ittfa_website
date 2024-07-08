<?php
session_start();

include('../templates/header2.php');
include('../includes/connect.php');
$user_id = $_SESSION['user_id'];


// Access user_id and user_email from session
$user_id = $_SESSION['user_id'];

// Fetch user details from database
$select_query = "SELECT * FROM user_info WHERE user_id = $user_id";
$result = mysqli_query($conn, $select_query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
} else {
    // Handle error if user not found
    echo "Error: User not found";
    exit();
}

// Handle form submission for updating user details
if(isset($_POST['update_profile'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];

    // Update query
    $update_query = "UPDATE user_info SET username = '$new_username', email = '$new_email' WHERE user_id = $user_id";

    if(mysqli_query($conn, $update_query)) {
        // Update session variables if necessary
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;

        echo "<script>alert('Profile updated successfully');</script>";
        // Refresh the page to reflect updated information
        echo "<script>window.location.reload();</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}

include('../templates/navbar.php');
?>

<div class="container mt-4">
    <h1>Profile Details</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="new_username" value="<?php echo $username; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="new_email" value="<?php echo $email; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
    </form>
</div>

<?php
include('../templates/footer.php');
?>