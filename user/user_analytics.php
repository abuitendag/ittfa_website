<?php
	include('../includes/connect.php');
  session_start();
  $user_id = $_SESSION['user_id'];
?>

<?php

//Count entries made
$count_query = "SELECT COUNT(*) AS entry_count FROM diary_entry WHERE user_id = $user_id";
	$count_result = mysqli_query($conn, $count_query);
	$row = mysqli_fetch_assoc($count_result);
	$entry_count = $row['entry_count'];

//Fetch sentiment scores
$select_query = "SELECT score FROM sentiment_analysis WHERE user_id = $user_id";
$result_query = mysqli_query($conn, $select_query);


//Store data for the graph
$data = array();

//Fetch data and store it in the array
while ($row = mysqli_fetch_assoc($result_query)) {
    $data[] = $row['score'];
}
?>

<?php
//PHP to JavaScript for Chart.js
$data_json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">
<?php
	include('../templates/header2.php');
	include('../templates/navbar.php');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-5">
      <div class="bg-info text-white p-3">
      <h4>Total Entries: <?php echo $entry_count; ?></h4>
      </div>
    </div>

    <div class="col-md-5">
      <div class="bg-secondary text-white p-3">
      <label for="chartSelect" class="form-label">Select Chart:</label>
      <select id="chartSelect" class="form-select">
        <option value="bar">Bar Chart</option>
        <option value="line">Line Chart</option>
        <option value="pie">Pie Chart</option>
      </select>
      </div>
    </div>
  </div>
</div>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="bg-light p-3">
        <canvas id="sentimentChart"></canvas>
      </div>
    </div>
  </div>
</div>
    </div>
    <script>
      //Converted to JSON data from db for chart 
    var data = <?php echo $data_json; ?>;

    //Cofigure chart
    const config = {
        type: 'bar',
        data: {
            labels: Array.from(Array(data.length).keys()), 
            datasets: [{
                label: 'Sentiment Scores',
                data: data,
                backgroundColor: 'rgba(0, 0, 255, 0.5)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Sentiment Analysis Chart',
                    color: 'white'
                }
            }
        },            scales: {
                x: {
                    label: 'Entry',
                    ticks: {
                        color: 'white' 
                    }
                },
                y: {
                    label: 'Sentiment score',
                    ticks: {
                        color: 'white' // 
                    }
                }
            }

    };

    //Chart.js
    var ctx = document.getElementById('sentimentChart').getContext('2d');
    var sentimentChart = new Chart(ctx, config);

    //Change graph type
    document.getElementById('chartSelect').addEventListener('change', function() {
    var chartType = this.value;
    
    //Destroy the current chart
    sentimentChart.destroy();
    
    //Update with selected chart type
    config.type = chartType;
    
    //Chart.js with updated config
    sentimentChart = new Chart(ctx, config);
});
</script>
</body>
</html>