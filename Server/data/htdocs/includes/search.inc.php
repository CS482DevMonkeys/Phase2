<?php

require 'dbh.inc.php';

function executeSqlQuery($sql){
    global $conn;
    echo("Entered executeSqlQuery function");
    echo($sql);
    //$result = $GLOBALS['conn']->query($sql);
    if ($result = mysqli_query($conn , $sql)) {
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

mysqli_close($conn);