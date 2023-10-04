<!DOCTYPE html>
<html>
<head>
    <title>Password Recovery - B2B</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2; /* Yellow */
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: left;
            margin-bottom: 1.5rem;
        }
        .message {
            font-size: 14px;
            margin-bottom: 1.5rem;
        }
        .reset-link {
            display: block;
            padding: 10px 0;
            text-align: center;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 700
        }
        .footer {
            text-align: center;
            padding: 5px 10px;
            color: #444;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">    
            <h3>Password Recovery</h3>
        </div>
        <div class="message">
            <p>Hello, {{$user->name}}</p>
            <p>You are receiving this email because we have received a password recovery request for your account.</p>
            <p>Use this code to reset your password: <strong>{{$token}}</strong></p>
            <p>If you did not request a password recovery, please ignore this email.</p>
        </div>
    </div>
    <div class="footer">
        <p>Best Regards,<br><img src="https://encoparts.com/wp-content/uploads/2023/02/enco-site.png" width="100" alt=""></p>
    </div>
</body>
</html>