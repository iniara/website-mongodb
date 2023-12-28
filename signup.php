<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SIGN UP</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <h1>Welcome to <br> E-Library</h1>
        <p></p>
        <form action="actions/actions.php" method="POST">

            <input type="text" placeholder="Firstname" name="fname" id="fname" required="" /><br /><br />

            <input type="text" placeholder="Lastname" name="lname" id="lname" required="" /><br /><br />

            <input type="email" placeholder="Email" name="email" id="email" required="" /><br /><br />

            <input type="password" placeholder="Password" name="password" id="password" required="" /><br /><br />

            <input type="submit" name="signup" id="signup" value="SIGN UP" /><br /><br />

        </form>
        <a href="signin.php">Already have an account? Sign in</a>
    </div>
</body>

</html>
</span>