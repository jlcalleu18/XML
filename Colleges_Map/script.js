function runJQuery() {
    //set the parameters
    $.ajax({
        url: "populateselect.php",
        success: function (serverdata) {
            $("#showselect").html(serverdata);
        },
    });
}
function mapCollege() {
    //read selection
    let selectOption = $("#collegeList").val();
    //console.log(selectOption);
    // alert(selectOption);
    //extraction individual values from string selectOption
    let id = selectOption.split(",")[0];
    let collegetype = selectOption.split(",")[1];
    let college = selectOption.split(",")[2];
    let website = selectOption.split(",")[3];
    let address = selectOption.split(",")[4];
    let city = selectOption.split(",")[5];
    let state = selectOption.split(",")[6];
    let zipcode = selectOption.split(",")[7];
    let latitude = selectOption.split(",")[8];
    let longitude = selectOption.split(",")[9];
    let phone = selectOption.split(",")[10];

    console.log(typeof id);

    const myLatLng = {
        lat: parseFloat(latitude),
        lng: parseFloat(longitude),
    };
    map = new google.maps.Map(document.getElementById("showmap"), {
        zoom: 15.5,
        center: myLatLng,
        
    });
    const contentString =
        '<div id="content">' +
        "<p>"+
        "<b>"+college +"</b>"+ 
        "<br />" + address + "<br />" +
        city + ", " +state + ", " + zipcode +
        "<br />" + phone + "<br />" +
        "</p>" +
        "<p><b>Website: </b><a href=" + website + ">" + website + "</a></p>";
        "</div>";
    const infowindow = new google.maps.InfoWindow({
        content: contentString,
    });

    const marker = new google.maps.Marker({
        label: id,
        position: myLatLng,
        map,
        title: "id",
    });

    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });
}
