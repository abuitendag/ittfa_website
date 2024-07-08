<?php

include('../includes/connect.php');
include('../templates/header2.php');

?>

<div class="container mt-4">

    <?php
    // Check if entry_id is provided in the URL
    if (isset($_GET['entry_id'])) {
        // Sanitize the input to prevent SQL injection
        $entry_id = mysqli_real_escape_string($conn, $_GET['entry_id']);
        
        // Query to retrieve the specific diary entry based on entry_id
        $select_entry_query = "SELECT * FROM diary_entry WHERE entry_id = '$entry_id'";
        $result_entry_query = mysqli_query($conn, $select_entry_query);

        // Check if query execution was successful and if entry exists
        if ($result_entry_query && mysqli_num_rows($result_entry_query) > 0) {
            $entry_data = mysqli_fetch_assoc($result_entry_query);
            $title = $entry_data['title'];
            $entry = $entry_data['entry'];
            $user_id = $entry_data['user_id'];

            // Display the full diary entry details
            echo '<div class="card text-white bg-info mb-3" style="max-width: 40rem;">';
            echo '<div class="card-header">Diary Entry</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($title) . '</h5>';
            echo '<p class="card-text">' . nl2br(htmlspecialchars($entry)) . '</p>'; // nl2br() to preserve line breaks
            echo '<p class="card-text">User ID: ' . $user_id . '</p>';
            echo '</div>'; // card-body
            echo '</div>'; // card
        } else {
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Diary entry not found.';
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Invalid request. Entry ID is missing.';
        echo '</div>';
    }
    ?>

</div> <!-- container -->

<?php
// Include footer HTML or closing tags
include('../templates/footer.php');
// Close database connection
mysqli_close($conn);
?>