<?php



    require 'dbh.inc.php';
    $overall_time;

    function singleFileUpload(){
        global $conn;
        global $overall_time;
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
                $time_start = microtime(true);
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
                    if ($conn ->query($sql) === TRUE) {
                        //echo "<div>New record created successfully</div>";
                        header("Location: ../index.php?upload_success1");
                    } else {
                        echo "<div>Error on line "  . $lineNum . ": " . $sql . "<br>" . $conn ->error . "</div>";
                        break;
                    }
                    //Increment line number
                    $lineNum = $lineNum + 1;
                }
                $time_end = microtime(true);
                $Overall_time = ($time_end - $time_start);
            }else if($myFileName == "Games.txt" || $myFileName == "games.txt" || $myFileName == "Game.txt" || $myFileName == "game.txt"){
                $lineNum = 1;
                $time_start = microtime(true);
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
                    if ($conn ->query($sql) === TRUE) {
                        //echo "<div>New record created successfully</div>";
                        header("Location: ../index.php?upload_success2");
                    } else {
                        echo "<div>Error on line "  . $lineNum . ": " . $sql . "<br>" . $conn ->error . "</div>";
                        break;
                    }
                    //Increment line number
                    $lineNum = $lineNum + 1;
                }
                $time_end = microtime(true);
                $overall_time = ($time_end - $time_start);				
            }else if($myFileName == "Play.txt" || $myFileName == "play.txt"){
                $lineNum = 1;
                $time_start = microtime(true);
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
                    if ($conn ->query($sql) === TRUE) {
                        //echo "<div>New record created successfully</div>";
                        header("Location: ../index.php?upload_success3");
                        
                    } else {
                        echo "<div>Error on line "  . $lineNum . ": " . $sql . "<br>" . $conn ->error . "</div>";
                        break;
                    }
                    //Increment line number
                    $lineNum = $lineNum + 1;
                }				
                $time_end = microtime(true);
                $overall_time = ($time_end - $time_start);
            }else{
                echo "<div> Can't find table </div>";
            }
            fclose($myfile);
            exit();
        } else {
            // error opening the file.
            echo "Error Reading File.";
        } 
    
    }

    function bulkFileUpload(){
        global $conn;
        global $overall_time;
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
                $sql = "INSERT INTO Players (name, PlayerID, team_name, position, touchdowns, totalyards, salary) VALUES ";
                $time_start = microtime(true);
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
                $time_end = microtime(true);
                $overall_time = ($time_end - $time_start);

                $sql = substr_replace($sql, ";", (strlen($sql) - 1));
                //echo ($sql);
                if ($conn ->query($sql) === TRUE) {
                   // echo "<div>New record created successfully</div>";
                    header("Location: ../index.php?buckload_success1");
                } else {
                    echo "<div>Error: " . $sql . "<br>" . $conn ->error . "</div>";
                }
            }else if($myFileName == "Games.txt" || $myFileName == "games.txt" || $myFileName == "Game.txt" || $myFileName == "game.txt"){
                $lineNum = 1;
                $sql = "INSERT INTO Games (GameID, date, stadium, result, attendance, ticket_revenue) VALUES ";
                $time_start = microtime(true);
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
                $time_end;
                $overall_time = ($time_end - $time_start);

                $sql = substr_replace($sql, ";", (strlen($sql) - 1));
                //echo ($sql);
                if ($conn ->query($sql) === TRUE) {
                    header("Location: ../index.php?buckload_success2");
                    //echo "<div>New record created successfully</div>";
                } else {
                    echo "<div>Error: " . $sql . "<br>" . $conn ->error . "</div>";
                }
            }else if($myFileName == "Play.txt" || $myFileName == "play.txt"){
                $lineNum = 1;
                $sql = "INSERT INTO Play (PlayerID, GameID) VALUES ";
                
                $time_start = microtime(true);
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
                $time_end = microtime(true);
                $overall_time = ($time_end - $time_start);

                $sql = substr_replace($sql, ";", (strlen($sql) - 1));
                if ($conn ->query($sql) === TRUE) {
                    header("Location: ../index.php?buckload_success3");
                    //echo "<div>New record created successfully</div>";
                } else {
                    echo "<div>Error: " . $sql . "<br>" . $conn ->error . "</div>";
                }				
            }else{
                echo "<div> Can't find table </div>";
            }
            fclose($myfile);
        } else {
            // error opening the file.
            echo "Error Reading File.";
        } 
        exit();
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

    mysqli_close($conn);