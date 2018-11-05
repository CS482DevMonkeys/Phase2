
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Delete</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles/delete.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
            require "header.php";
        ?>
        <div class="container"> 
            <h1 class="header"><a class="title" href="delete.php">Delete</a></h1>
            <?php
                
                if(isset($_GET['delete_players'])){
                    echo '<div class = "response"> <h2>Deleted all row in Players!</h2></div>';
                    
                }
                else if(isset($_GET['delete_play'])){
                    echo '<div class = "response"> <h2>Deleted all rows in Plays!</h2></div>';
                }
                else if(isset($_GET['delete_games'])){
                    echo '<div class = "response"> <h2>Deleted all rows in Games!</h2></div>';
                }  
            ?>
            <!-- <form action="includes/delete.inc.php" method="post" enctype="multipart/form-data"> -->
                <div style="padding:20px;">
                        <form action="includes/delete.inc.php" method="post">
                            <input type="submit" name="deletePlayers" value="Delete All From Players" />
                        </form>
                </div>

                <div style="padding:20px;">
                    <form action="includes/delete.inc.php" method="post">
                        <input type="submit" name="deletePlay" value="Delete All From Play" />
                    </form>
                </div>
                
                <div style="padding:20px;">
                    <form action="includes/delete.inc.php" method="post">
                        <input type="submit" name="deleteGames" value="Delete All From Games" />
                    </form>
                </div>
            <!-- </form> -->
        </div>
        <?php
            require "footer.php";
        ?>        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>




