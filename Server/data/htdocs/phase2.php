<!DOCTYPE html>
<html>
<body>
	<?php
		//Global variables
		$conn;

		function databaseConnection(){
			#Database connection
			$servername = "dbclass.cs.nmsu.edu:3306";
			$username = "dbaldwin";
			$password = "44kx-7ww";
			$dbname = "cs482502fa18_dbaldwin";
			//hostname: dbclass.cs.nmsu.edu
			//databasename :
			//dbclass.cs.nmsu.edu


			// Create connection
			$GLOBALS['conn'] = mysqli_connect($servername, $username, $password, $dbname);
	
			// Check connection
			if (!$GLOBALS['conn']) {	
				die("Connection failed: " . mysqli_connect_error());
			}


			echo ("Connected successfully");
			//mysqli_close($GLOBALS['conn']);
		}

		function fileUploaded(){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//echo basename($_FILES["fileToUpload"]["name"]);//TestFile.txt
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "txt") {
				echo "Sorry, only txt";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}

			//Read File
			$myfile = fopen($target_file, "r") or die("Unable to open file!");
			if ($myfile) {
				//Look at the text file name and check what table it should go include 'file' 
				$myFileName = basename($_FILES["fileToUpload"]["name"]);
				if($myFileName == "Players.txt" || $myFileName == "players.txt" || $myFileName == "player.txt" || $myFileName == "Player.txt"){
					$lineNum = 1;
					while (($line = fgets($myfile)) !== false) {
		
						//split line delimiter of commas
						$PlayersAttributes = explode(",", $line);
				
						//Case 1: Check if there are 7 elements in PlayersAttributes Array
						if(sizeof($PlayersAttributes) != 7){
							throw new Exception("\nError on line " . $lineNum . ' of text file ' . $myFileName . ". Please enter in all attributes of table\n");
						}

						//Attributes after split
						$name = $PlayersAttributes[0];
						$PlayerID = $PlayersAttributes[1];
						$team_name = $PlayersAttributes[2];
						$position = $PlayersAttributes[3];
						$touchdowns = $PlayersAttributes[4];
						$totalyards = $PlayersAttributes[5];
						$salary = $PlayersAttributes[6];

						//Insert Data
						$sql = "INSERT INTO Players values (" . "'" . $name . "'" . ","
															. $PlayerID . "," 
															. "'" . $team_name . "'" . "," 
															. "'" . $position . "'" . "," 
															. $touchdowns . "," 
															.  $totalyards . "," 
															.  $salary . ")";
						if ($GLOBALS['conn']->query($sql) === TRUE) {
							echo "<div>New record created successfully</div>";
						} else {
							echo "<div>Error: " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
							break;
						}

						//Increment line number
						$lineNum = $lineNum + 1;

					}
				}else if($myFileName == "Games.txt" || $myFileName == "games.txt" || $myFileName == "Game.txt" || $myFileName == "game.txt"){
					$lineNum = 1;
					while (($line = fgets($myfile)) !== false) {
		
						//split line delimiter of commas
						$GamesAttributes = explode(",", $line);
				
						//Case 1: Check if there are 7 elements in PlayersAttributes Array
						if(sizeof($GamesAttributes) != 6){
							throw new Exception("\nError on line " . $lineNum . ' of text file ' . $myFileName . ". Please enter in all attributes of table\n");
						}

						//Attributes after split
						$GameID = $GamesAttributes[0];
						$date = $GamesAttributes[1];
						$stadium = $GamesAttributes[2];
						$result = $GamesAttributes[3];
						$attendance = $GamesAttributes[4];
						$ticket_revenue = $GamesAttributes[5];

						//Insert Data
						$sql = "INSERT INTO Games values (" . $GameID . ","
															. "'" . $date . "'" . "," 
															. "'" . $stadium . "'" . "," 
															. "'" . $result . "'" . "," 
															. $attendance . "," 
															. $ticket_revenue . ")";

						if ($GLOBALS['conn']->query($sql) === TRUE) {
							echo "<div>New record created successfully</div>";
						} else {
							echo "<div>Error: " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
							break;
						}

						//Increment line number
						$lineNum = $lineNum + 1;

					}				
				}else if($myFileName == "Play.txt" || $myFileName == "play.txt"){
					$lineNum = 1;
					while (($line = fgets($myfile)) !== false) {
		
						//split line delimiter of commas
						$PlayAttributes = explode(",", $line);
				
						//Case 1: Check if there are 7 elements in PlayersAttributes Array
						if(sizeof($PlayAttributes) != 2){
							throw new Exception("\nError on line " . $lineNum . ' of text file ' . $myFileName . ". Please enter in all attributes of table\n");
						}

						//Attributes after split
						$PlayerID = $PlayAttributes[0];
						$GameID = $PlayAttributes[1];

						//Insert Data
						$sql = "INSERT INTO Play values (" . $PlayerID . ","
														    . $GameID . ")";

						if ($GLOBALS['conn']->query($sql) === TRUE) {
							echo "<div>New record created successfully</div>";
						} else {
							echo "<div>Error: " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
							break;
						}

						//Increment line number
						$lineNum = $lineNum + 1;
					}				
				}else{
					echo "<div> Can't find table </div>";
				}

				fclose($myfile);
			} else {
				// error opening the file.
				echo "Error Reading File.";
			} 
		
		}

		function deleteAllPlayers(){
		//confirm('Are you sure you want to delete all of Players? This is not reversable.')
			$sql = "DELETE FROM Players";
			if ($GLOBALS['conn']->query($sql) === TRUE) {
				echo "Deleted all rows in Players";
			} else {
				echo "Error deleting record: " . $conn->error;
			}	
		}

		function deleteAllPlays(){
		//confirm('Are you sure you want to delete all of Players? This is not reversable.')
			$sql = "DELETE FROM Play";
			if ($GLOBALS['conn']->query($sql) === TRUE) {
				echo "Deleted all rows in Play";
			} else {
				echo "Error deleting record: " . $conn->error;
			}	
		}

		function deleteAllGames(){
		//confirm('Are you sure you want to delete all of Players? This is not reversable.')
			$sql = "DELETE FROM Games";
			if ($GLOBALS['conn']->query($sql) === TRUE) {
				echo "Deleted all rows in Games";
			} else {
				echo "Error deleting record: " . $conn->error;
			}	
		}

		//Call init function
		databaseConnection();
	?>

	<!-- File upload-->
	<form action="" method="post" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload Image" name="submit">
	</form>
	<div style="padding-top:30px;">
		<form method="post">
			<input type="submit" name="deletePlayers" value="Delete All From Players" />
		</form>
	</div>
	<div style="padding-top:30px;">
		<form method="post">
			<input type="submit" name="deletePlay" value="Delete All From Play" />
		</form>
	</div>
	<div style="padding-top:30px;">
		<form method="post">
			<input type="submit" name="deleteGames" value="Delete All From Games" />
		</form>
	</div>

	<?php
		if(isset($_POST['submit'])){ // button name
			fileUploaded();
		}
		if(isset($_POST['deletePlayers'])){ // button name
			deleteAllPlayers();
		}
		if(isset($_POST['deletePlay'])){ // button name
			deleteAllPlays();
		}
		if(isset($_POST['deleteGames'])){ // button name
			deleteAllGames();
		}
	?>


</body>
</html>