<?php
session_start();

require_once('sentiment/SentimentAnalyzer.php');
require_once('includes/connect.php'); 

// Instantiate SentimentAnalyzerTest
$sat = new SentimentAnalyzerTest(new SentimentAnalyzer());

// Function to analyze and store sentiment analysis results
function analyzeAndStoreSentiment($entry_id, $entry, $conn, $sat) {
    // Analyze the entry
    $analysis = $sat->analyzeSentence($entry);

    // Check if entry_id already exists
    $check_query = "SELECT * FROM sentiment_analysis WHERE entry_id = '$entry_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If Entry_id already exists, skip
        echo "Entry ID $entry_id already exists. Skipping insertion.\n";
        return;
    }
    $user_id = $_SESSION['user_id'];
    // Store result 
    $score = $analysis['accuracy']['positivity'] - $analysis['accuracy']['negativity'];
    $score = mysqli_real_escape_string($conn, $score); // Sanitise
    $insert_query = "INSERT INTO sentiment_analysis (score, entry_id, user_id) 
                     VALUES ('$score','$entry_id','$user_id')";
    $result = mysqli_query($conn, $insert_query);

    if (!$result) {
        echo "Error inserting sentiment analysis: " . mysqli_error($conn);
    }
}

// Train Sentiment Analyzer
$sat->trainAnalyzer('trainingSet/data.neg', 'negative', 5000); 
$sat->trainAnalyzer('trainingSet/data.pos', 'positive', 5000); 


$select_query = "SELECT * FROM diary_entry";
$result_query = mysqli_query($conn, $select_query);

if (!$result_query) {
    die("Error selecting diary entries: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result_query)) {
    $entry_id = $row['entry_id'];
    $entry = $row['entry'];

    // Sentiment analysis and store results
    analyzeAndStoreSentiment($entry_id, $entry, $conn, $sat);
}

?>