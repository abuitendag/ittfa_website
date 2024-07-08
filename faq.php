<?php
include('templates/header.php');
include('templates/navbar.php')
?>
<html>

<body>

	<div class="container-fluid">
    <div class="row">
        <div class="col">
            <!-- Carousel -->
            <?php include('templates/carousel.php'); ?>
        </div>
    </div>
</div>


<div id="accordion">
<?php
include('includes/connect.php');
// Retrieve faq entries
$select_query = "SELECT * FROM faq";
$result_query = mysqli_query($conn, $select_query);

// Loop through each faq
while ($row = mysqli_fetch_assoc($result_query)) {
    $faq_id = $row['faq_id'];
    $faq_title = $row['faq_title'];
    $faq_contents = $row['faq_contents'];
?>
    <div class="card">
        <div class="card-header" id="heading<?php echo $faq_id; ?>">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $faq_id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $faq_id; ?>">
                    <?php echo $faq_title; ?>
                </button>
            </h5>
        </div>
        <div id="collapse<?php echo $faq_id; ?>" class="collapse" aria-labelledby="heading<?php echo $faq_id; ?>" data-parent="#accordion">
            <div class="card-body">
                <?php echo $faq_contents; ?>
            </div>
        </div>
    </div>
<?php
}
?>

<?php

?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>	
<!--bootstrap js-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>