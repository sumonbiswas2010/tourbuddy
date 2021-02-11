<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to TourBuddy</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div id="topbar">
<a style="display: block;" href="index.html"><img id="toplogo" src="https://static1.squarespace.com/static/5cc14a14348cd977889594fc/t/5cca5ca32074b30001a7c869/1557904444930/?format=1500w"></img></a>
        <div id="top_button">
            <a href="index.html">Home</a>
            <a href="tours.html">Tours</a>
            <a href="">Blogs</a>
            <a href="">About Us</a>
            <a href="">Hotel Book</a>
            <a href="partner.php">Partner Match</a>
            </div>
    </div>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>