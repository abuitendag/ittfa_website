<?php
session_start();
include('../templates/header2.php');

include('../includes/connect.php');
$user_id = $_SESSION['user_id'];
?>
<html>

<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="" method="post" class="mb-2">
        <div class="input-group">
          <input type="text" class="form-control" name="title" placeholder="Type in entry title.">
        </div>
        <div class="input-group">
          <textarea class="form-control" name="entry" rows="3" placeholder="Insert diary entry."></textarea>
        </div>
        <div class="text-center">
          <input type="submit" class="btn btn-primary" name="insert_entry" value="Insert Entry">
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
<?php
if(isset($_POST['insert_entry'])){
    $title=$_POST['title'];
    $entry=$_POST['entry'];
    $insert_query="INSERT INTO diary_entry (title, entry,user_id) VALUES ('$title','$entry',$user_id)";
    $result=mysqli_query($conn,$insert_query);
     
    if($result){
        // Display success message using JavaScript alert
        echo "<script>alert('Diary Entry Added'); setTimeout(function(){ window.close(); }, 1000);</script>";
        require_once('sentiment_analyser.php');
    } else {
        // Display error message if the execution fails
        echo "Error: ";
    }
    
};
?>