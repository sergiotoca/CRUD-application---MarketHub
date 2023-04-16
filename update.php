<?php
    session_start();

    if(isset($_GET['id']))  {
        // Connect to the database
        $mysqli = require __DIR__ . "/database.php";
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    
        // Retrieve user data from the database using session user ID
        $sql = "SELECT * FROM product
                WHERE product_id = {$_GET['id']}";
    
        $result = $mysqli->query($sql);
    
        // Store the user data in a variable
        $product = $result->fetch_assoc();

        $product_id = $product['product_id'];
    }

    if(isset($_POST['submit'])){
        $productName = $_POST['pname'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $user = $_SESSION['user_id'];

        
        // Use prepared statements to prevent SQL injection attacks
        var_dump($mysqli);
        $stmt = $mysqli->prepare("UPDATE product SET name=?, description=?, price=?, user_id=? WHERE product_id=?");
        $stmt->bind_param("ssdii", $productName, $description, $price, $user, $product_id);
        if (!$stmt) {
            die('Error preparing statement: ' . $mysqli->error);
        }
        
        if (!$stmt->execute()) {
            die('Error updating data into database: ' . $stmt->error);
        }

        $stmt->close();
        $mysqli->close();
        header("Location: index.php");
        exit;
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    </head>
    <body>
        <header>
            <?php include_once("nav-bar.php")?>
        </header>

        <h1>Edit Product</h1>

        <!-- Display the new product form -->
        <form method="post" action="update.php?id=<?php echo $product_id ?>">
            <div>
                <label for="pname">Product Name: </label>
                <input type="text" id="pname" name="pname" value="<?php echo $product['name']?>">
            </div>
            <div>
                <label for="description">Description: </label>
                <input type="text" id="description" name="description" value="<?php echo $product['description']?>">
            </div>
            <div>
                <label for="price">Price: </label>
                <input type="text" id="price" name="price" value="<?php echo $product['price']?>">
            </div>
            <div>
                <button class="btn btn-success" type="submit" name="submit">Update</button><br>
                <a href="index.php">Cancel</a>
            </div>

        </form>
        <?php include_once("footer.php"); ?>
    </body> 
</html>
