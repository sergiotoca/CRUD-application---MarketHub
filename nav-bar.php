<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

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
                <a class="nav-link" href="signup.php">Sign Up</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
 </nav>