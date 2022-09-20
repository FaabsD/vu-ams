let L = require('leaflet');
// const { URL, URLSearchParams } = require('url');

if ($('#locationsMap')) {
    const baseUrl = window.location.origin;
    let apiUrl = new URL(baseUrl + "/wp-json/wp/v2/location");
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
}