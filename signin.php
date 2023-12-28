<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>SIGN IN</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <div class="wrapper">
    <h1>Hello Again!</h1>
    <p>Welcome back! <br> You've been missed!</p>
    <form action="actions/login.php" method="POST">
      <input type="email" placeholder="Email" name="email" id="email" required="" /><br /><br />

      <input type="password" placeholder="Password" name="password" id="password" required="" /><br /><br />

      <input type="submit" name="login" id="login" value="SIGN IN" /><br /><br />
    </form>
    <a href="signup.php">New admin? Create account</a>
  </div>
</body>

</html>
</span>