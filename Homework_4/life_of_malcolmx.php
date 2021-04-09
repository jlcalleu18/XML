<!DOCTYPE html>
<html lang="en">
<head>

</head>
<style>

</style>
<body>

<?php
    //connect to database: natbkawards_db
    //set up 4 parameters
    $server = "localhost";
    $user = "root";
    $password = "root";
    $database = "natbkawards_db";

    //for later use(fro gph - good programing habit)
    $databaseTable = "natbkawards_table";

    //make a connection to the tdatabase - use php funtion: mysqli_connect()
    $mycon = mysqli_connect($server, $user, $password, $database) or die("no connection established");
    //print"connected";

    //create a string variable that holds the SQL command
    $SQLselect = "select * from " . $databaseTable. " where bookImage='life_of_malcolmx.jpg'";

    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die("query did not run");
  
  $row = mysqli_fetch_array($results);
  
    print "<table width='70%' style='margin: 0 auto; padding:0 5%; border: 2px solid navy;background-color: lightslategrey'>";
    print "<tr>";
        print"<td colspan='2' ><h2 style='color: navy;font-style: italic;'>$row[2]</h2><p style='color: white;'>Winner, Nacional Book Awards 2020 for $row[0]</p></td>";
    print "</tr>";

    print "<tr>";
        print"<td><img src='".$row[4]."' width='350px'height='500px'/></td>";
        print"<td>";
            print "<table style='margin-left:20%; margin-top:-25%; padding:3%; border: 2px solid goldenrod;background-color: white'>";
                print "<tr>";
                    print"<td><img src='".$row[3]."' width='50px'height='60px'/></td>";
                    print"<td><h2>$row[1]</h2></td>";
                print"</tr>";
                print "<tr>";
                    print"<td colspan='2'>$row[5]</td>";
                print"</tr>";
            print "</table>";
        print"</td>";
    print "</tr>";

    print "<tr>";
        print"<td colspan='2' style='color: white;'>$row[6]</td>";
    print"</tr>";
    print "<tr>";
        print"<td colspan='2' style='color: white;'>$row[7]</td>";
    print"</tr>";
    print "</table>";

?>

</body>
</html>