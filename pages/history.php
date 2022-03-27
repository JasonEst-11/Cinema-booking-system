<?php 
include_once "../components/mainheader.php";
include_once "../includes/functions.inc.php"
?>
<div class="container" style='height: 78%;'>
    <table class='table' style='width: 50%; margin-left: auto; margin-right: auto;'>
        <thead>
            <tr>
                <th scope='col'>Movie</th>
                <th scope='col'>Seat</th>
                <th scope='col'>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php history($conn);?>
        </tbody>
    </table>
</div>
<?php
include_once "../components/footer.php";?>
