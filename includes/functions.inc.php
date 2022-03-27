<?php
//add db connection
include_once "db.inc.php";

//Register
if(isset($_POST["register"])){
    $email = $pass = $fname = $tel = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = test_input($_POST['email']);
        $pass = test_input($_POST['pass']);
        $fname = test_input($_POST['fname']);
        $tel = test_input($_POST['phone']);
    }
    $query = "INSERT INTO user(user_email, user_password, user_fullname, user_phone)"
               ." VALUES('".$email."','".md5($pass)."','".$fname."','".$tel."')";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Register Success!")</script>';
        exit();
    }
    else{
        echo "Something went wrong please make sure to fill everythingh<br>" . mysqli_error($conn);   
    } 
    mysqli_close($conn);
}

//Login
if(isset($_POST["login"])){
    $email = $psw = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = test_input($_POST['email']);
        $psw = test_input($_POST['psw']);
    }
    $sql = "SELECT user_fullname FROM user WHERE user_email='".$email."' AND user_password='".md5($psw)."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //Set Session variables
            session_start();
            $_SESSION['email'] = $email;
            header('location: ../pages/main.php');
            exit();
        }
    }else{
        echo '<script>alert("Wrong email or password")</script>';
    }
    $conn->close(); 
}

//logout
if(isset($_POST["logout"])){
    session_destroy();
    header('location: ../pages/index.php');
    exit();
}

//Input filter
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data; 
}

//Display movies
function display_movies($conn){
    $sql = "SELECT m_title, t_link from movie";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $index = 0;
        while($row = $result->fetch_assoc()) {
        //thumbnail path
        $imgpath =  "../banners/".$row["m_title"].".jpg";
        if($index == 0){
            echo"<div class='carousel-item active'>";
        }else{
            echo"<div class='carousel-item'>";
        }
        echo "
                <div class='position-relative text-center' style='background-image: url(".str_replace(' ','%20',$imgpath).");  width: 100%; height: 92%; background-size: cover;'>
                    <div style='background-color:rgba(0,0,0,0.3);'>
                        <h1 class='p-4 text-white '>".$row["m_title"]."</h1>
                    </div>
                    <div class='position-absolute bottom-0 start-50 translate-middle-x pb-3'>                    
                        <a class='badge rounded-pill bg-light fs-5 text-decoration-none text-dark ' href='movie_det.php?m=".$row["m_title"]."'>Learn more</a>
                    </div>
                </div>
            </div>";
        $index++;
        }
    }
}

//Get movie category
function getmoviecat($title,$conn){
    $cats = array();
    $sql = "select cat_name from category cat
    join cat_move cm
    on cat.cat_id = cm.cat_id
    join movie m
    on m.movied_id = cm.movied_id
    where m.m_title =".$title;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['cat_name'];
        }  
    }
}

//Get movie trailer
function getmovielink($conn){
    //Gets the link of the corresponding movie through title
    $sql = "select t_link from movie where m_title = '".$_GET['m']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['t_link'];
        }  
    }
}

//Get movie desc
function getmoviedesc($conn){
    $sql = "select m_description from movie where m_title = '".$_GET['m']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['m_description'];
        }  
    }
}

//Display screenings
function screening($conn){
    //Returns every screening schedule for the movie and shows Datetime and Room 
    $sql = "SELECT sc_id,sc_datetime,room_id FROM screening s join movie m on(s.movied_id=m.movied_id) where m.m_title = '".$_GET['m']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table fs-5" style="width: 50%;margin: 0 auto">';
        echo '<tr>';
        echo '<td>Date Time</td><td>Room</td>';
        echo '</tr>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            //Redirects to bood.php to check for available seats and book ticktet(s)
            echo '<td><a href="book.php?id='.$row['sc_id'].'&r='.$row['room_id'].'">'.$row['sc_datetime'].'</a></td><td>'.$row['room_id'].'</td>';
            echo '</tr>';
        } 
        echo '</table>';
    }else{
        echo 'No Screening Scheduled';
    }$conn->close();
}

//Seats
function showseats($conn){
$sql = "select seat_id,seat_row,seat_number,availability from seat where room_id = '".$_GET['r']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        for($i=0;$i<5;$i++) {
            echo '<tr>';
            $j=0;
            while($row = $result->fetch_assoc()){
                //make space for hallway
                if($row['seat_number']==2){
                    echo "<td class='pe-5'>";
                }elseif($row['seat_number']==9){
                    echo "<td class='ps-5'>";
                }else{
                    echo "<td>";
                }

                if($row["availability"]=='T'){
                    //Red = seat is Taken
                    echo "<i class='material-icons' style='font-size:48px;color:red'>event_seat</i>".$row["seat_row"].$row["seat_number"]."</td>";
                }else if($row["availability"]=='E'){
                    //Gray = seat is empty
                    //Every selected seat will be stored in the array 'check_list'
                    echo "<i class='material-icons' style='font-size:48px;color:gray'>event_seat</i>".$row["seat_row"].$row["seat_number"]."<input type='checkbox'  name='check_list[] 'value='".$row['seat_id']."'></td>";
                }
                $j++;
                if($j%10==0){
                    echo '</tr>';
                    echo '<tr>';
                }
            }
            
        }
    }
}


//Booking ticket(s)
if(isset($_POST['book'])){
    if(!empty($_POST['check_list'])) {
        session_start();
        foreach($_POST['check_list'] as $check) {
                $sql="insert into ticket(seat_id,sc_id,user_email)values(".$check.",".$_SESSION['sc'].",'".$_SESSION['email']."')";
                if (mysqli_query($conn, $sql)){
                    echo 'Successfuly booked a ticket for seat id: '.$check.'<br>';
                }else{
                    echo 'Something went wrong for seat id: '.$check;
                }
        }
        $conn->close();
        echo '<br><a href=../pages/main.php>Back to Main page</a>';
    }
}

//history
function history($conn){
    session_start();
    $sql = "SELECT m_title,seat_row,seat_number,sc_datetime FROM ticket 
    join screening
    on(ticket.sc_id=screening.sc_id)
    join movie
    on(screening.movied_id=movie.movied_id)
    join seat
    on(ticket.seat_id=seat.seat_id)
    where user_email = '".$_SESSION['email']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['m_title']."</td><td>".$row['seat_row'].$row['seat_number']."</td><td>".$row['sc_datetime']."</td>";
            echo "</tr>";
        }
    }
    $conn->close();
}