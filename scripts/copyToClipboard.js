function copyToClipBoard(str) {
    var element = document.createElement('textarea');
    element.value = str;
    document.body.appendChild(element);
    element.select();
    document.execCommand('copy');
    document.body.removeChild(element);
};

document.getElementById("copyEmailMlodziKonkurs").addEventListener("click", function () {
    copyToClipBoard('mlodzikonkurs@urz.pl');
});

document.getElementById("copyEmailMlodziKonferencja").addEventListener("click", function () {
    copyToClipBoard('mlodzikonferencja@urz.pl');
});