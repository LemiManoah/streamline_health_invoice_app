<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #eeeeee;
        }
        .header h1 {
            color: #333333;
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin: 20px 0;
            color: #555555;
            line-height: 1.6;
        }
        .content p {
            margin: 0 0 16px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #eeeeee;
            color: #888888;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="content">
            <p>{{ $body }}</p>

            <p>Thank you for registering with us! Please verify your email address by clicking the button below:</p>
        </div>
        <div class="footer">
            <a href="{{ $verificationUrl }}" class="button">Verify Your Email</a>
            <p>If you did not create an account, no further action is required.</p>
            <p>Thank you!</p>
        </div>
    </div>
</body>
</html>
