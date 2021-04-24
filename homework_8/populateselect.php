<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<?php
    //connect to database: collegesmap_db
    //set up 4 parameters
    $server = "localhost";
    $user = "root";
    $password = "root";
    $database = "collegesmap_db";

    //for later use(fro gph - good programing habit)
    $databaseTable = "collegesmap_table";

    //make a connection to the tdatabase - use php funtion: mysqli_connect()
    $mycon = mysqli_connect($server, $user, $password, $database) or die("no connection established");
    //print"connected";

    //create a string variable that holds the SQL command
    $SQLselect = "SELECT * FROM " . $databaseTable;
    
    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die(" query did not run");
    

    //is there any records 
    $numrecs = mysqli_num_rows($results);

    
    if ($numrecs > 0) {


        //loop through the matching record(s)
        $passingInfo = array();
        while ($recordArray = mysqli_fetch_row($results)) {

            //extracting field's values
            $id = $recordArray[0];
            $colletype = $recordArray[1];
            $college = $recordArray[2];
            $website = $recordArray[3];
            $address = $recordArray[4];
            $city = $recordArray[5];
            $state = $recordArray[6];
            $zipcode = $recordArray[7];
            $latitude = $recordArray[8];
            $longitude = $recordArray[9];
            $phone = $recordArray[10];


            $passingInfo[] = $recordArray;

            
    }

    }else {
        print "No record(s) found";
    }


?>   
<script type="text/javascript">

var obj = JSON.parse('<?php echo json_encode($passingInfo) ?>');


</script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
