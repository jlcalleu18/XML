<?php
//getting input search
$searchText = $_GET["searchKey"];
print"User's search: ".$searchText;
    //connect to database: natbkawards_db
    //set up 4 parameters
    $server = "localhost";
    $user = "root";
    $password = "root";
    $database = "stock_db";

    //for later use(fro gph - good programing habit)
    $databaseTable = "stock_table";

    //make a connection to the tdatabase - use php funtion: mysqli_connect()
    $mycon = mysqli_connect($server, $user, $password, $database) or die("no connection established");
    //print"connected";

    //create a string variable that holds the SQL command
    $SQLselect = "SELECT * FROM " . $databaseTable." WHERE MATCH(exchange,symbol,name,lastSale,marketCap,ADRTSO,IPOyear,sector,industry,summaryQuote) "."AGAINST ('".$searchText."' IN NATURAL LANGUAGE MODE)";
    
    //$SQLselect = "select authorImage from " . $databaseTable;
    


    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die(" query did not run");
    

    //is there any records 
    $numrecs = mysqli_num_rows($results);
    
    if ($numrecs > 0) {

        print "<table border = '1'>";
        
        print "<tr>";
            print"<th>exchange</th>";
            print"<th>symbol</th>";
            print"<th>name</th>";
            print"<th>lastSale</th>";
            print"<th>marketCap</th>";
            print"<th>ADRTSO</th>";
            print"<th>IPOyear</th>";
            print"<th>sector</th>";
            print"<th>industry</th>";
            print"<th>summaryQuote</th>";
        print "</tr>";
            while ($recordArray = mysqli_fetch_row($results)) {

                //extracting field's values
                $id = $recordArray[0];
                $exchange = $recordArray[1];
                $symbol = $recordArray[2];
                $name = $recordArray[3];
                $lastSale = $recordArray[4];
                $marketCap = $recordArray[5];
                $ADRTSO = $recordArray[6];
                $IPOyear = $recordArray[7];
                $sector = $recordArray[8];
                $industry = $recordArray[9];
                $summaryQuote = $recordArray[10];
                //string variable that holds all book's information
                // $collegesdata = $id.",".$collge.",".$address.",".$city.",".$state.",".$zipcode.",".$telephone.",".$website;

            print "<tr>";   
                print"<td>$exchange</td>";
                print"<td>$symbol</td>";
                print"<td>$name</td>";
                print"<td>$lastSale</td>";
                print"<td>$marketCap</td>";
                print"<td>$ADRTSO</td>";
                print"<td>$IPOyear</td>";
                print"<td>$sector</td>";
                print"<td>$industry</td>";
                print"<td><a href=".$summaryQuote.">$summaryQuote</a></td>";
            print "</tr>";
        }

        print "</table>";
    } else {
        print" No record(s) found";
    }
    // else print " No record(s) found";

?>
