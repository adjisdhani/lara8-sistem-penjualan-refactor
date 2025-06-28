import ClipboardJS from 'clipboard';

document.addEventListener("DOMContentLoaded", function () {
    const clipboard = new ClipboardJS('.btn-copy');

    clipboard.on('success', function (e) {
        console.log('Copied:', e.text);
        e.clearSelection();
    });

    clipboard.on('error', function (e) {
        console.error('Copy failed:', e);
    });
});
