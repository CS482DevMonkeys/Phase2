<!DOCTYPE html>
<html>
<body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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


			echo ("<div style='padding:20px;'>Connected successfully</div>");
			//mysqli_close($GLOBALS['conn']);
		}

		//Call init function
		databaseConnection();

		function singleFileUpload(){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//echo basename($_FILES["fileToUpload"]["name"]);//TestFile.txt
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
							//echo "<div>New record created successfully</div>";
						} else {
							echo "<div>Error on line "  . $lineNum . ": " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
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
							echo "<div>Error on line "  . $lineNum . ": " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
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
							echo "<div>Error on line "  . $lineNum . ": " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
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

		function bulkFileUpload(){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//echo basename($_FILES["fileToUpload"]["name"]);//TestFile.txt
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
				echo "Here";
				//Look at the text file name and check what table it should go include 'file' 
				$myFileName = basename($_FILES["fileToUpload"]["name"]);
				if($myFileName == "Players.txt" || $myFileName == "players.txt" || $myFileName == "player.txt" || $myFileName == "Player.txt"){
					$lineNum = 1;
					$sql = "INSERT INTO Players (name, PlayerID, team_name, position, touchdowns, totalyards, salary) VALUES ";
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
						$sql = $sql . "('" . $name . "'" . ","
															. $PlayerID . "," 
															. "'" . $team_name . "'" . "," 
															. "'" . $position . "'" . "," 
															. $touchdowns . "," 
															.  $totalyards . "," 
															.  $salary . "),";


						//Increment line number
						$lineNum = $lineNum + 1;

					}
					$sql = substr_replace($sql, ";", (strlen($sql) - 1));
					//echo ($sql);
					if ($GLOBALS['conn']->query($sql) === TRUE) {
						//echo "<div>New record created successfully</div>";
					} else {
						echo "<div>Error: " . "<br>" . $GLOBALS['conn']->error . "</div>";
					}
				}else if($myFileName == "Games.txt" || $myFileName == "games.txt" || $myFileName == "Game.txt" || $myFileName == "game.txt"){
					$lineNum = 1;
					$sql = "INSERT INTO Games (GameID, date, stadium, result, attendance, ticket_revenue) VALUES ";
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
						$sql = $sql . "(" . $GameID . ","
															. "'" . $date . "'" . "," 
															. "'" . $stadium . "'" . "," 
															. "'" . $result . "'" . "," 
															. $attendance . "," 
															. $ticket_revenue . "),";

						//Increment line number
						$lineNum = $lineNum + 1;

					}
					$sql = substr_replace($sql, ";", (strlen($sql) - 1));
					//echo ($sql);
					if ($GLOBALS['conn']->query($sql) === TRUE) {
						echo "<div>New record created successfully</div>";
					} else {
						echo "<div>Error: " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
					}
				}else if($myFileName == "Play.txt" || $myFileName == "play.txt"){
					$lineNum = 1;
					$sql = "INSERT INTO Play (PlayerID, GameID) VALUES ";
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
						$sql = $sql . "(" . $PlayerID . ","
										  . $GameID . "),";



						//Increment line number
						$lineNum = $lineNum + 1;
					}
					$sql = substr_replace($sql, ";", (strlen($sql) - 1));
					if ($GLOBALS['conn']->query($sql) === TRUE) {
						echo "<div>New record created successfully</div>";
					} else {
						echo "<div>Error: " . $sql . "<br>" . $GLOBALS['conn']->error . "</div>";
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

		if(isset($_POST['submit'])){ // button name
			echo("Entered POST function: submit");
			var_dump($_POST);

			if(isset($_POST["BulkButtonValue"]) && $_POST["BulkButtonValue"] == 1){
				
				//Then Call method to do bulk insertion
				echo "<div style='padding:50px;'>" . $_POST["BulkButtonValue"] . "</div>";
				bulkFileUpload();
			}else if(isset($_POST["SingleButtonValue"]) && $_POST["SingleButtonValue"] == 1){
				
				//Then Call method to do bulk insertion
				echo "<div style='padding:50px;'>" . $_POST["SingleButtonValue"] . "</div>";
				singleFileUpload();
			}
			
			echo("Finished POST function: submit");
		}

		function executeSqlQuery($sql){
			echo("Entered executeSqlQuery function");
			echo($sql);
			//$result = $GLOBALS['conn']->query($sql);
			if ($result = mysqli_query($GLOBALS['conn'], $sql)) {
				echo("IN");
				/* fetch associative array */
				$rows = array();
				while ($row = mysqli_fetch_array($result)) {
					$sizeOfRowArray = count($row)/ 2;
					echo("<div></div>");
					for($i = 0; $i < $sizeOfRowArray; $i++){
						echo ("<span style='padding:20px; display:'inline-block'>" . $row[$i] . "</span>");
					}
				}
				/* free result set */
				mysqli_free_result($result);
			}else{
				echo("<div style='padding:50px;'>Error: " . mysqli_error($GLOBALS['conn']) . "</div>");
			}
			echo("Exit executeSqlQuery function");
		}

		//sqlQueryTextFieldSubmit
		if(isset($_POST['sqlQueryTextFieldSubmit'])){ // button name
			if(isset($_POST["sqlQueryTextField"])){
				$query = $_POST["sqlQueryTextField"];
				executeSqlQuery($query);
			}
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

		mysqli_close($GLOBALS['conn']);
	?>

	<script>
	$(document).ready(function(){
		$(".btn-group > .btn").click(function(){
			$("#SingleButton").val();
			$(".btn-group > .btn").removeClass("active");
			$(this).addClass("active");
			$(".btn-group > .btn").attr("value", 0);
			$(this).attr("value", 1);

			var hiddenInputValue = $(this).attr("id");
			if(hiddenInputValue == "SingleButton"){
				$("#SingleButtonValue").attr("value", 1);
				$("#BulkButtonValue").attr("value", 0);
				var SingleButtonValue = $("#SingleButtonValue").attr("value");
				var BulkButtonValue = $("#BulkButtonValue").attr("value");
				alert("hiddenInputValue: " + hiddenInputValue + "\nSingleButtonValue: " + SingleButtonValue + "\nBulkButtonValue: " + BulkButtonValue);
			}else if(hiddenInputValue == "BulkButton"){
				$("#SingleButtonValue").attr("value", 0);
				$("#BulkButtonValue").attr("value", 1);
				var SingleButtonValue = $("#SingleButtonValue").attr("value");
				var BulkButtonValue = $("#BulkButtonValue").attr("value");
				alert("hiddenInputValue: " + hiddenInputValue + "\nSingleButtonValue: " + SingleButtonValue + "\nBulkButtonValue: " + BulkButtonValue);
			};
		});
	});
	</script>

	<!-- File upload-->
	<div id="outerContainer">
	<form action="phase2.php" method="post" enctype="multipart/form-data">
			<div class="btn-group" style="padding:20px;">
				<button type="button" id="BulkButton" name="BulkButton" class="btn btn-primary active" value="0">Bulk Loading</button>
				<button type="button" id="SingleButton" name="SingleButton" class="btn btn-primary" value="1">Single Insertion</button>
				
			</div>
			<input type="hidden" id="SingleButtonValue" name="SingleButtonValue" value="1" />
			<input type="hidden" id="BulkButtonValue" name="BulkButtonValue" value="0" />
		
			Select image to upload:
			<input style="padding:10px;" type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" id="submit" value="Upload Image" name="submit">

			<div style="padding:20px;">
				<form method="post">
					<input type="submit" name="deletePlayers" value="Delete All From Players" />
				</form>
			</div>

			<div style="padding:20px;">
				<form method="post">
					<input type="submit" name="deletePlay" value="Delete All From Play" />
				</form>
			</div>
			
			<div style="padding:20px;">
				<form method="post">
					<input type="submit" name="deleteGames" value="Delete All From Games" />
				</form>
			</div>

			<div style="padding:20px;">
				<form method="post">
					<input type="text" name="sqlQueryTextField" value="" />
					<input type="submit" value="Submit Query" name="sqlQueryTextFieldSubmit">
				</form>
			</div>

		</form>
	</div>
</body>
</html>