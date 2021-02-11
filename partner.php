<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TourBuddy (Your Buddy on the Go)</title>
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        
        .head {
            text-transform: capitalize;
            margin: 5px;
        }

        table {
            text-align: center;
            border: 1px solid green;
        }

        table th {
            color: red;
            height: 40px;
        }

        table td {
            height: 30px;
        }
        </style>

</head>
<body onload="showSlides(1)">
<?php
// Initialize the session
session_start();

require_once "config.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
    <div id="topbar">
    <a style="display: block;" href="index.html"><img id="toplogo" src="https://static1.squarespace.com/static/5cc14a14348cd977889594fc/t/5cca5ca32074b30001a7c869/1557904444930/?format=1500w"></a>
        <div id="top_button">
            <a href="index.html">Home</a>
            <a href="tours.html">Tours</a>
            <a href="">Blogs</a>
            <a href="">About Us</a>
            <a href="">Hotel Book</a>
            <a href="logout.php">Sign Out</a>
            </div>
    </div>
    <div id="signup">
    <h5>Hi, <b><?php echo ($_SESSION["username"]); ?></b>. Welcome to our site.</h5>
    </div>
  
</div> <!-- /form -->
    
    <!-- Slideshow container -->
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <img src="Media/slider0.jpg" style="width:100%">
      <div class="text">Caption</div>
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <img src="Media/slider.jpg" style="width:100%">
      <div class="text">Caption</div>
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <img src="Media/slider1.jpg" style="width:100%">
      <div class="text">Caption</div>
    </div>
  
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>
  
  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

  <div id="search_partner">
      <form method="post">
          <label>Where do you want to travel?</label>
          <input name="location" type="text">
          <br>
          <label>When do you want to travel?</label>
          <input name="date" type="date"><br>
          <label>How Many Persons?</label>
          <input name="person" type="int"><br>
          <input class="button" name="submit" type="submit">
      </form>
  </div>

  <?php

if (isset($_POST["submit"])) {
    
    $person = $_POST["person"];
    $place = $_POST["location"];
    $date = $_POST["date"];
    $user = strval(htmlspecialchars($_SESSION["username"]));

    //echo $user, $place, $date, $person;
    
    $sql = "INSERT INTO `tour`(`username`, `place`, `date`, `person`) VALUES ('$user', '$place', '$date', $person)";
    if ($conn->query($sql) === TRUE) {
        //echo "Record inserted successfully for user: ".$user;
    } else {
        //echo "Error Inserting Record: " . $conn->error;
    }

    echo "<div id='partner'><center><h3 class='head'>Showing Matching Tour Partners</h3></center>";
    $sql = "SELECT * from `tour` where `place` = '$place' AND `date` = '$date' AND NOT `username`= '$user' ";
    //echo "search for: ".$place.$date;
    $result = mysqli_query($conn, $sql);
    if ( mysqli_num_rows($result) > 0) {
        echo "<center><table align=center border=1px ><tr><th><h4>Serial</h4></th>";
        echo "<th><h4>User's Profile</h3></th>";
        echo "<th><h4>User</h3></th>";
        echo "<th><h4>Place</h3></th>";
        echo "<th><h4>Date</h3></th></tr>";
        while ( $rows = mysqli_fetch_assoc($result)) {
            echo '<tr><td>' . $rows["id"] . '</td><td>'."<a href='profile.php?user=$rows[username]'>Click ME</a>".'</td><td>' . $rows["username"] . '</td><td>' . $rows["place"] . '</td><td>' . $rows["date"] . '</td></tr>';
        }
        echo "</table></center>";
    }
    else
    {
        echo "<br>"."Sorry, No partner Found. We'll notify you later.";
    }
    echo "</div>";

}
  ?>

    
</body>
</html>