 function validateImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File too large',
                    text: 'Maximum allowed size is 2MB',
                });
                event.target.value = "";
                return;
            }
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid format',
                    text: 'Only JPG and PNG are allowed',
                });
                event.target.value = "";
                return;
            }

            const img = new Image();
            img.onload = function() {
                if (img.width !== 300 || img.height !== 300) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid dimensions',
                        text: 'Image must be exactly 300 x 300 pixels',
                    });
                    event.target.value = "";
                } else {
                    document.getElementById('output').src = URL.createObjectURL(file);
                }
            };
            img.src = URL.createObjectURL(file);
        }


