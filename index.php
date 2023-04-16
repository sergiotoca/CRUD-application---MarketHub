<?php
// Start a session to retrieve user data
session_start();
include 'database.php';

if(isset($_SESSION["user_id"]))  {

    // Retrieve user data from the database using session user ID
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    // Store the user data in a variable
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2.1.1/out/water.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        

    </head>
    <body>
    <style>
        @media (min-width: 750px) {
            body {
            margin-left: 30%;
            }
        }
    </style>
    <!-- Display the nav bar -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php">MarketHub</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php if(isset($user)): ?>
                        <li class="nav-item">
                        <a class="nav-link" href="create.php">New Product</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                        <a class="nav-link" href="login.php">Log In</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="signup.html">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
                </div>
            </nav>
        </header>

        <!-- Display a greeting message if the user is logged in -->
        <?php if(isset($user)): ?>

            <p style="margin-left:15px;"> Hello <?= htmlspecialchars($user["name"]) ?>!</p>
            <table class=table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">User</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT product.*, user.name as user_name 
                        FROM product 
                        INNER JOIN user ON product.user_id = user.id";
                        $result = $mysqli->query($sql);
                        if(!$result){
                            die("Invalid query!");
                        }
                        while($row=$result->fetch_assoc()){

                            $dprice ="$".number_format($row['price'],2);

                            if($row['user_id']==$_SESSION['user_id']){
                                echo "
                            
                            <tr>
                                <td>$row[product_id]</td>
                                <td>$row[name]</td>
                                <td>$row[description]</td>
                                <td>$dprice</td>
                                <td><a href='$row[image_url]'>Image</a></td>
                                <td>$row[user_name]</td>
                                <td>
                                    <a class='btn btn-success' href='update.php?id=$row[product_id]' style='margin-right:10px;'>Edit</a>
                                    <a class='btn btn-danger' href='delete.php?id=$row[product_id]'>Delete</a>
                                </td>
                            </tr>
                            ";
                            }
                            else{
                                echo "
                            
                                <tr>
                                    <td>$row[product_id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[description]</td>
                                    <td>$dprice</td>
                                    <td><a href='$row[image_url]'>Image</a></td>
                                    <td>$row[user_name]</td>
                                    <td></td>
                                </tr>
                                "; 
                            }
                            

                        }
                    ?>

                </tbody>
            </table>
            

        <!-- Display a carousel with the registered products if the user is not logged in -->
        <?php else: ?>

            <style>                
                .carousel-inner img {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
                
                .carousel-caption h5, .carousel-caption p {
                    color:bisque;
                    text-shadow: 2px 2px 4px rgba(0,0,0,1);
                }

                .carousel-control-prev-icon,
                .carousel-control-next-icon {
                    filter: invert(100%);
                }

                .carousel-indicators li {
                    background-color: black;
                }
            </style>
            <?php
                $sql = "SELECT product.*, user.name as user_name 
                        FROM product 
                        INNER JOIN user ON product.user_id = user.id";
                $result = $mysqli->query($sql);
                if(!$result){
                    die("Invalid query!");
                }
            ?>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                            $i = 0;
                            while($row=$result->fetch_assoc()){
                                if($i == 0){
                                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="active"></li>';
                                } else {
                                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
                                }
                                $i++;
                            }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        $result->data_seek(0);
                        while($row=$result->fetch_assoc()){
                            if($i == 0){
                                echo '<div class="carousel-item active">';
                            } else {
                                echo '<div class="carousel-item">';
                            }
                            echo '<img class="d-block w-100" src="'.$row['image_url'].'" alt="'.$row['name'].'">';
                            echo '<div class="carousel-caption d-none d-md-block">';
                            echo '<h5>'.$row['name'].'</h5>';
                            echo '<p>'.$row['description'].'</p>';
                            echo '<p>$'.number_format($row['price'],2).'</p>';
                            echo '</div>';
                            echo '</div>';
                            $i++;
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


        <?php endif; ?>

        <!-- Display the footer -->
        <footer>
            <div class="container">
                <div class="row">
                <div class="col-md-6">
                    <h5>MarketHub</h5>
                    <p>All Rights Reserverd</p>
                </div>
                <div class="col-md-6">
                    <h5>Contact Us</h5>
                    <p><a href="mailto:sergiop@toledo.com.br">Email</a></p>
                </div>
                </div>
            </div>
        </footer>            
    </body>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>