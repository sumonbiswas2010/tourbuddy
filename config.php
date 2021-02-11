<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'student');
/*
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id12508335_sumon');
define('DB_PASSWORD', '$5V4rj<k5<]vULHD');
define('DB_NAME', 'id12508335_student');
*/
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        //For Database Creation
        $sql = "CREATE DATABASE IF NOT EXISTS student";
        if ($conn->query($sql) === TRUE) {
            //echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
        //echo "<br>";


        //For Table Creation
        $sql = "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(50) NOT NULL,
            `password` varchar(255) NOT NULL,
            `fname` varchar(50) NOT NULL,
            `lname` varchar(50) NOT NULL,
            `email` varchar(50) NOT NULL,
            `gender` varchar(10),
            `birthday` DATE,
            `rating` INT,
            `phone` INT NOT NULL,
            `fplace` varchar(50),
            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ";
        if ($conn->query($sql) === TRUE) {
            //echo "Table created successfully";
        } else {
            echo "Error creating Table: " . $conn->error;
        }
        //echo "<br>";
                //For Table Creation
                $sql = "
                CREATE TABLE IF NOT EXISTS `tour` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `username` varchar(50) NOT NULL,
                    `date` DATE,
                    `place` varchar(50),
                    `person` INT,
                    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
                ";
                if ($conn->query($sql) === TRUE) {
                    //echo "Table created successfully";
                } else {
                    echo "Error creating Table: " . $conn->error;
                }
                //echo "<br>";



/* Attempt to connect to MySQL database */

 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 /*
        $servername = "localhost";
        $username = "id12508335_sumon";
        $password = "$5V4rj<k5<]vULHD";
        $dbname = "id12508335_student";
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student";
        


        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            //echo "Database Connected Successfully";
        }
        //echo "<br>.<br>";

        //For Database Creation
        $sql = "CREATE DATABASE IF NOT EXISTS student";
        if ($conn->query($sql) === TRUE) {
            //echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
        //echo "<br>";
        */

?>