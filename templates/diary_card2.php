<?php
$user_id = $_SESSION['user_id'];

// Fetch diary entries with their sentiment scores
$select_query = "SELECT de.entry_id, de.title, de.entry, sa.score
                 FROM diary_entry de
                 LEFT JOIN sentiment_analysis sa ON de.entry_id = sa.entry_id
                 WHERE de.user_id = $user_id";
$result_query = mysqli_query($conn, $select_query);

$user_query = "SELECT * from diary_entry where user_id='$user_id'";
    $result = mysqli_query($conn,$user_query);
    $rows_count = mysqli_num_rows($result);
    if($rows_count > 0){
        while ($row = mysqli_fetch_assoc($result_query)) {
            $entry_id = $row['entry_id'];
            $title = $row['title'];
            $entry = $row['entry'];
            $sentiment_score = $row['score'];
        
            // Determine image and text based on sentiment score
            $image_src = './images/diary.jpg'; 
            if ($sentiment_score >= 0.1) {
                  $image_src = './images/sentiment/happy.png';
                  $sentiment_score = "Happy";
            }
            elseif ($sentiment_score <= -0.1) {
             $image_src = './images/sentiment/unhappy.png'; 
             $sentiment_score = "Unhappy";
            }
             else {
                $image_src = './images/sentiment/neutral2.png';
                $sentiment_score = "Neutral"; 
            }
        
            echo "<div class='card text-white bg-dark bg-gradient mx-4 mb-3 border-info-subtle border-start-0 border-end-0' style='width: 20rem; border-radius: 10px; overflow: hidden;'>";
            echo "<img class='card-img-top' src='$image_src' alt='Card image cap'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>$title</h5>";
            echo "<p class='card-text'>$entry</p>";
            echo "<p class='card-text'>Sentiment Score: $sentiment_score</p>"; 
            echo "<td><a href='./user/diary_read.php?entry_id=$entry_id' class='btn btn-primary ' target='_blank'>Read...</a></td>"; 
            echo "</div>";
            echo "</div>";
        };
    } else{
        echo '<div class="card" aria-hidden="true">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title placeholder-glow">
         </h5>';
        echo '<p class="card-text placeholder-glow"><span class="placeholder col-7"></span>
        <span class="placeholder col-4"></span>
        <span class="placeholder col-4"></span>
        <span class="placeholder col-6"></span>
        <span class="placeholder col-8"></span></p>';

        echo '<a href="" tabindex="-1" class="btn btn-primary disabled placeholder col-6">No diary entries found...</a>';
        echo '</div>';
        echo '</div>';
    };


?>

