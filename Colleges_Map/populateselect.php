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
    $initialValues = "1,initial";
    if ($numrecs > 0) {
        print "<select id='collegeList' onchange='mapCollege()'>";
        print "<option value='' selected disabled hidde>Select a College...</option>";
       // print "<option value='".$initialValues."'>Select a College...</option>";

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

            //passing Variable
            $passingInfo = $id.",".$colletype.",".$college.",".$website.",".$address.",".$city.",".$state.",".$zipcode.",".$latitude.",".$longitude.",".$phone;

            print "<option value='".$passingInfo."'>$college</option>";        
    }
        print "</select>";
    }else {
        print "No record(s) found";
    }

?>   
</body>
</html>
