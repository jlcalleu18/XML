<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<?php
    //get passing variables: address and distance
    $latIn = $_GET["latKey"];
    $longIn = $_GET["longKey"];
    $distanceIn = $_GET["distanceKey"];

    //print "Lat ".$latIn." long: ". $longIn." distance: ". $distanceIn;
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

    $SQLselect = "SELECT *, ( 3959 * acos( cos( radians(".$latIn.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$longIn.") ) + sin( radians(".$latIn.") ) * sin(radians(latitude)) ) ) AS distance FROM collegesmap_table HAVING distance < ".$distanceIn." ORDER BY distance ";
    
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

            //passing Variable
            // $passingInfo = $id.",".$colletype.",".$college.",".$website.",".$address.",".$city.",".$state.",".$zipcode.",".$latitude.",".$longitude.",".$phone.",".$distanceIn;
            $return_arr[] = array("id" => $id,
            "colletype" => $colletype,
            "college" => $college,
            "website" => $website,
            "address" => $address,
            "city" => $city,
            "state" => $state,
            "zipcode" => $zipcode,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "phone" => $phone,
            "distance" => $distanceIn,
        );
                
    }
echo json_encode($return_arr);
    }else {
        print "No record(s) found";
    }

    // echo json_encode ($id);
    // echo json_encode ($colletype);
    // echo json_encode ($college);
    // echo json_encode ($website);
    // echo json_encode ($address);
    // echo json_encode ($city);
    // echo json_encode ($state);
    // echo json_encode ($zipcode);
    // echo json_encode ($latitude);
    // echo json_encode ($longitude);
    // echo json_encode ($phone);
    // echo json_encode ($distanceIn);
?>    

</body>
</html>
