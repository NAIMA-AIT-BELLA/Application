<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css"></head>
<body>
<?php 
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="container">
	<div class="row col-md-6 col-md-offset-3" style="margin-top: 100px; padding-bottom: 10px;">
		<div class="panel panel-primary">
			<div class="panel-heading text center"  >
				<h1>S'inscrire</h1>
			</div>
			<div class="panel panel-body" >
<form action="" method="post" name="login" >
	<div class="form-group">

<label>Nom</label>
<form name="registration" action="" method="post"  class="form-control">
<input type="text" name="username" placeholder="Username" required  class="form-control" />
<label>Email</label>
<input type="email" name="email" placeholder="Email" required  class="form-control" />
<label>Mot De passe</label>
<input type="password" name="password" placeholder="Password" required  class="form-control" /><br>
<input type="submit" name="submit" value="Register" class="btn btn-primary" />
</form>
</div>
<?php } ?>
 
</body>
</html>