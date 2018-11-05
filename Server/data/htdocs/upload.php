<?php
 include "includes/upload.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Upload</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles/upload.css">

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
                        //alert("hiddenInputValue: " + hiddenInputValue + "\nSingleButtonValue: " + SingleButtonValue + "\nBulkButtonValue: " + BulkButtonValue);
                    }else if(hiddenInputValue == "BulkButton"){
                        $("#SingleButtonValue").attr("value", 0);
                        $("#BulkButtonValue").attr("value", 1);
                        var SingleButtonValue = $("#SingleButtonValue").attr("value");
                        var BulkButtonValue = $("#BulkButtonValue").attr("value");
                        //alert("hiddenInputValue: " + hiddenInputValue + "\nSingleButtonValue: " + SingleButtonValue + "\nBulkButtonValue: " + BulkButtonValue);
                    };
                });
            });
        </script>
    
       
        <h1 class="text-center">Upload</h1>
            <?php
                
                 if(isset($_GET['upload_success1'])){
                    echo '<div>New record created successfully, Overalltime:'. $overall_time. '</div>';
                }
                else if(isset($_GET['upload_success2'])){
                    echo '<div>New record created successfully, Overalltime:'. $overall_time. '</div>';
                }
                else if(isset($_GET['upload_success3'])){
                    echo '<div>New record created successfully, Overalltime:'. $overall_time. '</div>';
                }  
                else if(isset($_GET['buckload_success1'])){
                    echo '<div>New record created successfully, Overalltime:'. $overall_time. '</div>';
                }  
                else if(isset($_GET['buckload_success2'])){
                    echo '<div>New record created successfully, Overalltime:'. $overall_time. '</div>';
                }  
                else if(isset($_GET['buckload_success3'])){
                    echo '<div>New record created successfully, Overalltime:'. $overall_time. '</div>';
                }  
            ?>
            <form class="container" action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
                <div class="btn-group">
                        <button type="button" id="BulkButton" name="BulkButton" class="btn btn-primary" value="0">Bulk Loading</button>
                        <button type="button" id="SingleButton" name="SingleButton" class="btn btn-primary" value="1">Single Insertion</button>
                        
                </div>
                <input type="hidden" id="SingleButtonValue" name="SingleButtonValue" value="1" />
                    <input type="hidden" id="BulkButtonValue" name="BulkButtonValue" value="0" />
                
                    <p style="margin:0 auto;color: white;">Select image to upload:</p>
                    <input style="padding:10px;color: white;" type="file" name="fileToUpload" id="fileToUpload">
                    <input  type="submit" id="submit" value="Upload Image" name="submit">
            </form>
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




