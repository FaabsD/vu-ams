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
    camera.position.set(0, 0, 25);

    renderer.setSize(containerWidth, containerHeight);
    renderer.setClearColor('#6a6b6a', 1);

    const directionalLight = new THREE.DirectionalLight('#fff', 1.0);

    directionalLight.position.set(10, 10, 15);

    scene.add(directionalLight);

    const loader = new OBJLoader();

    loader.load(
        directory_uri.theme_url + '/resources/assets/models/dondedag ams.obj',
        function (object) {
            object.position.set(0, -10, -75);
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

    const controls = new ArcballControls(camera, renderer.domElement, scene);
    controls.setGizmosVisible(true);

    window.addEventListener('resize', onWindowResize);

    function onWindowResize() {
        camera.aspect = threeContainer.clientWidth / threeContainer.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(threeContainer.clientWidth, threeContainer.clientHeight);
    }

    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }


}