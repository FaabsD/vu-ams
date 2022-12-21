const { AmsWPRest } = require('./ams-classes');

let L = require('leaflet');
// const { URL, URLSearchParams } = require('url');

if (document.querySelector('#locationsMap')) {
    const baseUrl = window.location.origin;
    // let apiUrl = new URL(baseUrl + "/wp-json/wp/v2/location");
    const apiUrl = baseUrl + "/wp-json/wp/v2/location";

    const locationsRestObj = new AmsWPRest('location', 10);
    console.log('Get base url for map');
    console.log(baseUrl);
    console.log('create api url');
    console.log(apiUrl);
    const map = L.map('locationsMap');

    map.setView([51.505, -0.09], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '<a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap</a>',
    }).addTo(map);

    // make a call to the (built-in) WordPress API to retrieve locations

    locationsRestObj.makeMultipleRestCalls().then(locations => {
        if (locations && typeof locations === 'object') {
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

                // create a pop-up to add to the marker
                let popUp = L.popup().setContent(`<h3>${locationTitle}</h3> ${locationInfo}`);

                // create a new marker on the map
                markers[index] = L.marker([lat, long]).addTo(map).bindPopup(popUp);
            });

            console.log('======== set location markers ========');
            console.log(markers);

            // create a group of all the markers
            let markerGroup = L.featureGroup(markers);
            // set map view to fit the markers
            map.fitBounds(markerGroup.getBounds());
        }
    }).catch(error => {
        // just in case fetching the locations from the built-in WordPress API fails
        // open a alert to show the visitor that the locations fetching failed

        alert('Something went wrong while loading in locations try refreshing the page or check the console tab from the inspector by right clicking and selecting inspect');
        console.error('Something went wrong while fetching locations', error);
    })
}