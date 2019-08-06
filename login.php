<!DOCTYPE html>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Account.css">
</head>

<h2>NTUT</h2>

<body>

<form action="actionlogin.php" method="POST">
  <div class="imgcontainer">
    <img src="NTUT_Logo_2013.svg.png" alt="Avatar" class="avatar">
  </div>
  <div class="container">
    <label for="uname"><b>Username(email_format)</b></label>
    <input type="text" placeholder="Enter Username" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
	<?php  
	 if (isset($_GET['refer'])){
		echo "<font color='red'>";
		echo "帳號或密碼有誤!!</font>";
	 }
	?>
	<button type="submit" name="submit" value="Login">LOG IN</button>
	<input type="hidden" name="refer" value="<?php echo (isset($_GET['refer'])) ? $_GET['refer'] : 'index.php'; ?>">
	<a href="SignUp.php"><button type="button">SIGN UP</button></a>
	</div>
 <div class="container" style="background-color:#f1f1f1">
   <span class="psw">Forgot <a href="#">password?</a></span>
 </div>
</form>
</body>
</html>