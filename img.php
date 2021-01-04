<?php 
	require_once "classes/init.php";

	if (isset($_POST["submit"]) ) {
    $image = $_FILES['image'];

    // echo($image);
    echo $image['name'];
	}









 ?>

<!-- 
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	
 		<form action="" method="post" enctype="multipart/form-data">
 			<label>
 				upload a file
 			</label><br><br>
 			<input type="file" name="img"><br><br>
 			<input type="submit" name="submit">
 		</form>
 </body>
 </html> -->