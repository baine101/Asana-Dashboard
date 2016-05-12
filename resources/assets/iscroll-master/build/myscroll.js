
var myScroll;

function loaded () {
    myScroll = new IScroll('#wrapper', { scrollX: true, scrollY: false, mouseWheel: true });
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);