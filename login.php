<?php
  session_start();
	include('includes/connect.php');
	include('templates/header.php');
  include('templates/navbar.php');
?>
<br>
<div class="container">
<form action="" method="post" enctype="multipart/form-data">
  <!-- Email-->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="email" name="user_email" id="user_email" class="form-control" />
    <label class="form-label" for="user_email">Email address</label>
  </div>

  <!-- Password -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="password" name="user_password" id="user_password" class="form-control" />
    <label class="form-label text-centre" for="user_password">Password</label>
  </div>

  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
     
      <div class="form-check">
      <a href="http://localhost/ittfa/registration.php">Not registered yet?</a>
      </div>
    </div>

    <div class="col d-flex justify-content-center">
     
      <a href="http://localhost/ittfa/admin_login.php">Admin Login</a>
    </div>
  </div>
  <div class="col justify-content-center d-flex">
  <button  type="submit" data-mdb-button-init data-mdb-ripple-init name='user_login' class="btn btn-lg btn-primary">Sign in</button>
  </div>
</form>
</div>
<!-- Landing page details -->
 <br>
<div class="container mt-4">
  <h4 class=" text-center">Welcome to DispositionDiary!</h4>
<ul class="list-group text-center">
  <li class="list-group-item list-group-item-primary">Insert your own diary entries.</li>
  <li class="list-group-item">Get sentiment analysis feedback.</li>
  <li class="list-group-item list-group-item-primary">Check statistics on your entries.</li>
  <li class="list-group-item">Free to use.</li>
</ul>
</div>
<?php

//If button pressed, login processed
if(isset($_POST['user_login'])){
  $user_email = mysqli_real_escape_string($conn, $_POST['user_email']); //Sanitise email input with PHP
  $user_password = $_POST['user_password'];
  
$select_query = "SELECT * FROM user_info WHERE email = '$user_email'";

$result = mysqli_query($conn,$select_query);
$row_count = mysqli_num_rows($result);
$retrieve_p = mysqli_fetch_assoc($result);
if($row_count > 0){
  if(password_verify($user_password,$retrieve_p['password'])){
    $_SESSION['user_email']=$user_email;
    $_SESSION['user_id'] = $retrieve_p['user_id'];
    $_SESSION['last_activity'] = time();
    $_SESSION['username'] = $retrieve_p['username']; 
    
    echo "<script>alert('Successful login')</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit; 
  }
  else{
    echo "<script>alert('Invalid Password')</script>";
    echo "User password: $user_password<br>";
echo "Hashed password from DB: {$retrieve_p['password']}<br>";
  }
}
else{
  echo "<script>alert('Invalid Email or Password')</script>";
}
};
?>
