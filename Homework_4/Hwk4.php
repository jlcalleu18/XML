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
    $SQLselect = "select * from " . $databaseTable;
    //$SQLselect = "select authorImage from " . $databaseTable;
    


    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die("query did not run");
    

    //is there any records 
    $numrecs = mysqli_num_rows($results);
    $firstrec = true;
    $maximages = 5;
    $imagenumber = 1;
    $count = 1;
    if ($numrecs > 0) {
        if ($firstrec == true){
            print "<table border = '1'>";
            $firstrec = false;
        } 
            while ($recordArray = mysqli_fetch_array($results)) {
                if ($imagenumber == 1)  print "<tr>";
                
                //extracting field's values
                $bkimageDB = $recordArray[4];
                // print"$recordArray[3]";
                if ($imagenumber <= 5) {
                    if ($count==1) {
                        print"<td><a href='interior_chinatown.php'><img src='".$bkimageDB."' width='100px'height='150px'/></a></td>";
                    $count++;
                    }elseif ($count==2) {
                        print"<td><a href='tokyo_ueno_station.php'><img src='".$bkimageDB."' width='100px'height='150px'/></a></td>";
                    $count++;
                    }elseif ($count==3) {
                        print"<td><a href='king_and_the_dragonflies.php'><img src='".$bkimageDB."' width='100px'height='150px'/></a></td>";
                    $count++;
                    }elseif ($count==4) {
                        print"<td><a href='life_of_malcolmx.php'><img src='".$bkimageDB."' width='100px'height='150px'/></a></td>";
                    $count++;
                    }elseif ($count==5) {
                        print"<td><a href='dmz_colony.php'><img src='".$bkimageDB."' width='100px'height='150px'/></a></td>";
                    $count++;
                    }
                    
                    $imagenumber++;

                    if ($imagenumber > 5) {
                        $imagenumber = 1;
                        print"</tr>";
                        
                    }
                }else {
                    print "</tr>";
                    $imagenumber = 1;
                    
                }
        } 
        print "</table>";
    }
    else print "No record(s) found";


?>
