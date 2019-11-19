var eventStartDate = new Date(2020, 00, 01, 00, 00, 00).getTime();
var eventEndDate = new Date(2020, 00, 01, 12, 00, 00).getTime();
var now = new Date().getTime();
var counterShowed = false;

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

        if (!counterShowed) {
            document.getElementById("timeRemainingContainer").style.visibility = "visible";
            document.getElementById("timeRemainingContainer").style.opacity = "1";
            counterShowed = true;
        }
    } else {
        document.getElementById("conferenceIsNowContainer").style.display = "flex";
        document.getElementById("conferenceIsNowContainer").style.opacity = "1";
        clearInterval(countdown);
    }
}, 1000);

/* var eventEnded = setTimeout(function () {
    document.getElementById("timeUpContainer").style.display = "flex";;
    document.getElementById("timeUpContainer").style.opacity = "1";
}, eventEndDate - now); */