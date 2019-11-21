const navItems = document.querySelectorAll("nav > ul > li");

// hiding menu after click item
for (const item of navItems) {
    item.addEventListener("click", function () {
        document.getElementById("navToggle").checked = false;
    });
}

document.getElementById("scientificBoardNav").addEventListener("click", function () {
    navItemScrool(this);
});

document.getElementById("organiserNav").addEventListener("click", function () {
    navItemScrool(this);
});

document.getElementById("partnersNav").addEventListener("click", function () {
    navItemScrool(this);
});

document.getElementById("aboutUsInMediaNav").addEventListener("click", function () {
    navItemScrool(this);
});

document.getElementById("contactNav").addEventListener("click", function () {
    navItemScrool(this);
});

function smoothScrollTo(topPos) {
    window.scrollTo({
        top: topPos,
        behavior: 'smooth',
    })
}

function navItemScrool(item) {
    var navHeight = document.querySelector("header").offsetHeight;
    var target = item.dataset.targetId
    var elementPosition = document.getElementById(target).offsetTop;
    smoothScrollTo(elementPosition - navHeight);
}