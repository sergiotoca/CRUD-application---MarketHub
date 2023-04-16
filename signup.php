<!DOCTYPE html>
<html>
    <head>
        <title>Sign-up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
        <script src="js/validation.js" defer></script>

    </head>
    <body>
        <header>
            <?php include_once("nav-bar.php"); ?> 
        </header>

        <h1>Sign-up</h1>

        <form action="process-signup.php" method="post" id="signup" novalidate>
            <div>
                <label for="name">Name: </label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="email">Email Address: </label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="password_confirmation">Repeate Password: </label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
            <div>
                <input type="submit" value="Sign up">
                <a href="index.php">Cancel</a>
            </div>

        </form>
        

    </body>
    <?php include_once("footer.php"); ?> 
</html>