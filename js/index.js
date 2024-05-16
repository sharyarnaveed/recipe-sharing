function next(img) {
    let background = document.getElementById("main_con");
    background.style.backgroundImage = img;
    background.style.backgroundSize = "cover";
    background.style.backgroundPosition="center";
    background.style.backgroundRepeat="no-repeat";
}

let arrayimg = [
    "url(https://images.unsplash.com/photo-1677175183792-e6a9b8b14305?auto=format&fit=crop&q=80&w=5000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)",
    "url(https://images.unsplash.com/photo-1598214886806-c87b84b7078b?q=80&w=5000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)",
    "url(https://images.unsplash.com/photo-1606913079621-e64bd28682ba?w=5000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGZvb2QlMjBiYWNrZ3JvdW5kfGVufDB8fDB8fHww)"
];

let ind = 0;

// Use setInterval to change the background image every 3000 milliseconds
let intervalId = setInterval(() => {
    next(arrayimg[ind]);
    ind = (ind + 1) % arrayimg.length;
}, 10000);

// Uncomment the following lines if you want to stop the interval after a certain number of iterations (for example, after looping through the array once).
// setTimeout(() => {
//     clearInterval(intervalId);
// }, arrayimg.length * 3000);
