
<?php
    //get passing variables: address and distance
    $latIn = $_GET["latKey"];
    $longIn = $_GET["longKey"];
    $distanceIn = $_GET["distanceKey"];


    //print "latitude: ".$latIn." longitude: ".$longIn." Distance: ".$distanceIn;

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

    $SQLselect = "select *, (3959 * acos(sin(radians(" . $latIn . ")) * sin(radians(latitude)) + "."cos(radians(" . $latIn . ")) * cos(radians(latitude)) * cos(radians(longitude) - "."radians(" . $longIn . ")))) as distance from " . $databaseTable." having distance < ".$distanceIn;
    
    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die(" query did not run");
    // 40.695507 -73.987882

    //is there any records 
    $numrecs = mysqli_num_rows($results);
    $allmatchingcolleges = "";
    $index = 0;
    if ($numrecs > 0) {

        //loop through the matching record(s)
        while ($recordArray = mysqli_fetch_row($results)) {

            $index++;
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

            // $return_data = array($id, $colletype, $college, $website, $address, $city, $state, $zipcode, $latitude, $longitude, $phone, $distanceIn,);
            $passingInfo = $id.",".$colletype.",".$college.",".$website.",".$address.",".$city.",".$state.",".$zipcode.",".$latitude.",".$longitude.",".$phone;

            //ensure last matching record does not have a ";"at the end
            if ($index < $numrecs) {
                $allmatchingcolleges .= $passingInfo.";";
            }else {
                $allmatchingcolleges .= $passingInfo;
            }
                
    }
    // send all matching colleges
    print $allmatchingcolleges;

    }else {
        print "No record(s) found";
    }

?>    