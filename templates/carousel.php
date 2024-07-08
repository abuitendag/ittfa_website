<?php
include('includes/connect.php');
$quotes = "Select * from quotes";
$retrieved_quotes = mysqli_query($conn, $quotes);
?>

<div id="carouselExampleControls" class="carousel bg-gradient bg-secondary slide text-white mt-1 mb-1carousel-fade h6" style="border-radius: 10px;" data-ride="carousel">
  <div class="carousel-inner ">
    <?php
      //Counter to track active carousel item
      $counter = 0;
      //Loop through retrieved quotes
      while ($row_data = mysqli_fetch_assoc($retrieved_quotes)) {
        //Check if the current item is active
        $active_class = ($counter == 0) ? 'active' : '';
    ?>
    <div class="carousel-item text-center p-4 <?php echo $active_class; ?>">
      <!-- Display quote -->
      <p><?php echo $row_data['quote']; ?>    -    <?php echo $row_data['author']; ?></p>
    </div>
    <?php
        // Counter
        $counter++;
      }
    ?>
  </div>
  <!-- Control buttons -->
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only"></span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only"></span>
  </a>
</div>