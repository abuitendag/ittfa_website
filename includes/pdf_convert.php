<?php
session_start();
//FPDF used for conversion
require('../fpdf/fpdf.php'); 
include('../includes/connect.php');

//If button clicked, process 
if (isset($_POST['pdf_convert'])) {
    $user_id = $_SESSION['user_id'];
    $selected_entries = $_POST['selected_entries'];

    //Join diary entries with sentiment score
    $entries_query = "SELECT de.entry_id, de.title, de.entry, sa.score
                     FROM diary_entry de
                     LEFT JOIN sentiment_analysis sa ON de.entry_id = sa.entry_id
                     WHERE de.user_id = $user_id AND de.entry_id IN (" . implode(',', $selected_entries) . ")"; //Implode concatenates array into single string
    $result = mysqli_query($conn, $entries_query);

    //Create new pdf
    $pdf = new FPDF();
    $pdf->AddPage();

    //Retrieve username
    $username_query = "SELECT username FROM user_info WHERE user_id = $user_id";
    $username_result = mysqli_query($conn, $username_query);
    $username = mysqli_fetch_assoc($username_result)['username'];

    //Formatting
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Diary Entries for ' . $username, 0, 1, 'C');
    $pdf->Ln(10); 

    //Output each diary entry to PDF
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $entry = $row['entry'];
        $sentiment_score = $row['score']; // Fetch sentiment score from result

        //Add title
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, $title, 0, 1);

        //Add entry
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10, $entry);
        
        //Add sentiment score
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'Sentiment Score: ' . $sentiment_score, 0, 1);

        $pdf->Ln(); 
    }

    //PDF created to download
    $pdf->Output('D', 'diary_entries.pdf');
}
?>