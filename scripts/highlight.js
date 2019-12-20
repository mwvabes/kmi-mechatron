const numbers = document.querySelectorAll(".numElement>.number");

let switchColor = (element) => {
  numbers[element].classList.add("highlightNumber");
  setTimeout(function () {
    numbers[element].classList.remove("highlightNumber");
    if (element >= numbers.length -1) element = -1;
    switchColor(element+1);
  }, 650);  
};

document.addEventListener("DOMContentLoaded", function () {
  switchColor(0);
});