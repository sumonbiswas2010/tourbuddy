<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $birthday = $_POST["birthday"];
        $rating = $_POST["rating"];
        $phone = $_POST["phone"];
        $fplace = $_POST["fplace"];
        //echo "$fname, $lname, $email, $gender, $birthday, $rating, $phone, $fplace";

        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fname, lname, email, gender, birthday,rating, phone, fplace) VALUES ( ?,?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_username, $param_password,$fname, $lname, $email, $gender, $birthday, $rating, $phone, $fplace);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            //$sql = "INSERT INTO users (fname, lname, email,gender, birthday,rating, phone, fplace) VALUES ( $fname, $lname, $email, $gender, $birthday, $rating, $phone, $fplace)";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resigter to TourBuddy (Your Buddy on the Go)</title>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div id="topbar">
<a style="display: block;" href="index.html"><img id="toplogo" src="https://static1.squarespace.com/static/5cc14a14348cd977889594fc/t/5cca5ca32074b30001a7c869/1557904444930/?format=1500w"></a>
        <div id="top_button">
        <a href="index.html">Home</a>
            <a href="tours.html">Tours</a>
            <a href="">Blogs</a>
            <a href="">About Us</a>
            <a href="">Hotel Book</a>
            <a href="">Partner Match</a>
            </div>
    </div>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username*</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password*</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password*</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            
            <div class="form-group">
            <label for="fname">First Name:*</label>
			<input class="form-control" type="text" id="fname" name="fname" required> <br>
			<label for="lname">Last Name:*</label>
			<input class="form-control" type="text" id="lname" name="lname" required> <br>
            <label for="email">Email:*</label>
			<input class="form-control" type="email" id="email" name="email" required><br>
            <label for="gender">Gender:</label>
            <div class="form-control">
			<input   type="radio" id="male" name="gender" value="male">
			<label for="male">Male</label>
			<input  type="radio" id="female" name="gender" value="female">
			<label for="female">Female</label>
			<input type="radio" id="other" name="gender" value="other">
			<label for="other">Other</label> <br>
            </div>
            <br>
			<label for="phone">Phone number*:</label>
			<input class="form-control" type="tel" required id="phone" name="phone" placeholder="01XXXXXXXXX" pattern="[0-9]{11}"><br>
			<label for="birthdate">Birthday:</label>
            <input class="form-control" type="date" id="date" name="birthday"><br>
            <label >Hometown*:</label>
			<input class="form-control" type="text" required name="fplace"> <br>
			<label for="rating">Rate This Site (Optional):</label>
			<input type="number" id="rating" name="rating" required value=10 min="1" max="10"><br>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>