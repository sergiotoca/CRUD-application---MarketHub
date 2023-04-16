<?php

$is_invalid = false; // A flag to indicate whether the user input is valid or not

// Check if the script is being accessed via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST"){

    // Require the database connection script
    $mysqli = require __DIR__ . "/database.php";

    // Construct a SQL query to select a user based on their email address
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'", 
                    $mysqli->real_escape_string($_POST["email"]));
    
    // Execute the SQL query and get the result object
    $result = $mysqli->query($sql);             
    
    // Fetch the user data as an associative array
    $user = $result->fetch_assoc();

    // If a user with the given email exists and the password matches, set the session user_id
    if($user) {
        if(password_verify($_POST["password"], $user["password_hash"])){
            
            session_start();

            $_SESSION["user_id"] = $user["id"];

            // Redirect the user to the home page
            header("Location: index.php");
            exit;
        }
    }
    
    // Set the $is_invalid flag to true if the user input is invalid
    $is_invalid = true;    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    </head>
    <body>

        <h1>Login</h1>

        <?php if($is_invalid): ?>
            <em>Invalid Login!</em>
        <?php endif; ?>    

        <!-- Display the login form -->
        <form method="post">
            <div>
                <label for="email">Email Address: </label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <input type="submit" value="Log in">
                <a href="index.php">Cancel</a>
            </div>

        </form>
    </body> 
</html>
