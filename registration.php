<html>
<?php 
	include('templates/header.php');
?>
<body>
<div class="container">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-DeAa3qRyDnm4yZ6w7XFnGOCxkIFIoAq30soHURW2QEQ=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('form').submit(function(e){
        var password1 = $('#user_password1').val();
        var password2 = $('#user_password2').val();

        // Check if passwords match
        if(password1 !== password2){
            alert("Passwords do not match");
            e.preventDefault(); // Prevent form submission
            return false; // Stop execution
        }

        // Check if password meets criteria
        if(!isValidPassword(password1)){
            alert("Password must be at least 8 characters long and contain at least one number and one capital letter.");
            e.preventDefault(); // Prevent form submission
            return false; // Stop execution
        }
    });

    // Function to validate password criteria in js 
    function isValidPassword(password) {
        // Regex to check if password contains at least one number one capital and one capitilisation
        var regex = /^(?=.*[0-9])(?=.*[A-Z]).{8,}$/;
        return regex.test(password);
    }

    $('.btn-back').click(function(){
        window.location.href = 'login.php'; // Go back to previous page
    });
});

</script>
<?php
include('includes/connect.php');
?>

<div class="d-grid gap-2">
    <a href="login.php" class="btn btn-lg btn-warning text-black">Go back</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center text-white mb-4">Registration Form</h2>
        <form action="" method="post" class="mb-2" enctype="multipart/form-data" autocomplete="off">
            <!-- Username Entry -->
            <div class="form-group">
                <label class="font-weight-bold text-white" for="user_username">Username</label>
                <input type="text" class="form-control" id="user_username" name="user_username" autocomplete="false" required="required" placeholder="Enter Username">
            </div>
            <!-- Email Entry -->
            <div class="form-group">
                <label class="font-weight-bold text-white" for="user_email">Email</label>
                <input type="email" class="form-control" id="user_email" required="required" name="user_email" placeholder="Enter Email">
            </div>
            <!-- Password -->
            <div class="form-group">
                <label class="font-weight-bold text-white" for="password1">Create Password</label>
                <input type="password" class="form-control" id="user_password1" name="user_password1" required="required" placeholder="Create Password 1">
            </div>
            <!-- Reenter Password -->
            <div class="form-group">
                <label class="font-weight-bold text-white" for="password2">Confirm Password</label>
                <input type="password" class="form-control" id="user_password2" name="user_password2" required="required" placeholder="Confirm Password">
            </div> 
            <div class="d-grid gap-2 col-8 mx-auto">
                <button type="submit" class="btn btn-primary btn-block" name="insert_entry" value="Register">Register</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>

<!-- Registration Logic -->
<?php
if(isset($_POST['insert_entry'])){
    $username = $_POST['user_username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password1']; 

    // Check if email already exists in the database
    $user_query = "SELECT * FROM user_info WHERE email='$email'";
    $result = mysqli_query($conn, $user_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0){
        echo "<script>alert('Account already exists.');</script>";
    } else {
        // Check if passwords match
        if($_POST['user_password1'] !== $_POST['user_password2']){
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            // Check if password meets criteria
            if(!isValidPassword($password)){
                echo "<script>alert('Password must be at least 8 characters long and contain at least one number and one capital letter.');</script>";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert into the database
                $insert_query = "INSERT INTO user_info (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

                // Execute query
                $result = mysqli_query($conn, $insert_query);

                if($result){
                    echo "<script>alert('Registration successful');;
                    window.location.href = 'login.php'</script>";
                } else {
                    echo "<script>alert('Registration failed');</script>";
                }
            }
        }
    }
}

// Function to validate password criteria in PHP as well
function isValidPassword($password) {
    // Regex to check if password contains at least one number one capital and one capitilisation
    $regex = '/^(?=.*[0-9])(?=.*[A-Z]).{8,}$/';
    return preg_match($regex, $password);
}
?>