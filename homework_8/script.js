function runjQuery() {
    //get inputs: address and distance
    let inputAdress = $("#adressTxtBx").val();
    let inputDistance = $("#distanceList").val();
    console.log(inputAdress);
    console.log(inputDistance);
    //Valitation address and distance
    if (inputAdress != "" && inputDistance != "") {
        //get address' coordinates (latitude, longitude)
        //use Google's Geocorder()
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: inputAdress }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                let coordinates = results[0].geometry.location;
                let lati = coordinates.lat();
                let longi = coordinates.lng();
                console.log(lati);
                console.log(longi);
                var data = [];
                $.ajax({
                    type: "POST",
                    url: "Hmk8.php",
                    data: {
                        lati: lati,
                        long: longi,
                        inputDistance: inputDistance,
                    },
                    cache: false,
                    success: function (html) {
                        data = $.parseJSON(html);
                        console.log(data);
                        getData(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr);
                    },
                });

                function getData(obj) {
                    let options = {
                        center: { lat: parseFloat(lati), lng: parseFloat(longi) },
                        zoom: 10.7,
                        radius: (inputDistance / 0.00062137),
                    };
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
                        let lat = obj[i][8];
                        let long = obj[i][9];
                        let phone = obj[i][10];
                        addMarker({
                            coords: { lat: parseFloat(lat), lng: parseFloat(long) },
                            contentString:
                                '<div id="content">' +
                                "<p>" +
                                "<b>" +
                                college +
                                "</b>" +
                                "<br />" +
                                address +
                                "<br />" +
                                city +
                                ", " +
                                state +
                                ", " +
                                zipcode +
                                "<br />" +
                                phone +
                                "<br />" +
                                "</p>" +
                                "<p><b>Website: </b><a href=" +
                                website +
                                ">" +
                                website +
                                "</a></p>" +
                                "</div>",
                        });
                    }

                    function addMarker(props) {
                        const marker = new google.maps.Marker({
                            label: id,
                            position: props.coords,
                            map: map,
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

                    const cityCircle = new google.maps.Circle({
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.35,
                        map,
                        center: options.center,
                        radius: options.radius,
                    });
                    console.log((10 * 2) * 3.1416);
                }
            } else {
                alert("user address not found");
            }
        });
    } else {
        alert("Please enter a valid address and a valid distance");
        //set the focus to the text box
        $("#adressTxtBx").focus();
    }
}
