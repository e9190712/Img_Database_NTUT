<?php
  include('incsession.php');
  require('config.php');
  // Authenticate user
  $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("MySQL不能連接!");
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
	
	if ($image!=''){
	// Get text
  	$text = mysqli_real_escape_string($db, $_POST['text']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (image, text) VALUES ('$image', '$text')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		echo "Image uploaded successfully";
  	}else{
  		echo "Failed to upload image";
  	}
	}
   }
  if (isset($_POST['CLEAR'])) {
	  mysqli_query($db,"DELETE FROM images");
	  mysqli_query($db, "TRUNCATE TABLE images");#id_ini
      $file_path = glob('./images/*');
	  foreach($file_path as $val){unlink($val);}
  }
  
  if (isset($_POST['DEL'])) {
	  $select_row = mysqli_query($db,"SELECT * FROM images WHERE id=".$_POST['DEL']);
	  //tell you error
	  	if(!$select_row){
		echo ("Error: ".mysqli_error($db));
		exit();
	   }
	   //
      $row = mysqli_fetch_array($select_row);
	  if (preg_match("/\.dcm/i",$row['image'])){
		  $str_name = explode('.', $row['image']);
		  $file_path = glob("images/".$str_name[0].".*");
		  foreach($file_path as $val){unlink($val);}
	  }
	  else{
		  unlink("images/".$row['image']);
	  }
	  mysqli_query($db,"DELETE FROM images WHERE id=".$_POST['DEL']);
  }
  if (isset($_POST['Extractor'])) {
	  $path="python Extractor.py ";
	  $data = exec($path.$_POST['Extractor']);
	  echo "$data";
	  #setcookie('my_data',$data);
	  #header("Location: http://localhost/xampp/Frame_img.php");
	  #exit;
  }
  $result = mysqli_query($db, "SELECT * FROM images");
?>

<!DOCTYPE html>

<html>
<head>
    <title>Image Upload</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Add jQuery library -->
	<script type="text/javascript" src="source/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="source/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="content">
  <form method="POST" action="index.php" enctype="multipart/form-data">
  <?php
    while ($row = mysqli_fetch_array($result)) {
	    if (preg_match("/\.dcm/i",$row['image'])){
			$params = "images/".$row['image']; #傳遞給python指令碼的入口引數 
			$path="python index.py "; //需要注意的是：末尾要加一個空格
			$jsondata= exec($path.$params);
		}
	  echo "<div id='img_div'>";
	  echo '<script type="text/javascript">		$(document).ready(function() {
			$(".fancybox-thumbs").fancybox({
				prevEffect : "none",
				nextEffect : "none",

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});


		});';
	  echo '</script>';
	  echo "<button name='DEL' value='".$row['id']."' type='submit'>";//id是否有上限???
	  echo "DELETE</button>";
	    if (preg_match("/\.dcm/i",$row['image'])){
			echo "<a class='fancybox-thumbs' data-fancybox-group='thumb' href='".$jsondata."' >";
			echo "<img src='".$jsondata."' >";
			echo "</a>";
			echo "<button name='Extractor' value='".$jsondata."' type='submit'>";//id是否有上限???
		    echo "Extractor</button>";
		}
		else{echo "<a class='fancybox-thumbs' data-fancybox-group='thumb' href='images/".$row['image']."' >";echo "<img src='images/".$row['image']."' >";echo "</a>";}
		echo "<p>".$row['text']."</p>";
      echo "</div>";
    }
  ?>
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image" accept="image/png, image/jpeg, .dcm, image/gif">
  	</div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="text" 
      	placeholder="Say something about this image..."></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload">POST</button>
		<button type="reset" value="Reset">RESET</button>
		<button name="CLEAR">CLEAR</button>
  	</div>
	<div class="container" style="background-color:#f1f1f1">
    <a href="login.php"><button type="button" class="cancelbtn">LOG OUT</button></a>
	<?php
	$image = isset($image) ? $image : null;//多點幾次POST不會有反應
	if ($image==''){

	}
	?>
    </div>
  </form>
</div>
</body>
</html>