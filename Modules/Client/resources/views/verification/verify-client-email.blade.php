<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        /* Tailwind CSS Integration */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
        * {
            font-family: 'Inter', sans-serif;
        }
        .btn {
            @apply bg-blue-600 text-white px-4 py-2 rounded-md no-underline hover:bg-blue-700;
        }
        .header, .footer {
            @apply bg-gray-800 text-white text-center py-4;
        }
    </style>
</head>
<body style="background-color: #f3f4f6; padding: 0; margin: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <tr class="header">
            <td>
                <h1 style="margin: 0; font-size: 24px;">Treamline health</h1>
            </td>
        </tr>
        <!-- Main Content -->
        <tr>
            <td style="padding: 24px; text-align: left;">
                <h2 style="font-size: 20px; color: #111827;">Verify Your Email Address</h2>
                <p style="color: #4b5563;">Hello,</p>
                <p style="color: #4b5563;">
                    Thank you for creating an account with us. To complete your registration, please verify your email address by clicking the button below.
                </p>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ 'client.verify' }}" class="btn">Verify Email</a>
                </div>
                <p style="color: #4b5563; margin-top: 20px;">
                    If you did not create an account, no further action is required.
                </p>
                <p style="color: #4b5563;">
                    Best Regards,<br>
                    The Team at Streamline Health
                </p>
            </td>
        </tr>
        <!-- Footer -->
        <tr class="footer">
            <td>
                <p style="margin: 0; font-size: 14px; color: #9ca3af;">&copy; {{ date('Y') }}. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
