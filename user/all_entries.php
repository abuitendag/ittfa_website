<?php 
    session_start();

    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if user id not set
        header('Location: login.php');
        exit();
    }
    $user_id = $_SESSION['user_id'];
	include('../includes/connect.php');
	include('../templates/header2.php');
	include('../templates/navbar.php');

    // delete request
    if(isset($_POST['delete_entry'])) {
        $entry_id_to_delete = $_POST['entry_id_to_delete'];

        // Delete sentiment analysis records 
        $delete_sentiment_query = "DELETE FROM sentiment_analysis WHERE entry_id = ?";
        $stmt_sentiment = mysqli_prepare($conn, $delete_sentiment_query);
        mysqli_stmt_bind_param($stmt_sentiment, "i", $entry_id_to_delete);

        if(mysqli_stmt_execute($stmt_sentiment)) {
            // Then delete diary entry
            $delete_query = "DELETE FROM diary_entry WHERE entry_id = ? AND user_id = ?";
            $stmt = mysqli_prepare($conn, $delete_query);
            mysqli_stmt_bind_param($stmt, "ii", $entry_id_to_delete, $user_id);

            if(mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Entry deleted successfully');</script>";
                // redirect to refresh the page 
                echo "<script>window.location.replace('".$_SERVER['PHP_SELF']."');</script>";
            } else {
                echo "<script>alert('Error deleting entry');</script>";
            }
            
            mysqli_stmt_close($stmt); 
        } else {
            echo "<script>alert('Error deleting associated sentiment analysis records');</script>";
        }
        
        mysqli_stmt_close($stmt_sentiment); 
    }
?>
<html>
<div class="container mt-4">
    <h1>Diary Entries</h1>
    <!-- Form used for pdf conversion -->
    <form action="http://localhost/ittfa/includes/pdf_convert.php" method="post">
        <!-- Table displays all diary entries -->
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Entry</th>
                <th scope="col">Action</th>
                <th scope="col">Select</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Dynamically fetch user entries and display in table
            $select_query = "SELECT * FROM diary_entry WHERE user_id = $user_id";
            $result_query = mysqli_query($conn, $select_query);
            $count = 1; // Counter

            while ($row = mysqli_fetch_assoc($result_query)) {
                $entry_id = $row['entry_id'];
                $title = $row['title'];
                $entry = $row['entry'];

                echo "<tr>";
                echo "<th scope='row'>$count</th>";
                echo "<td>" . htmlspecialchars($title) . "</td>";
                echo "<td>" . htmlspecialchars($entry) . "</td>";
                echo "<td>";
                // Options to read, delete or select
                echo "<a href='../user/diary_read.php?entry_id=$entry_id' class='btn btn-primary' target='_blank'>Read...</a>";
                echo "<form action='' method='post' style='display: inline;'>";
                echo "<input type='hidden' name='entry_id_to_delete' value='$entry_id'>";
                echo "<button type='submit' name='delete_entry' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<input type='checkbox' name='selected_entries[]' value='$entry_id'>";
                echo "</td>";
                echo "</tr>";

                $count++; // Counter
            }
            ?>
        </tbody>
    </table>
    <input type="submit" class="btn btn-success" name="pdf_convert" value="Generate PDF">
    </form>
</div>
</html>