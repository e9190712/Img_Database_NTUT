<?php
require('config.php');
// Authenticate user
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("MySQL不能連接!");
?>

<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Account.css">
</head>
<body>

<h2>NTUT</h2>

<form method="POST" action="SignUp.php">
  <div class="container">
    <label for="uname"><b>Username(email_format)</b></label>
    <input type="text" placeholder="Enter Username" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
	
	<?php
	  if (isset($_POST['upload'])) {
		$email = $_POST['email'];
		$res = mysqli_query($db,"SELECT * FROM susers WHERE email='$email'");
		if(mysqli_num_rows($res)){
			echo "<font color='red'>";
			echo "此帳號已有人註冊!! </font>";
		}
		else{		
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "INSERT INTO susers (email, password) VALUES ('$email', password('$password'))";

		mysqli_query($db, $sql);
		echo "<font color='green'>";
		echo "註冊成功!! </font>";
		}
	  }
	?>

    <button type="submit" name="upload">SUBMIT</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <a href="login.php"><button type="button" class="cancelbtn">< Previous</button></a>
  </div>
</form>

</body>
</html>