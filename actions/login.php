<?php

session_start();

//this pulls the MongoDB driver from vendor folder
require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->perpustakaan;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = sha1($_POST['password']);
}

$data = array(
    "Email" => $email,
    "Password" => $password
);

//fetch user from MongoDB Users Collection
$fetch = $userCollection->findOne($data);

if ($fetch) {

    //create a session
    $_SESSION['email'] = $fetch['Email'];

    //redirect to the profile page
    header('Location: ../index.php');
    exit();
} else {
?>
    <center>
        <h4 style="color: red;">User Not Found</h4>
    </center>
    <center><a href="../signin.php">Try Again</a></center>
<?php
}
