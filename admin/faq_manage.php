<?php
include('../includes/connect.php'); 

//Insert new quote
if(isset($_POST['insert_faq'])){
    $faq_title = mysqli_real_escape_string($conn, $_POST['faq_title']);
    $faq_contents = mysqli_real_escape_string($conn, $_POST['faq_contents']);
    $insert_query = "INSERT INTO faq (faq_title, faq_contents) VALUES ('$faq_title','$faq_contents')";
    $result = mysqli_query($conn, $insert_query);
    if($result){
        echo "<script>alert('FAQ entry added successfully')</script>";
        echo "<script>window.location.href = 'index.php?faq_manage';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to add FAQ entry')</script>";
    }
}

//Fetch current FAQ entries
$select_query = "SELECT * FROM faq";
$result_query = mysqli_query($conn, $select_query);
?>

<!-- Faq form -->
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <input type="text" class="form-control my-1" name="faq_title" placeholder="Type in title" required>
    </div>
    <div class="input-group w-90 mb-2">
        <input type="text" class="form-control my-1" name="faq_contents" placeholder="Type in FAQ contents" required>
    </div>
    <div class="text-center">
        <input type="submit" class="bg-info p-2 my-1 px-5 border-0 text-white" name="insert_faq" value="Insert">
    </div>
</form>
<br>
<!--FAQ table -->
<h3 class="text-center">Current FAQ Entries</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">FAQTitle</th>
            <th scope="col">Contents</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result_query)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['faq_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['faq_title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['faq_contents']) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>