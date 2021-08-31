<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('db.php');
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
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: index.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
<div class="container">
	<div class="row col-md-6 col-md-offset-3" style="margin-top: 150px; padding-bottom: 10px;">
		<div class="panel panel-primary">
			<div class="panel-heading text center"  >
				<h1>Se connceter</h1>
			</div>
			<div class="panel panel-body" >
				
<form action="" method="post" name="login" >
	<div class="form-group">
		<label>Prénom</label>
<input type="text"  class="form-control" name="username" placeholder="Username" required />
<label>Mot De passe</label>
<input type="password" class="form-control"  name="password" placeholder="Password" required /><br>
<input name="submit" class="btn btn-primary" type="submit" value="Login" />
</form>
		</div>
		</div>
		<div class="panel-footer"> <p>Pas encore inscrit ? <a href='registration.php'>S'incrire ici</a></p> </div>
	</div>
</div>
</div>


<?php } ?>
</body>
</html>