document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById('submitBtn');
    if (btn) {
        btn.addEventListener('click', function () {
            const text = btn.querySelector('.text');
            const spinner = btn.querySelector('.spinner');

            if (text && spinner) {
                text.style.display = 'none';
                spinner.style.display = 'inline-block';
            }
        });

          btn.disabled = true;
    }
});
