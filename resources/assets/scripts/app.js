// For debugging set const debugMode to true
const {OBJLoader} = require("three/examples/jsm/loaders/OBJLoader");
const {ArcballControls} = require("three/examples/jsm/controls/ArcballControls");
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
    const renderer = new THREE.WebGLRenderer({alpha: true, antialias: true});

    // set camera position
    camera.position.set(0, 0, -90);

    renderer.setSize(containerWidth, containerHeight);
    renderer.setClearColor('#6a6b6a', .5);

    const controls = new ArcballControls(camera, renderer.domElement, scene);
    controls.enableZoom  = false;
    controls.update();
    controls.setGizmosVisible(true);

    const loader = new OBJLoader();

    loader.load(
        directory_uri.theme_url + '/resources/assets/models/dondedag ams.obj',
        function (object) {
            object.position.set(0, -10, 0);
            scene.add(object);
            setupSpotLight();
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

    function setupSpotLight() {
        const spotlight = new THREE.SpotLight(0xffffff, 1.6);
        spotlight.position.set(-5, 5, 15);
        spotlight.castShadow = true;

        spotlight.shadow.mapSize.width = threeContainer.clientWidth;
        spotlight.shadow.mapSize.height = threeContainer.clientHeight;

        spotlight.shadow.camera.near = 0.1;
        spotlight.shadow.camera.far = 100;
        spotlight.shadow.camera.fov = 50;

        // scene.add(spotlight);
        camera.add(spotlight);

        if (debugMode) {
            const SpotlightHelper = new THREE.SpotLightHelper(spotlight, 'rgb(255, 255, 0)');
            scene.add(SpotlightHelper);
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