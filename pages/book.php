<?php 
include_once '../components/mainheader.php';
include_once '../includes/functions.inc.php';
session_start();
$_SESSION['sc'] = $_GET['id'];?>
<!--Booking form for seats-->

<div class="container text-center">
    <div class="bg-dark mx-auto mt-4 text-center" style="width:60%;height:30%;">
        <h1 class="text-white pt-5">Screen</h1>
    </div>
    <div class="mt-5">
        <form method="POST" action="../includes/functions.inc.php?" >
            <table class="fs-4 text-center" style='width: 100%;'>
                <?php showseats($conn);?>
            </table>
            <button class="btn btn-primary m-4" name="book">Submit</button>
        </form>
    </div>
</div>

<?php include_once '../components/footer.php'; ?>