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
    $firstrec = true;//display table
    $maximages = 5; //maxnumber of the image
    $imagenumber = 1; //to display table row
    $count = 1;
    if ($numrecs > 0) {
        if ($firstrec == true){
            print "<table border = '1'>";
            $firstrec = false;
        } 
            while ($recordArray = mysqli_fetch_row($results)) {
                if ($imagenumber == 1)  print "<tr>";
                
                //extracting field's values
                $bkStyle = $recordArray[0];
                $bkAuthor = $recordArray[1];
                $bkTitle = $recordArray[2];
                $authorImage = $recordArray[3];
                $bkImage = $recordArray[4];
                $authorBio = $recordArray[5];
                $ISBN = $recordArray[6];
                $pubCo = $recordArray[7];
                //string variable that holds all book's information
                $bookdata = $bkStyle.";".$bkAuthor.";".$bkTitle.";".$authorImage.";".$bkImage.";".$authorBio.";".$ISBN.";".$pubCo;

                $url = 'infoKey=' .urlencode($bookdata);
                
                if ($imagenumber <= 5) {
                        print"<td><a href='bookinfo.php?".htmlentities($url)."'><img src='".$bkImage."' width='100px'height='150px'/></a></td>";
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
