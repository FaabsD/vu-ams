let L = require('leaflet');
// const { URL, URLSearchParams } = require('url');

if ($('#locationsMap')) {
    const baseUrl = window.location.origin;
    // let apiUrl = new URL(baseUrl + "/wp-json/wp/v2/location");
    const apiUrl = baseUrl + "/wp-json/wp/v2/location";
    console.log('Get base url for map');
    console.log(baseUrl);
    console.log('create api url');
    console.log(apiUrl);
    const map = L.map('locationsMap');

    map.setView([51.505, -0.09], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // make a call to the (built-in) WordPress API to retrieve locations

    fetch(apiUrl)
        .then((response) => {
            if (response.ok) {
                return response.json()
            }
        })
        .then((json) => {
            let locations = json;

            console.log("======== MY LOCATIONS ========");

            if (locations) {
                const markers = [];
                locations.forEach((location, index) => {
                    console.log('====== Location Title ======');
                    console.log(location.title.rendered);
                    console.log('====== Location Latitude ======');
                    console.log(location.acf.lat);
                    console.log('====== Location Longitude ======');
                    console.log(location.acf.long);
                    console.log('====== Location Information ======');
                    console.log(location.content.rendered);

                    let locationTitle = location.title.rendered;
                    let lat = location.acf.lat;
                    let long = location.acf.long;
                    let locationInfo = location.content.rendered;


                    // create a new marker on the map
                    markers[index] = L.marker([lat, long]).addTo(map);
                });

                console.log("======== set location markers ========");
                console.log(markers);
            }
        });


}