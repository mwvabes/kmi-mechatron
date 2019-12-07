"use strict";

const navItems = document.querySelectorAll("nav > ul > li");
const navAnchors = document.querySelectorAll("nav > ul > li > a");

// hiding menu after click item
for (const item of navItems) {
  item.addEventListener("click", function () {
    document.getElementById("navToggle").checked = false;
  });
}

let navs = ["aboutConferenceNav", "scientificBoardNav", "organiserNav", "partnersNav", "aboutUsInMediaNav", "contactNav"];

for (const nav of navs) {
  document.getElementById(nav).addEventListener("click", function () {
    navItemScrool(this);
  });
}

function smoothScrollTo(topPos) {
  window.scrollTo({
    top: topPos,
    behavior: 'smooth',
  })
}

function navItemScrool(item) {
  let navHeight = document.querySelector("header").offsetHeight;
  let target = item.dataset.targetId;
  let elementPosition = document.getElementById(target).offsetTop;
  smoothScrollTo(elementPosition - navHeight);
}

function checkHrefMatching() {
  let currentHref = window.location.href;
  if (currentHref.includes("#")) {
    let choosedSection = currentHref.substring(currentHref.indexOf("#"), currentHref.length); //Fragment of href with # and the rest of the link e.g. "#o-nas"
    for (let anchor of navAnchors) {
      if (anchor.hash == choosedSection) {
        navItemScrool(anchor);
      }
    }
  }
}

window.addEventListener("load", function(){
  checkHrefMatching();
});

document.getElementById("takeMeUpNav").addEventListener("click", function () {
  smoothScrollTo(0);
});

window.addEventListener("scroll", function() {
  if (window.scrollY > 200) document.getElementById("takeMeUpNav").style.opacity = 1;
  else document.getElementById("takeMeUpNav").style.opacity = 0;
})

document.getElementById("hideWarning").addEventListener("click", function() {
  document.getElementById("warning").style.opacity = 0;
})

