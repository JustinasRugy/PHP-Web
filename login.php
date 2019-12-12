<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
require ('functions.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
        $query = "SELECT id, username, email, admin  FROM `users` WHERE username='$username'
and password='".md5($password)."' AND active ='1'";
 $result = mysqli_query($con,$query);
         print_r($query);

 $rows = mysqli_num_rows($result);
        if($rows==1){
            while($row = mysqli_fetch_assoc($result)) {
     $_SESSION['username'] = $row['username'];
     $_SESSION['email'] = $row['email'];
     $_SESSION['admin'] = $row['admin'];
     $_SESSION['valid'] = true;
     $_SESSION['id'] = $row['id'];
            break;}
     header("Location: meniu.php");
         }else{
 echo "<div class='form'>
<h3>Username/password is incorrect or your user not activated yet!</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
 }
    }else{
?>
<div class="form"  style="text-align: center;">
<h1>Log In</h1>
<form action="" method="post" name="login" class="px-4 py-3">
<div class="form-group">
<input type="text" name="username" placeholder="Username" required />
</div>
<div class="form-group">
<input type="password" name="password" placeholder="Password" required />
</div>
<div class="form-check">
<input class="btn btn-primary" name="submit" type="submit" value="Login" />
</div>
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
</div>
<?php } ?>
</body>
</html>