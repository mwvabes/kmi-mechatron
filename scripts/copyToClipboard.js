window.Clipboard = (function (window, document, navigator) {
    var textArea,
        copy;

    function isOS() {
        return navigator.userAgent.match('/ipad/iphone/i');
    }

    function createTextArea(text) {
        textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
    }

    function selectText() {
        var range,
            selection;

        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }

    function copyToClipBoard() {
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }

    copy = function (text) {
        createTextArea(text);
        selectText();
        copyToClipBoard();
    };

    return {
        copy: copy
    };

})(window, document, navigator)


document.getElementById("copyEmailMlodziKonkurs").addEventListener("click", function () {
    Clipboard.copy('mlodzikonkurs@urz.pl');
});

document.getElementById("copyEmailMlodziKonferencja").addEventListener("click", function () {
    Clipboard.copy('mlodzikonferencja@urz.pl');
});