<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Book Info</title>
</head>
<body>
<?php

    //get the information sent by href using GET
    $bookData = $_GET["infoKey"];
    
    //use PHP funtion explode() to separate individual values in $bookData
    //explode() as with javaScript split() as results in an array

    $bookdataArray = explode(";",$bookData);

    //extracting the infividual values
    
    $Style = $bookdataArray[0];
    $Author = $bookdataArray[1];
    $Title = $bookdataArray[2];
    $authImg = $bookdataArray[3];
    $bkImg = $bookdataArray[4];
    $authBio = $bookdataArray[5];
    $isbn = $bookdataArray[6];
    $pubco = $bookdataArray[7];

    $subtitle = "Winner, Nacional Book Awards 2020 for";
    print"<table border = '1'>";
    print"<tr><td colspan='2'>".$Title."<br/>".$subtitle." ".$Style."</td></tr>";
    print"<tr><td style='text-align: center;'><img src='".$bkImg."' width='200px' height='300px' /></td>
    <td width='200px'><img src='".$authImg."'/><br/>".$authBio."</td></tr>";

    print"</table>";

?>
</body>
</html>
