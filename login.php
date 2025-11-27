<?php 
require_once "connect.php";
if(isset($_POST['cancel'])){
    header("Location: index.php");
    return;

}

$salt = 'XyZzy12*_';
$stored_hash = hash('md5', 'XyZzy12*_php123');; 

$failure = false;

if(isset($_POST['email']) && isset($_POST['password'])){
    if(strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1){
        $failure = "User name and password are required";
    }else if (strpos($_POST['email'], "@") === false){
        $failure = "Email must Have an at-sign (@)";
    }else {
        $check = hash('md5', $salt . $_POST['password']);
        if($check === $stored_hash){
            error_log("Login Success");
            header("Location: autos.php?email=".urlencode($_POST['email']));
            return;
        }else {
            $failure = "Incorrect Password";
            error_log("Login Fail");
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>38d08</title>
</head>
<body>
    <h1>Please Log In</h1>
    <?php
        if($failure !== false){
            echo ('<p style="color:red;">'. htmlentities($failure) ."</p>\n");
        }
    ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="email"  />
        <input type="password"  name="password"  />
        <input type="submit"  class="btn btn-primary" value="Log In">
        <!-- <a href="index.php" class="btn btn-primary">Input</a> -->
        <input type="submit"  class="btn btn-primary" name="cancel" value="cancel" />
    </form>
</body>

</html>
