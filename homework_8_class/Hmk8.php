
<?php
    //get passing variables: address and distance
    // $latIn = $_GET["latKey"];
    // $longIn = $_GET["longKey"];
    // $distanceIn = $_GET["distanceKey"];
    $latIn = $_POST['lati'];
    $longIn = $_POST['long'];
    $distanceIn = $_POST['inputDistance'];

   // $data = array($latIn, $longIn, $distanceIn);
    // $data = array("lat" => $latIn, "long" => $longIn, "dist" =>$distanceIn);
   // echo json_encode($data);

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
    //$SQLselect = "SELECT * FROM " . $databaseTable;

    $SQLselect = "SELECT *, ( 3959 * acos( cos( radians(".$latIn.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$longIn.") ) + sin( radians(".$latIn.") ) * sin(radians(latitude)) ) ) AS distance FROM collegesmap_table HAVING distance < ".$distanceIn;
    
    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die(" query did not run");
    // 40.695507 -73.987882

    //is there any records 
    $numrecs = mysqli_num_rows($results);

    if ($numrecs > 0) {

        //loop through the matching record(s)
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
            $distance = $recordArray[11];

            //$return_data = array($id, $colletype, $college, $website, $address, $city, $state, $zipcode, $latitude, $longitude, $phone, $distanceIn,);
            $passingInfo[] = $recordArray;
            
                
    }
    echo json_encode($passingInfo);
    }else {
        print "No record(s) found";
    }

?>    