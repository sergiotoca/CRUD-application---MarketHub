
<?php
// Database connection details
$host = "localhost";        // Host name or IP address of the database server
$dbname = "login_db";       // Name of the database to connect to
$username = "root";         // Database user name
$password = "";             // Password for the database user

// Create a new mysqli object and establish a database connection
$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password, 
                     database: $dbname);

// Check for any errors during the database connection process
if ($mysqli->connect_errno) {
    // If there is an error, display an error message and terminate the script
    die("Connection error: " . $mysqli->connect_error);
}

// Return the mysqli object for use in other parts of the application
return $mysqli;