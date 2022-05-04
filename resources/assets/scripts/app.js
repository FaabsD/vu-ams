// For debugging set const debugMode to true
require( './modules/tabswitch');
const {OBJLoader} = require("three/examples/jsm/loaders/OBJLoader");
const {ArcballControls} = require("three/examples/jsm/controls/ArcballControls");
const {RectAreaLightUniformsLib} = require("three/examples/jsm/lights/RectAreaLightUniformsLib");
const {RectAreaLightHelper} = require("three/examples/jsm/helpers/RectAreaLightHelper");
const THREE = require("three");
const debugMode = false;

// Loading a 3d render
const threeContainer = document.querySelector('#THREE_container');

if (threeContainer) {
    // do some 3d render
    const containerWidth = threeContainer.clientWidth;
    const containerHeight = threeContainer.clientHeight;

    const THREE = require('three');

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(50, containerWidth / containerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({alpha: true, antialias: true});

    // set camera position
    camera.position.set(-19, 80, 26);

    if (debugMode) {
        const cameraHelper = new THREE.CameraHelper(camera);
        scene.add(cameraHelper);
    }

    renderer.setSize(containerWidth, containerHeight);
    renderer.setClearColor('#6a6b6a', 0);

    const controls = new ArcballControls(camera, renderer.domElement, scene);
    controls.enableZoom = false;
    controls.update();
    if (debugMode) {
        controls.setGizmosVisible(true);
    } else {
        controls.setGizmosVisible(false);
    }

    if (debugMode) {
        controls.addEventListener('change', function (e) {
            console.log('Update camera position');
            console.log(camera.position);
        });
    }

    const loader = new OBJLoader();

    loader.load(
        directory_uri.theme_url + '/resources/assets/models/dondedag ams.obj',
        function (object) {
            object.position.set(0, -10, 0);
            scene.add(object);
            setupLight(object);
            renderer.render(scene, camera);
            console.log(camera);
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

    window.addEventListener('resize', onWindowResize);

    function setupLight(target) {

        const dirLight1 = new THREE.DirectionalLight(0xffffff);
        dirLight1.position.set(30, 30, 0);

        const dirLight2 = new THREE.DirectionalLight(0xffffff);
        dirLight2.position.set(-30, -30, 0);

        scene.add(dirLight1);
        scene.add(dirLight2);

        if (debugMode) {
            const helper1 = new THREE.DirectionalLightHelper(dirLight1, 8);
            scene.add(helper1);
            const helper2 = new THREE.DirectionalLightHelper(dirLight2, 8);
            scene.add(helper2);
        }


    }

    function onWindowResize() {
        camera.aspect = threeContainer.clientWidth / threeContainer.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(threeContainer.clientWidth, threeContainer.clientHeight);
        renderer.render(scene, camera);
    }

    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }

    animate();


}
