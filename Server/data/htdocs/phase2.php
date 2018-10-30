
<!DOCTYPE html>
<html>
<body>
	<?php
		$servername = "dbclass.cs.nmsu.edu:3306";
		$username = "dbaldwin";
		$password = "44kx-7ww";
		$dbname = "cs482502fa18_dbaldwin";
		//hostname: dbclass.cs.nmsu.edu
		//databasename :
		//dbclass.cs.nmsu.edu


		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
	
		// Check connection
		if (!$conn) {	
			die("Connection failed: " . mysqli_connect_error());
		}


		echo ("Connected successfully");
		mysqli_close($conn);
	?>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload Image" name="submit">
	</form>
</body>
</html>