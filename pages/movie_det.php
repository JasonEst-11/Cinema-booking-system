<?php 
include_once "../components/mainheader.php";
include_once "../includes/functions.inc.php"
?>

<!--Display movie details and trailer-->
<div class="fs-4">
    <div class="gap-3">
        <iframe width="100%" height="92%" src="<?php ;getmovielink($conn);?>" frameborder="0" allowfullscreen></iframe>
    </div>
    <!-- Movie description and screening schedule -->
    <div class="container text-center">
        <div class="row p-3">
            <p class="p-3">
            <?php getmoviedesc($conn); ?>
            </p>
        </div>
        <!-- Screen Dates -->
        <div class="row p-3">
            <h2 class="p-3">Screenings</h3> 
            <?php screening($conn); ?>
        </div>
    </div>
</div>      

<?php 
include_once "../components/footer.php";
?>
