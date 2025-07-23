<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <style>
   *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    padding: 0;
  }

  .container {
    width: 100%;
    max-width: 640px;
    margin: auto;
  }

  @media only screen and (max-width: 600px) {
    .container {
      padding: 12px;
    }

    .button {
      width: 100%;
      display: block;
    }
  }
  </style>
</head>
<body style="margin: 0; padding: 0; background-color: #F1F2F785; font-family: 'Poppins', sans-serif; color: #1f2937; font-size: 12px;">

  <div class="container" style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 2px; overflow: hidden;">

    <!-- Header -->
    <div style="background: #6873A678; padding: 16px;">
      <img src="https://www.octoverse.com.mm/img/octoverse-logo.b3bc9d3f.png" alt="Merchant Logo" style="width: 96px;" />
    </div>

    <!-- Sub-header -->
    <div style="background-color: rgb(216, 46, 46); padding: 8px 16px;">
      <span style="color: #e5e7eb; font-size: 10px;">Octoverse Gateway Security</span>
    </div>

    <!-- Message Body -->
    <div style="padding: 16px;">
      <p><strong>Hi {{ $user->name ?? 'User' }};</strong></p>
      <p>Someone has requested to change your password.</p>
      <p>Please click the button below to reset your password now.</p>

      <!-- Button -->
      <div style="text-align: center; margin: 24px 0;">
        <a href="{{ $url }}" target="_blank"
           class="button"
           style="display: inline-block; background-color: #234AF8; color: white; padding: 12px 24px; border-radius: 4px; text-decoration: none;">
          <strong>Reset Password</strong>
        </a>
      </div>

      <p>If you didn’t make this request, please ignore this email.</p>
      <p>When opting for a password change, make sure to use a strong and unique password that is difficult to guess.</p>
      <p>Please note that your password will not change unless you click the button above to create a new one. The link will expire in one day. If your link has expired, you can always request <strong>another one</strong>.</p>
      <p>If you have any questions or need assistance, our team is ready to help you. Please feel free to contact us, and we will be glad to provide you with the necessary support.</p>

      <p style="margin-top: 24px;">Thanks,<br>The PMO Team </p>
    </div>

    <!-- Footer -->
    <hr style="border-top: 1px dotted #9ca3af; margin: 0 16px;" />
    <div class="" style="background-color: #D9D9D94F;">
        <div style="text-align: center; font-size: 12px; color: #6b7280; padding: 12px;">
            <a href="https://facebook.com" target="_blank" style="margin: 0 8px;">
  <svg width="16" height="16" fill="#747579" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
    <path d="M279.14 288l14.22-92.66h-88.91V129.26c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0C141.09 0 89.09 54.42 89.09 153.33V195.3H0v92.7h89.09V512h107.83V288z"/>
  </svg>
</a>

<a href="viber://chat?number=%2B1234567890" target="_blank" style="margin: 0 8px;">
  <svg width="16" height="16" fill="#747579" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path d="M346.5 258.3c-2.8-1.4-16.6-8.2-19.2-9.1s-4.5-1.4-6.4 1.4-7.3 9.1-8.9 11s-3.3 2.1-6.1.7c-16.6-8.3-27.4-14.8-38.5-33.4-2.9-5 2.9-4.6 8.3-15.3.9-1.9.5-3.5-.2-4.9s-6.4-15.4-8.8-21.1c-2.3-5.5-4.7-4.7-6.4-4.8h-5.5c-1.8 0-4.6.7-7 3.5s-9.2 9-9.2 22.1 9.4 25.6 10.7 27.4c1.4 1.8 18.6 28.4 45.2 39.8 26.6 11.4 26.6 7.6 31.4 7.1 4.8-.5 15.2-6.2 17.3-12.2 2.1-6 2.1-11.1 1.5-12.2-.7-1.1-2.5-1.7-5.3-3.2zM224 0C100.3 0 0 100.3 0 224c0 49.7 14.6 96 39.6 134.6L0 512l158.2-41.5c38.2 21 82.2 33.1 129.8 33.1 123.7 0 224-100.3 224-224S347.7 0 224 0z"/>
  </svg>
</a>

<a href="https://teams.microsoft.com" target="_blank" style="margin: 0 8px;">
  <svg width="16" height="16" fill="#747579" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path d="M318.7 32h-213C79 32 64 47 64 66.7V256h64v-96h128v96h64V66.7c0-19.6-15-34.7-34.3-34.7zM0 320v61.3c0 19.6 15 34.7 34.3 34.7h379.4c19.3 0 34.3-15.1 34.3-34.7V320H0z"/>
  </svg>
</a>

<a href="https://linkedin.com" target="_blank" style="margin: 0 8px;">
  <svg width="16" height="16" fill="#747579" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path d="M100.28 448H7.4V148.9h92.88zm-46.44-341C24.21 107 0 82.77 0 52.89a52.89 52.89 0 01105.78 0c0 29.88-24.22 54.11-52.94 54.11zM447.9 448h-92.68V302.4c0-34.7-12.43-58.4-43.53-58.4-23.74 0-37.88 16-44.1 31.4-2.28 5.5-2.85 13.1-2.85 20.8V448h-92.7s1.25-268.4 0-296.9h92.7v42c12.3-19 34.3-46 83.5-46 60.9 0 106.6 39.8 106.6 125.3V448z"/>
  </svg>
</a>
       <div class="" style="padding: 8px;">
        <p style="text-align: center; font-size: 10px; color: #747579;">Copyright © 2025 by Octoverse</p>
        <p style="text-align: center; font-size: 10px; color: #747579;">All right reserved.</p>
    </div>
    </div>

    </div>
  </div>

</body>
</html>
