var eventStartDate = new Date(2020, 00, 01, 00, 00, 00).getTime();
var eventEndDate = new Date(2020, 00, 01, 12, 00, 00).getTime();
var now = new Date().getTime();

var countdown = setInterval(function () {
    var now = new Date().getTime();

    if (now < eventStartDate) {
        var remaininigTime = eventStartDate - now;

        var days = Math.floor(remaininigTime / (1000 * 60 * 60 * 24));
        var hours = Math.floor((remaininigTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((remaininigTime % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remaininigTime % (1000 * 60)) / 1000);

        document.getElementById("rDays").innerHTML = days;
        document.getElementById("rHours").innerHTML = hours;
        document.getElementById("rMinutes").innerHTML = minutes;
        document.getElementById("rSeconds").innerHTML = seconds;
    } else {
        document.getElementById("timeRemainingContainer").style.display = "none";
        document.getElementById("timeUpContainer").style.display = "flex";
        document.getElementById("timeUpContainer").innerHTML = "Konferencja trwa";
        clearInterval(countdown);
    }
}, 1000);

var eventEnded = setTimeout(function () {
    document.getElementById("timeUpContainer").innerHTML = "Konferencja już się odbyła";
}, eventEndDate - now);