// commented out for later use

// import * as THREE from "three";
// import * as BufferGeometryUtils from "three/examples/jsm/utils/BufferGeometryUtils.js";
// import { OrbitControls } from "three/examples/jsm/controls/OrbitControls";

// // import * as THREE from "three";
// // import { OrbitControls } from "OrbitControls";


// // Define the scene constants
// var check = 1;
// const CANVAS = document.querySelector("#canvas");

// const SCENE_ANTIALIAS = true;
// const SCENE_ALPHA = true;
// const SCENE_BACKGROUND_COLOR = 0x000000;

// const CAMERA_FOV = 20;
// const CAMERA_NEAR = 100;
// const CAMERA_FAR = 500;
// const CAMERA_X = 0;
// const CAMERA_Y = 0;
// const CAMERA_Z = 220;

// const MASK_IMAGE = "../../static/media/map.png";
// const SPHERE_RADIUS = 30;
// const LATITUDE_COUNT = 80;
// const DOT_DENSITY = 0.8;

// const DOT_SIZE = 0.2;
// const DOT_COLOR = 0xffffff;

// // Utility function to convert a dot on a sphere into a UV point on a
// // rectangular texture or image.
// const spherePointToUV = (dotCenter, sphereCenter) => {
//     // Create a new vector and give it a direction from the center of the sphere
//     // to the center of the dot.
//     const newVector = new THREE.Vector3();
//     newVector.subVectors(sphereCenter, dotCenter).normalize();

//     // Calculate the  UV coordinates of the dot and return them as a vector.
//     const uvX =
//         1 - (0.5 + Math.atan2(newVector.z, newVector.x) / (2 * Math.PI));
//     const uvY = 0.5 + Math.asin(newVector.y) / Math.PI;

//     return new THREE.Vector2(uvX, uvY);
// };

// // Utility function to sample the data of an image at a given point. Requires
// // an imageData object.
// const sampleImage = (imageData, uv) => {
//     // Calculate and return the data for the point, from the UV coordinates.
//     const point =
//         4 * Math.floor(uv.x * imageData.width) +
//         Math.floor(uv.y * imageData.height) * (4 * imageData.width);

//     return imageData.data.slice(point, point + 4);
// };

// // Render the scene.
// const renderScene = (imageData) => {
//     // Define the renderer, in this case WebGL.
//     const renderer = new THREE.WebGLRenderer({
//         canvas: CANVAS,
//         antialias: SCENE_ANTIALIAS,
//         alpha: SCENE_ALPHA,
//     });

//     // // Set up and position the camera.
//     const camera = new THREE.PerspectiveCamera(
//         CAMERA_FOV,
//         CANVAS.width / CANVAS.height,
//         CAMERA_NEAR,
//         CAMERA_FAR
//     );

//     // Set up the orbit controls.
//     const controls = new OrbitControls(camera, renderer.domElement);

//     // Position the camera.
//     camera.position.set(CAMERA_X, CAMERA_Y, CAMERA_Z);

//     // Update the controls (required after positioning the camera).
//     controls.update();

//     // Set up the scene.
//     const scene = new THREE.Scene();

//     // Add a background color.
//     scene.background = new THREE.Color(SCENE_BACKGROUND_COLOR);

//     // Define an array to hold the geometries of all the dots.
//     const dotGeometries = [];

//     // Create a blank vector to be used by the dots.
//     const vector = new THREE.Vector3();

//     // Loop across the latitude lines.
//     for (let lat = 0; lat < LATITUDE_COUNT; lat += 1) {
//         // Calculate the radius of the latitude line.
//         const radius =
//             Math.cos((-90 + (180 / LATITUDE_COUNT) * lat) * (Math.PI / 180)) *
//             SPHERE_RADIUS;
//         // Calculate the circumference of the latitude line.
//         const latitudeCircumference = radius * Math.PI * 2 * 2;
//         // Calculate the number of dots required for the latitude line.
//         const latitudeDotCount = Math.ceil(latitudeCircumference * DOT_DENSITY);

//         // Loop across the dot count for the latitude line.
//         for (let dot = 0; dot < latitudeDotCount; dot += 1) {
//             const dotGeometry = new THREE.CircleGeometry(DOT_SIZE, 5);
//             // Calculate the phi and theta angles for the dot.
//             const phi = (Math.PI / LATITUDE_COUNT) * lat;
//             const theta = ((2 * Math.PI) / latitudeDotCount) * dot;

//             // Set the vector using the spherical coordinates generated from the sphere radius, phi and theta.
//             vector.setFromSphericalCoords(SPHERE_RADIUS, phi, theta);

//             // Make sure the dot is facing in the right direction.
//             dotGeometry.lookAt(vector);

//             // Move the dot geometry into position.
//             dotGeometry.translate(vector.x, vector.y, vector.z);

//             // Find the bounding sphere of the dot.
//             dotGeometry.computeBoundingSphere();

//             // Find the UV position of the dot on the land image.
//             const uv = spherePointToUV(
//                 dotGeometry.boundingSphere.center,
//                 new THREE.Vector3()
//             );

//             // Sample the pixel on the land image at the given UV position.
//             const sampledPixel = sampleImage(imageData, uv);

//             // If the pixel contains a color value (in other words, is not transparent),
//             // continue to create the dot. Otherwise don't bother.
//             if (sampledPixel[3]) {
//                 // Push the positioned geometry into the array.
//                 dotGeometries.push(dotGeometry);
//             }
//         }
//     }

//     // Merge all the dot geometries together into one buffer geometry.
//     const mergedDotGeometries =
//         BufferGeometryUtils.mergeBufferGeometries(dotGeometries);

//     // Define the material for the dots.
//     const dotMaterial = new THREE.MeshBasicMaterial({
//         color: DOT_COLOR,
//         side: THREE.DoubleSide,
//     });

//     // Create the dot mesh from the dot geometries and material.
//     const dotMesh = new THREE.Mesh(mergedDotGeometries, dotMaterial);

//     // Add the dot mesh to the scene.
//     scene.add(dotMesh);

//     // Animate the scene using the browser's native requestAnimationFrame method.
//     const animate = (time) => {
//         // Reduce the current timestamp to something manageable.
//         time *= 0.001;

//         // Update the dot mesh rotation.
//         dotMesh.rotation.y = time * 0.1;

//         // Update the orbit controls now that things have changed.
//         controls.update();

//         // Re-render the scene and trigger another animation frame.
//         renderer.render(scene, camera);

//         requestAnimationFrame(animate);
//     };

//     // Trigger the first animation frame.
//     requestAnimationFrame(animate);
// };

// // Establish the canvas size and call the function to render the scene.
// const setCanvasSize = () => {
//     CANVAS.width = window.innerWidth;
//     CANVAS.height = window.innerHeight;

//     // Initialise an image loader.
//     const imageLoader = new THREE.ImageLoader();

//     // Load the image used to determine where dots are displayed. The sphere
//     // cannot be initialised until this is complete.
//     imageLoader.load(MASK_IMAGE, (image) => {
//         // Create an HTML canvas, get its context and draw the image on it.
//         const tempCanvas = document.createElement("canvas");

//         tempCanvas.width = image.width;
//         tempCanvas.height = image.height;

//         const ctx = tempCanvas.getContext("2d");

//         ctx.drawImage(image, 0, 0);

//         // Read the image data from the canvas context.
//         const imageData = ctx.getImageData(0, 0, image.width, image.height);

//         renderScene(imageData);
//     });
// };

// setCanvasSize();

// // When the window is resized, redraw the scene.
// window.addEventListener("resize", setCanvasSize);
