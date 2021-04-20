<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="./style.css" />
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




    echo '<select id="mySelect" onchange="initMap()">';
    while ($recordArray = mysqli_fetch_row($results)) {

        //extracting field's values
        $id = $recordArray[0];
        $colletype = $recordArray[1];
        $college = $recordArray[2];

        $collegeName[] = $college;
        $website[] = $recordArray[3];
        $address[] = $recordArray[4];
        $city[] = $recordArray[5];
        $state[] = $recordArray[6];
        $zipcode[] = $recordArray[7];
        $latitude[] = $recordArray[8];
        $longitude[] = $recordArray[9];
        $phone[] = $recordArray[10];
        //string variable that holds all book's information
        // $collegesdata = $id.",".$collge.",".$address.",".$city.",".$state.",".$zipcode.",".$telephone.",".$website;
        
        print "<option value=".$id.">$college</option>";        
}
    echo "</select>";
?>    
<script>
let map;
function initMap() {
    let value = document.getElementById("mySelect").value;
    let i = value -1;
    let college = <?php echo json_encode($collegeName); ?>;
    let address = <?php echo json_encode($address); ?>;
    let city = <?php echo json_encode($city); ?>;
    let state = <?php echo json_encode($state); ?>;
    let zipcode = <?php echo json_encode($zipcode); ?>;
    let lat = <?php echo json_encode($latitude); ?>;
    let long = <?php echo json_encode($longitude); ?>;
    let phone = <?php echo json_encode($phone); ?>;
    let website = <?php echo json_encode($website); ?>;



    const myLatLng = { lat: parseFloat(lat[i]), lng: parseFloat(long[i]) };
        map = new google.maps.Map(document.getElementById('showmap'), {
        zoom: 15,
        center: myLatLng,
        });

    const contentString = 
    '<div>'+
        "<h2>"+college[i]+"</h2>"+
        "<p>"+address[i]+"," +city[i]+", <span>"+state[i]+", </span> <span>"+zipcode[i]+"</span></p>"+
        "<caption>"+phone[i]+"</caption>"+
        "<p><b>Website: </b><a href="+website[i]+">"+website[i]+"</a></p>"
    '</div>'
    
    
    
    ;
        const infowindow = new google.maps.InfoWindow({
        content: contentString,
        });

    const marker = new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Hello World!",
    });

    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });
}
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj9WjXBxLnXy-tEn0PrhD2O9QQhqL3fyY&callback=initMap&libraries=&v=weekly"
    async
></script>
</body>
</html>
