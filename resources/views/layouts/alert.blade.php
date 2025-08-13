<!-- Alert Box -->
<div id="alertBox"
    class="fixed top-[-100px] left-1/2 transform -translate-x-1/2 z-50 max-w-xs p-3 rounded shadow-lg cursor-pointer transition-all duration-300 opacity-0"
    onclick="hideAlert()" style="display: none;">
    <p id="alertMessage" class="text-white font-semibold text-center text-xs"></p>
</div>

<script>
    // Show alert on page load if session has Success or Error
    @if (session('Success'))
        document.addEventListener('DOMContentLoaded', function() {
            showAlert(true, "{{ session('Success') }}");
        });
    @elseif (session('Error'))
        document.addEventListener('DOMContentLoaded', function() {
            showAlert(false, "{{ session('Error') }}");
        });
    @endif

    function showAlert(success, message) {
        const alertBox = document.getElementById('alertBox');
        const alertMessage = document.getElementById('alertMessage');

        alertMessage.textContent = message;
        alertBox.style.display = 'block';

        if (success) {
            alertBox.classList.remove('bg-red-600');
            alertBox.classList.add('bg-green-600');
        } else {
            alertBox.classList.remove('bg-green-600');
            alertBox.classList.add('bg-red-600');
        }

        // Animate alert sliding down and fading in
        setTimeout(() => {
            alertBox.style.top = '1rem';
            alertBox.style.opacity = '1';
        }, 10);

        // Auto hide after 3 seconds
        setTimeout(() => {
            hideAlert();
        }, 3000);
    }

    function hideAlert() {
        const alertBox = document.getElementById('alertBox');
        // Slide alert up and fade out
        alertBox.style.top = '-100px';
        alertBox.style.opacity = '0';

        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 300);
    }
</script>
