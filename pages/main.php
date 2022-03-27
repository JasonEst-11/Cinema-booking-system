 <?php 
include_once "../components/mainheader.php";
include_once "../includes/functions.inc.php";
session_start();
if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
    header("location: ../pages/index.php");
    exit();
}
?>

<!-- Display movies -->
<div id='demo' class='carousel slide' data-bs-ride='carousel'>
    <div class="carousel-inner"> 
        <?php
        display_movies($conn);
        ?>

</div>
<button class='carousel-control-prev' type='button' data-bs-target='#demo' data-bs-slide='prev'>
    <span class='carousel-control-prev-icon'></span>
</button>
<button class='carousel-control-next' type='button' data-bs-target='#demo' data-bs-slide='next'>
    <span class='carousel-control-next-icon'></span>
</button>
</div>

<?php
include_once "../components/footer.php";
?>
     