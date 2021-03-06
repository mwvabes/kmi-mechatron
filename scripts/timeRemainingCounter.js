//Settings
const eventStartDate = new Date(2020, 04, 27, 9, 0, 0).getTime();
const eventEndDate = new Date(2020, 04, 28, 15, 0, 0).getTime();
const registrationDateEnd = new Date(2020, 03, 27).getTime();

let now = new Date().getTime();

const daysRemainedContent = '<h1>Do Konferencji pozostało:</h1>' +
  '<span id="rDays" class="rNum"></span> dni ' +
  '<span id="rHours" class="rNum"></span> godzin ' +
  '<div class="numbersSplitter"></div>' +
  '<span id="rMinutes" class="rNum"></span> minut ' +
  '<span id="rSeconds" class="rNum"></span> sekund ';

const conferenceIsFinishedContent = '<h1 class="conferenceState">Konferencja już się odbyła</h1>' +
  '<p class="conferenceState">Zapraszamy w przyszłej edycji!</p>';

const conferenceIsNowContent = '<h1 class="conferenceState">Konferencja właśnie się odbywa</h1>' +
  '<p class="conferenceState"></p>';

// --------------------

let timeRemainingVisible = () => {
  setTimeout(function () {
    document.getElementById("timeRemainingContainer").style.visibility = "visible";
    document.getElementById("timeRemainingContainer").style.opacity = 1;
  }, 500);
};

let structureTimeUp = () => {
  document.getElementById("timeRemainingContainer").innerHTML = conferenceIsFinishedContent;
};

let structureCounter = () => {
  document.getElementById("timeRemainingContainer").innerHTML = daysRemainedContent;
};

let structureConferenceIsNow = () => {
  document.getElementById("timeRemainingContainer").innerHTML = conferenceIsNowContent;

  let now = new Date().getTime();
  let toEventEnd = eventEndDate - now;

  let eventEnded = setTimeout(function () {
    showTimeUp();
  }, toEventEnd);
};

let count = () => {
  let now = new Date().getTime();

  if (now < eventStartDate) {
    let remaininigTime = eventStartDate - now;

    let days = Math.floor(remaininigTime / (1000 * 60 * 60 * 24));
    let hours = Math.floor((remaininigTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((remaininigTime % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((remaininigTime % (1000 * 60)) / 1000);

    document.getElementById("rDays").innerHTML = days;
    document.getElementById("rHours").innerHTML = hours;
    document.getElementById("rMinutes").innerHTML = minutes;
    document.getElementById("rSeconds").innerHTML = seconds;
  } else {
    showConferenceIsNow();
    clearInterval(countdown);
  }
};

let renderTime = () => {

  const toEventEnd = eventEndDate - now;
  let daysToRegistrationEnd = Math.ceil((registrationDateEnd - now) / (1000 * 60 * 60 * 24)) + 1;

  if (daysToRegistrationEnd == 1) {
    document.getElementById("warning").style.visibility = "visible";
    document.querySelector('#warning').style.display = "flex";
    document.querySelector('#warning h4').innerHTML = "Ostatni dzień na zgłoszenie projektu!";
  } else if (daysToRegistrationEnd < 1) {
    document.getElementById("warning").style.visibility = "visible";
    document.querySelector('#warning').style.display = "flex";
    document.querySelector('#warning h4').innerHTML = "Czas na zgłoszenie projektu już minął";
  } else if (daysToRegistrationEnd > 1 && daysToRegistrationEnd < 15) {
    document.getElementById("warning").style.visibility = "visible";
    document.querySelector('#warning').style.display = "flex";
    document.querySelector('#warning > h4').innerHTML = 'UWAGA! Pozostało tylko <span class="remainedDaysToRegistration">kilka</span> dni na zgłoszenie projektu!';
    document.querySelector('#warning > h4 > span.remainedDaysToRegistration').innerHTML = daysToRegistrationEnd;
  }

  if (document.getElementById("welcome")) {
    if (now < eventStartDate) {
      structureCounter();
      count();
      let countdown = setInterval(function () {
        count();
      }, 1000);
      timeRemainingVisible();
    } else if (now >= eventStartDate && now < eventEndDate) {
      structureConferenceIsNow();
      timeRemainingVisible();
    } else {
      structureTimeUp();
      timeRemainingVisible();
    }
  }
};

document.addEventListener("DOMContentLoaded", function () {
  renderTime();
});