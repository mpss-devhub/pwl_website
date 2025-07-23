document.addEventListener('contextmenu', (e) => {
    e.preventDefault();
});

// Disable DevTools shortcuts
document.addEventListener('keydown', (e) => {
    // F12
    if (e.keyCode === 123) {
        e.preventDefault();
    }

    // Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U, Ctrl+S
    if (
        (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) || // I or J
        (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83)) // U or S
    ) {
        e.preventDefault();
    }

    // Ctrl+Shift+C (element inspector)
    if (e.ctrlKey && e.shiftKey && e.keyCode === 67) {
        e.preventDefault();
    }
});

// Disable Copy, Cut, Paste, Text Selection
['copy', 'cut', 'paste', 'selectstart'].forEach(evt =>
    document.addEventListener(evt, e => e.preventDefault())
);

// Disable dragging images/text
document.addEventListener('dragstart', (e) => {
    e.preventDefault();
});
