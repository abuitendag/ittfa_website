<?php

  session_start();
	include('includes/connect.php');
	include('templates/header.php');
  include('templates/navbar.php');
?>
<br>
<div class="container">
<form action="" method="post" enctype="multipart/form-data">
  <!--Username -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" name="username" id="username" class="form-control" />
    <label class="form-label" for="username">Username</label>
  </div>

  <!-- Password-->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="password" name="password" id="password" class="form-control" />
    <label class="form-label text-centre" for="password">Password</label>
  </div>

  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <div class="form-check">
      
      </div>
    </div>

    <div class="col d-flex justify-content-center">
      <a href="http://localhost/ittfa/login.php">User Login</a>
    </div>
  </div>
  <div class="col justify-content-center d-flex">
  <!-- Submit button -->
  <button  type="submit" data-mdb-button-init data-mdb-ripple-init name='admin_login' class="btn btn-lg btn-primary">Sign in</button>
  </div>
</form>
</div>
<?php
if(isset($_POST['admin_login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  
$select_query = "SELECT * FROM admin WHERE username = '$username'";

$result = mysqli_query($conn,$select_query);
$row_count = mysqli_num_rows($result);
$retrieve_p = mysqli_fetch_assoc($result);
if($row_count > 0){
  if(password_verify($password,$retrieve_p['password'])){
    $_SESSION['username']=$username;
    $_SESSION['admin_id'] = $retrieve_p['admin_id'];
    echo "<script>alert('Successful login')</script>";
    echo "<script>window.location.href = 'admin/index.php';</script>";
    exit; 
  }
  else{
    echo "<script>alert('Invalid Password')</script>";
    echo "User password: $password<br>";
echo "Hashed password from DB: {$retrieve_p['password']}<br>";
  }
}
else{
  echo "<script>alert('Invalid Email or Password')</script>";
}
};

?>