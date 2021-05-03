<?php
//getting input search
$searchText = $_GET["searchKey"];
print"User's search: ".$searchText;
print " ";
    //connect to database: stock_db
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

    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die(" query did not run");
    

    //is there any records 
    $numrecs = mysqli_num_rows($results);
    
    if ($numrecs > 0) {


        print "<select id='companyList' onchange= 'getprice()'>";
        print "<option value=''>Select a Company</option>";

            while ($recordArray = mysqli_fetch_row($results)) {

                //extracting field's values
                $id = $recordArray[0];
                $exchange = $recordArray[1];
                $symbol = $recordArray[2];
                $companyName = $recordArray[3];
                $lastSale = $recordArray[4];
                $marketCap = $recordArray[5];
                $ADRTSO = $recordArray[6];
                $IPOyear = $recordArray[7];
                $sector = $recordArray[8];
                $industry = $recordArray[9];
                $summaryQuote = $recordArray[10];

                //send the values as a option
                
                print "<option value='".$symbol."'>".$companyName."</option>";
            
        }

        print "</select>";
    } else {
        print" No record(s) found";
    }
    // else print " No record(s) found";

?>
