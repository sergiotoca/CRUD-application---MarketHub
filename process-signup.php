<?php

// Check if name is not empty
if (empty($_POST["name"])) {
    die("Name is required");
}

// Check if email is valid
if (! filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required!");
}

// Check if password is at least 8 characters long
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters long!");
}

// Check if password contains at least one letter
if (! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

// Check if password contains at least one number
if (! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

// Check if passwords match
if($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

// Hash the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Connect to the database
$mysqli = require __DIR__ . "/database.php";

// Prepare the SQL statement
$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

// Check if the statement was successfully prepared
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

// Bind parameters to the statement
$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
// Execute the statement
if ($stmt->execute()) {
    
    // Redirect to the success page
    header("Location: signup-success.html");
    exit;
    
} 
else {
    
    // Handle errors
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
