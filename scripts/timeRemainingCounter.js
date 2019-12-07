var eventStartDate = new Date(2020, 02, 02, 12, 00, 00).getTime();
var eventEndDate = new Date(2020, 02, 20, 15, 28, 10).getTime();
var registrationDateEnd = new Date(2020, 02, 12).getTime();

var now = new Date().getTime();

var toEventEnd = eventEndDate - now;
var daysToRegistrationEnd = Math.ceil((registrationDateEnd - now) / (1000 * 60 * 60 * 24)) + 1;

if (daysToRegistrationEnd < 1) {
    document.getElementById("warning").style.visibility = "visible";
    document.querySelector('#warning a').style.display = "none";
    document.querySelector('#warning h4').innerHTML = "Czas na zgłoszenie projektu już minął";
} else if (daysToRegistrationEnd < 15) {
    document.getElementById("warning").style.visibility = "visible";
    document.querySelector('#warning > h4 > span.remainedDaysToRegistration').innerHTML = daysToRegistrationEnd;
}

if (now < eventStartDate) {
    var countdown = setInterval(function () {
        count();
        showCounter();
    }, 1000);
} else if (now >= eventStartDate && now < eventEndDate) {
    showConferenceIsNow();
} else {
    showTimeUp();
}

function count() {
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
        showConferenceIsNow();
        clearInterval(countdown);
    }
}

function showCounter() {
    document.getElementById("timeRemainingContainer").style.visibility = "visible";
    document.getElementById("timeRemainingContainer").style.opacity = "1";
}

function showConferenceIsNow() {
    document.getElementById("timeRemainingContainer").style.visibility = "hidden";
    document.getElementById("timeRemainingContainer").style.opacity = "0";
    document.getElementById("conferenceIsNowContainer").style.display = "block";
    document.getElementById("conferenceIsNowContainer").style.opacity = "1";

    var now = new Date().getTime();
    var toEventEnd = eventEndDate - now;

    var eventEnded = setTimeout(function () {
        showTimeUp();
    }, toEventEnd);
}

function showTimeUp() {
    document.getElementById("timeRemainingContainer").style.visibility = "hidden";
    document.getElementById("timeRemainingContainer").style.opacity = "0";
    document.getElementById("conferenceIsNowContainer").style.display = "none";
    document.getElementById("conferenceIsNowContainer").style.opacity = "0";
    document.getElementById("timeUpContainer").style.display = "block";
    document.getElementById("timeUpContainer").style.opacity = "1";
}