document.addEventListener('contextmenu', (e) => {
    e.preventDefault();
});

document.addEventListener('keydown', (e) => {

    if (e.keyCode === 123) {
        e.preventDefault();
    }
    if (
        (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) || // I or J
        (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83)) // U or S
    ) {
        e.preventDefault();
    }

    if (e.ctrlKey && e.shiftKey && e.keyCode === 67) {
        e.preventDefault();
    }
});

['copy', 'cut', 'paste', 'selectstart'].forEach(evt =>
    document.addEventListener(evt, e => e.preventDefault())
);

document.addEventListener('dragstart', (e) => {
    e.preventDefault();
});
