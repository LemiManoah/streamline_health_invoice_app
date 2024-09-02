<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
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
            <h1>Verify Your Email</h1>
        </div>
        <div class="content">
            <p>Hello {{ $client->name }},</p>
            <p>Thank you for registering. Please click the button below to verify your email address:</p>
            <a href="{{ $verificationUrl }}" class="button">Verify Email</a>
            <p>If you did not create an account, no further action is required.</p>
        </div>
        <div class="footer">
            <p>Thank you for using our service!</p>
        </div>
    </div>
</body>
</html>
