<?php
//Connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Cinema";

//Block and Ublock Seat(s)
if(isset($_POST['block'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "update seat set availability = 'B' where seat_row = '".$_POST['row']."' and seat_number = ".$_POST['number']." and room_id = '".$_POST['Room']."'";
    if (mysqli_query($conn, $sql)){
        echo '<span class="popuptext" id="myPopup">Blocked '.$_POST['row'].''.$_POST['number'].' from room: '.$_POST['Room'].'</span>';
    }else{echo "Error: " . $sql . "<br>" . mysqli_error($conn); } mysqli_close($conn); 
    echo '<a href=admin.html>Back</a>';
}

if(isset($_POST['unblock'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "update seat set availability = 'E' where seat_row = '".$_POST['row']."' and seat_number = ".$_POST['number']." and room_id = '".$_POST['Room']."'";
    if (mysqli_query($conn, $sql)){
        echo '<span class="popuptext" id="myPopup">Ublocked '.$_POST['row'].''.$_POST['number'].' from room: '.$_POST['Room'].'</span>';
    }else{echo "Error: " . $sql . "<br>" . mysqli_error($conn); } mysqli_close($conn); 
    echo '<a href=admin.html>Back</a>';
}$conn->close();

//Book a ticket for a Customer
if(isset($_POST['book'])){
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="insert into ticket(seat_id,sc_id,user_email)values(
    (select seat_id from seat where seat_row = '".$_POST['row']."' and room_id = '".$_POST['room']."'),".$_POST['sc'].",'".$_POST['email']."')"; 
    if (mysqli_query($conn, $sql)){
        echo 'Su'; 
    }else{
        echo 'Something went wrong';
    }
    echo '<br><a href=admin.html>Back</a>';
}$conn->close();

//View Tickets by seat or Date
if(isset($_GET['vt'])){
$conn = new mysqli("localhost", "root", "", "Cinema");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_GET['row']=='' && $_GET['num']==''){
$sql = "SELECT ticket_id,movied_id,seat_row,seat_number,sc_datetime,user_email FROM ticket t
join screening s
on(t.sc_id=s.sc_id)
join seat st
on(t.seat_id=st.seat_id)
where s.sc_datetime like '%".$_GET['datetime']."%'";
}else if($_GET['row']!='' && $_GET['row']!=''){
$sql = "SELECT ticket_id,movied_id,seat_row,seat_number,sc_datetime,user_email FROM ticket t
join screening s
on(t.sc_id=s.sc_id)
join seat st
on(t.seat_id=st.seat_id)
where seat_row = '".$_GET['row']."' and seat_number = ".$_GET['num']."";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<td>Ticket ID</td><td>Movie ID</td><td>Seat Row</td><td>Seat Number</td><td>Date Time</td><td>Email</td>';
    echo '<tr>';
    while($row = $result->fetch_assoc()) {
       echo '<tr>'; 
       echo "<td>".$row["ticket_id"]."</td><td>".$row["movied_id"]."</td><td>".$row["seat_row"]."</td><td>".$row["seat_number"].
               "</td><td>".$row["sc_datetime"]."</td><td>".$row["user_email"]."</td>"; 
       echo '</tr>';
    }
    echo '</table>';
}else{
    echo 'No tickets found<br>';   
}
echo '<a href=admin.html>Back</a>';
$conn->close();
}