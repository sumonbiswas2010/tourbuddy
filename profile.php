<?php
$user_value = $_GET['user'];
//echo "User".$user_value;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page: TourBuddy</title>
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        
        .head {
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
        #partner a 
        {
            text-decoration: none;
            color: aqua;
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
    <h5>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to <b><?php echo $user_value; ?></b>'s Profile.</h5>
    </div>
  
</div> <!-- /form -->


  <?php
    echo "<div id='partner'>";
    echo "<center><h3 class='head'>Showing Details of $user_value.</h3></center>";
    $sql = "SELECT * from `users` where `username` ='$user_value' ";
    $result = mysqli_query($conn, $sql);
    if ( mysqli_num_rows($result) > 0) {
        echo "<center><table align=center border=1px ><tr>";
        echo "<th><h4>Full Name</h3></th>";
        echo "<th><h4>Gender</h3></th>";
        echo "<th><h4>E-Mail</h3></th>";
        echo "<th><h4>Phone</h3></th>";
        echo "<th><h4>Hometown</h3></th>";
        echo "<th><h4>Member Since</h3></th></tr>";
        while ( $rows = mysqli_fetch_assoc($result)) {
            echo '<tr><td>' . $rows["fname"]." ".$rows["lname"] . '</td><td>' . $rows["gender"] . '</td><td>' ."<a href='mailto:$rows[email]?subject=Mail from TourBuddy!'>$rows[email]</a>" . '</td><td>' ."<a href='tel:0.$rows[phone]'>0$rows[phone]</a>" . '</td><td>' . $rows["fplace"] . '</td><td>' . $rows["created_at"] . '</td></tr>';
        }
        echo "</table></center>";
    }
    echo "</div>";


  ?>

    
</body>
</html>