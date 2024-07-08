<?php
include('../includes/connect.php');

//If button clicked, process form
if(isset($_POST['insert_quote'])){
    $quote=$_POST['quote'];
    $author=$_POST['author'];
    $insert_query="INSERT INTO quotes (quote, author) values ('$quote','$author')";
    $result=mysqli_query($conn,$insert_query);
    if($result){
        //Javascript sucess popup
        echo "<script>
        alert('Quote added')
        </script";
    }
}
?>
<!-- Form -->
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
    <input type="text" class="form-control my-1" name="quote" placeholder="Type in quote.">
</div>
<div class="input-group w-90 mb-2">
    <input type="text" class="form-control my-1" name="author" placeholder="Type in author.">
</div>
<div class="text-center">
        <input type="submit" class="bg-info p-2 my-1 px-5 border-0 text-white" name="insert_quote" value="Insert Quote"></button>
    </div>
</form>