<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Voucher</title>
</head>

<body
    style="margin: 0; padding: 20px; background-color: #F1F2F785; font-family: 'Libre Baskerville', serif; color: #1f2937; font-size: 14px;">
    <div
        style="max-width: 640px; margin: auto; background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px;">

        <!-- Logo -->
        <div style="text-align: right;">
            <img src="https://www.octoverse.com.mm/img/octoverse-logo.b3bc9d3f.png" alt="Merchant Logo"
                style="width: 96px;" />
        </div>
        <hr style="border-top: 1px dotted #9ca3af; margin-top: 16px; margin-bottom: 16px;" />

        <!-- Merchant Info -->
        <p style="margin-top: 24px; line-height: 1.6; color: #374151;">
            This email was sent from
            <strong>{{ $details['merchant_name'] }}</strong>
            and Payment Link will expire at
            <strong>{{ $details['expired_at'] }}</strong>.
        </p>

        <div style="margin-bottom: 16px;">
            <div style="display: flex; gap: 12px;">
                <strong>Email</strong><span>:</span><span>{{ $details['merchant_Cemail'] }}</span>
            </div>
            <div style="display: flex; gap: 12px;">
                <strong>Address</strong><span>:</span><span>{{ $details['merchant_address'] }}</span>
            </div>
        </div>

        <!-- Customer Info -->
        <div style="margin-top: 10px;">
            <h3 style="text-align: center; font-weight: 500; color: #374151; margin-bottom: 4px;">Customer Info</h3>
            <hr style="border-top: 1px solid #e5e7eb; width: 66%; margin: 4px auto;" />
            <div style="line-height: 1.8; ">
                <div style="display: flex; gap: 15px;">
                    <strong>Name</strong><span>:</span><span>{{ $content[3] }}</span>
                </div>
                <div style="display: flex; gap: 15px;">
                    <strong>Invoice No</strong><span>:</span><span>{{ $content[0] }}</span>
                </div>
                <div style="display: flex; gap: 15px;">
                    <strong>Amount</strong><span>:</span><span>{{ $content[1] }} {{ $content[2] }}</span>
                </div>
                <div style="display: flex; gap: 15px;">
                    <strong>Remark</strong><span>:</span><span>{{ $details['remark'] ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Pay Now Button -->
        <div style="text-align: center; margin-top: 24px;">
            <a href="{{ $content[4] }}"
                style="display: inline-block; background-color: #637AE2; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none;">
                Pay Now
            </a>
        </div>

        <!-- Footer -->
        <hr style="border-top: 1px dotted #9ca3af; margin-top: 32px; margin-bottom: 12px;" />
        <div style="text-align: center; font-size: 12px; color: #6b7280;">
            Powered by
            <a href="https://octoverse.com.mm" style="color: #8a9adb; text-decoration: none;">Octoverse.com.mm</a>
        </div>
    </div>
</body>

</html>
