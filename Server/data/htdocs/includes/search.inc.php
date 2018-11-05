<?php

require 'dbh.inc.php';

function executeSqlQuery($sql){
    global $conn;
	$Overall_time;
    //echo("Entered executeSqlQuery function");
    echo("<div style='padding:20px;'>" . $sql . "</div>");
    //$result = $GLOBALS['conn']->query($sql);
    if ($result = mysqli_query($conn , $sql)) {
        /* fetch associative array */
        $rows = array();
		$time_start = microtime(true);
        while ($row = mysqli_fetch_array($result)) {
            $sizeOfRowArray = count($row)/ 2;
            echo("<div></div>");
            for($i = 0; $i < $sizeOfRowArray; $i++){
                echo ("<span style='padding:20px; display:inline-block; width:50px'>" . $row[$i] . "</span>");
            }
        }
		$time_end = microtime(true);
        $Overall_time = ($time_end - $time_start);
        echo("<div style='padding:20px;'>Execution Time: " . $Overall_time . "</div>");
        mysqli_free_result($result);
    }else{
		echo("<div style='padding:20px;'>Error: " . mysqli_error($GLOBALS['conn']) . "</div>");
	}
    //echo("Exit executeSqlQuery function");
}
//sqlQueryTextFieldSubmit
if(isset($_POST['sqlQueryTextFieldSubmit'])){ // button name
    if(isset($_POST["sqlQueryTextField"])){
        $query = $_POST["sqlQueryTextField"];
        executeSqlQuery($query);
    }
}

mysqli_close($conn);