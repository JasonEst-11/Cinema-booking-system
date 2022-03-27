<?php
$conn = new mysqli("localhost", "root", "", "Cinema");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} $sql = "select seat_row,seat_number,availability from seat where room_id = '".$_GET['q']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<table border="1" cellspacing="10">';
    for($i=0;$i<5;$i++) {
        echo '<tr>';
        $j=0;
        while($row = $result->fetch_assoc()){
            if($row["availability"]=='A' || $row["availability"]=='E'){
                echo "<td bgcolor='gray' style='font-size: 24px'>".$row["seat_row"].$row["seat_number"]."</td>";
            }else if($row["availability"]=='B'){
                echo "<td bgcolor='red' style='font-size: 24px'>".$row["seat_row"].$row["seat_number"]."</td>";
            }
            $j++;
            if($j==10){break;}
        }
        echo '</tr>';
        }
    }
    echo '</table>';