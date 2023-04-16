<?php
    session_start();

    if(isset($_SESSION["user_id"]))  {
        // Connect to the database
        $mysqli = require __DIR__ . "/database.php";
    
        // Retrieve user data from the database using session user ID
        $sql = "SELECT * FROM user
                WHERE id = {$_SESSION["user_id"]}";
    
        $result = $mysqli->query($sql);
    
        // Store the user data in a variable
        $user = $result->fetch_assoc();
    }

    if(isset($_POST['submit'])){
        // Check if the image is uploaded
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            // Assign the uploaded image to a variable
            $image = $_FILES["image"];
            
            // Move the uploaded file to the protected directory on the server
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($image["name"]);
            move_uploaded_file($image["tmp_name"], $targetFile);
            
            // Assign the image URL to a variable
            $imageUrl =  "http://localhost/CRUD/" . $targetFile;
        }
        else{
            $imageUrl = "No Image";
        }
        $productName = $_POST['pname'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        
        // Use prepared statements to prevent SQL injection attacks
        $stmt = $mysqli->prepare("INSERT INTO `product`(`name`, `description`, `price`, `user_id`, `image_url`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $productName, $description, $price, $user['id'], $imageUrl);
        if (!$stmt) {
            die('Error preparing statement: ' . $mysqli->error);
        }
        
        if (!$stmt->execute()) {
            die('Error inserting data into database: ' . $stmt->error);
        }

        $stmt->close();
        header("Location: index.php");
        exit;
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Product</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    </head>
    <body>

        <h1>New Product</h1>

        <!-- Display the new product form -->
        <form method="post" action="create.php" enctype="multipart/form-data">
            <div>
                <label for="pname">Product Name: </label>
                <input type="text" id="pname" name="pname">
            </div>
            <div>
                <label for="description">Description: </label>
                <input type="text" id="description" name="description">
            </div>
            <div>
                <label for="price">Price: </label>
                <input type="text" id="price" name="price">
            </div>
            <div>
                <label for="image">Image: </label>
                <input type="file" id="image" name="image">
            </div>
            <div>
                <button class="btn btn-success" type="submit" name="submit">Register</button><br>
                <a href="index.php">Cancel</a>
            </div>

        </form>
    </body> 
</html>