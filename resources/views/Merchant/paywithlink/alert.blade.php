

@if (session('success') && session('SMS') && session('link_url'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Payment SMS Sent!',
            text: 'SMS Has Been Sent',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (session('success') && session('Email') && session('link_url'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Payment Email Sent!',
            text: 'Email has Been Sent',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (session('success') && session('Copy') && session('link_url'))

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const linkUrl = @json(session('link_url'));

        Swal.fire({
            title: 'Payment Link Created',
            html: `
                <p>This is your payment link:</p>
                <p style="margin: 15px 0; font-family: monospace; word-break: break-all;">${linkUrl}</p>
            `,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            showDenyButton: true,
            denyButtonText: 'Copy',
            denyButtonColor: '#3085d6',
            focusConfirm: false,
            willOpen: () => {
                document.querySelector('.swal2-deny').addEventListener('click', function() {
                    navigator.clipboard.writeText(linkUrl).then(() => {
                        const copyBtn = document.querySelector('.swal2-deny');
                        copyBtn.textContent = 'Copied!';
                        setTimeout(() => {
                            copyBtn.textContent = 'Copy';
                        }, 1000);
                    });
                });
            }
        });
    });
</script>
@endif



@if (session('success') && session('QR') && session('link_url'))
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const linkUrl = @json(session('link_url'));

            QRCode.toDataURL(linkUrl, {
                width: 180,
                margin: 1
            }, function(err, url) {
                if (err) {
                    console.error(err);
                    return;
                }

                Swal.fire({
                    title: 'Payment QR Created',
                    html: `
                        <div style="text-align: center;">
                            <img src="${url}" alt="QR Code" style="margin: 0 auto 15px; display: block;"/>
                            <div style="margin-bottom: 10px; font-size: 14px; color: #545454;">
                                Scan this QR code to complete payment
                            </div>
                        </div>
                    `,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    showDenyButton: true,
                    denyButtonText: 'Download QR',
                    denyButtonColor: '#3085d6',
                    focusConfirm: false,
                    width: 360,
                    willOpen: () => {
                        document.querySelector('.swal2-deny').addEventListener('click', function() {
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'payment-qr.png';
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                        });
                    }
                });
            });
        });
    </script>
@endif
