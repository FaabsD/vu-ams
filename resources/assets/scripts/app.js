// For debugging set const debugMode to true
const {OBJLoader} = require("three/examples/jsm/loaders/OBJLoader");
const debugMode = true;

// Loading a 3d render
const threeContainer = document.querySelector('#THREE_container');

if (threeContainer) {
    // do some 3d render
    const containerWidth = threeContainer.clientWidth;
    const containerHeight = threeContainer.clientHeight;

    const THREE = require('three');

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(50, containerWidth / containerHeight, 0.1, 100);
    const renderer = new THREE.WebGLRenderer();

    renderer.setSize(containerWidth, containerHeight);
    renderer.setClearColor('#f1f1f1', 0);

    const directionalLight = new THREE.DirectionalLight('#fff', 1.0);

    scene.add(directionalLight);

    const loader = new OBJLoader();

    loader.load(
        directory_uri.theme_url + '/resources/assets/models/dondedag ams.obj',
        function (object) {
            scene.add(object);
            renderer.render(scene, camera);
        },
        function (xhr) {
            console.log((xhr.loaded / xhr.total * 100) + '% loaded');
        },
        function (error) {
            console.log('An error occured');
            console.log(error);
        }
    );

    threeContainer.appendChild(renderer.domElement);


}