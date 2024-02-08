
function updateTime() {
    var now = new Date();
    var hours = now.getHours();

    // Check if it's day or night
    var isDaytime = hours >= 6 && hours < 20;
    var sunmoonImg = document.getElementById("sunmoon");

    // Sun or moon
    if (isDaytime) {
        sunmoonImg.src = "https://i.ibb.co/f2015xT/sun.png";
    } else {
        sunmoonImg.src = "https://i.ibb.co/nsqzqTs/moon.jpg";
    }

    var minutes = now.getMinutes().toString().padStart(2, '0');
    var seconds = now.getSeconds().toString().padStart(2, '0');
    var timeString = hours + ':' + minutes + ':' + seconds;
    document.getElementById('clock').textContent = 'Current time: ' + timeString;
}

function submitForm() {
    document.forms[0].submit();
}

updateTime();
setInterval(updateTime, 1000);
