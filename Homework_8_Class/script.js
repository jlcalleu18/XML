function runJQuery() {
    //set the parameters
    $.ajax({
        url: "populateselect.php",
        success: function (serverdata) {
            $("#showselect").html(serverdata);
        },
    });
}

function initMap() {

    let options = {
        center: { lat: 40.7128, lng: -74.0060 },
        zoom: 10.7,
    }
    let map = new google.maps.Map(document.getElementById('map'), options);

    let id;

    for (let i = 0; i < obj.length; i++) {
        id = obj[i][0];
        let college = obj[i][2];
        let website = obj[i][3];
        let address = obj[i][4];
        let city = obj[i][5];
        let state = obj[i][6];
        let zipcode = obj[i][7];
        var lat = obj[i][8];
        var long = obj[i][9];
        let phone = obj[i][10];
        addMarker({
            coords: { lat: parseFloat(lat), lng: parseFloat(long) },
            contentString:
                '<div id="content">' +
                "<p>" +
                "<b>" + college + "</b>" +
                "<br />" + address + "<br />" +
                city + ", " + state + ", " + zipcode +
                "<br />" + phone + "<br />" +
                "</p>" +
                "<p><b>Website: </b><a href=" + website + ">" + website + "</a></p>" +
                '</div>'
        });
    }
    function addMarker(props) {
        const marker = new google.maps.Marker({
            label: id,
            position: props.coords,
            map: map
        });
        if (props.contentString) {
            const infowindow = new google.maps.InfoWindow({
                content: props.contentString,
            });
            marker.addListener("click", () => {
                infowindow.open(map, marker);
            });
        }
    }
    const geocoder = new google.maps.Geocoder();
    document.getElementById("submit").addEventListener("click", () => {
        geocodeAddress(geocoder, map);
    });

}
function geocodeAddress(geocoder, resultsMap) {
    const address = document.getElementById("address").value;
    geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
            resultsMap.setCenter(results[0].geometry.location);
            let lat = results[0].geometry.location.lat();
            let long = results[0].geometry.location.lng();
            console.log(lat);
            console.log(long);
            new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location,
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}
initMap();
