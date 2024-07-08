<?php
session_start();
	include('includes/connect.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header('Location: login.php');
    exit();
}

// Access user_id and user_email from session
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];

?>
<body>

<?php 
    include('templates/header.php');
    include('templates/navbar.php');
?>
	<div class="container-fluid">
    <div class="row">
        <div class="col">
            <!--carousel -->
            <?php include('templates/carousel.php'); ?>
        </div>
    </div>
</div>
    <div class="container-fluid " >
        <div class="row mx-auto" >
            <div class="col-md-2 bg-secondary p-0 sidebar left bg-gradient" style="border-radius: 10px;">
                <div class="sidebar-header  text-white">
                    <h5 class="mx-1">Options:</h5>
                </div>
                <ul>
                
                    <li>
                        <a href="user/diary_entry.php" class="text-info" target="_blank">New Entry</a>
                    </li>
                    <li>
                        <a href="sentiment_analyser.php" class="text-info" >Analyse All</a>
                    </li>
					<li>
                        <a class="text-warning" href="faq.php">FAQ</a>
                    </li>
                </ul>
    
            </div>
            <div class="col-md-9 ">
                <div class="container ">
                    <div class="row justify-content-center">
<!-- Diary entries here -->
                        <?php
                        include('templates/diary_card2.php');
                        ?>
						<!-- row end here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="page-scroll-up">
<a href="#totop"></a>
</div>
<!-- footer-->
<?php
	include('templates/footer.php')
?>

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