<?php

require 'dbh.inc.php';

function deleteAllPlayers(){
    //confirm('Are you sure you want to delete all of Players? This is not reversable.')
    global $conn;
        
        $sql = "DELETE FROM Players";
        if ($conn->query($sql) === TRUE) {
            //echo "Deleted all rows in Players";
            header("Location: ../delete.php?delete_players");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }	
    }
function deleteAllPlays(){
    //confirm('Are you sure you want to delete all of Players? This is not reversable.')
    global $conn;
        $sql = "DELETE FROM Play";
        if ($conn ->query($sql) === TRUE) {
            //echo "Deleted all rows in Play";
            header("Location: ../delete.php?delete_play");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }	
    }
function deleteAllGames(){
    //confirm('Are you sure you want to delete all of Players? This is not reversable.')
    global $conn;
        $sql = "DELETE FROM Games";
        if ($conn -> query($sql) === TRUE) {
            //echo "Deleted all rows in Games";
            header("Location: ../delete.php?delete_games");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
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

    mysqli_close($conn);