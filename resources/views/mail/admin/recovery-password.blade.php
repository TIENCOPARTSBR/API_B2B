<!DOCTYPE html>
<html>
<head>
    <title>Recuperação de Senha - B2B</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2; /* Amarelo */
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
            <h3>Recuperação de Senha</h3>
        </div>
        <div class="message">
            <p>Olá, {{$user->name}}</p>
            <p>Você está recebendo este e-mail porque recebemos uma solicitação de recuperação de senha para a sua conta.</p>
            <p>Utilize esse código para redefinir sua senha: <strong>{{$token}}</strong></p>
            <p>Se você não solicitou a recuperação de senha, ignore este e-mail.</p>
        </div>
    </div>
    <div class="footer">
        <p>Atenciosamente,<br><img src="https://encoparts.com/wp-content/uploads/2023/02/enco-site.png" width="100" alt=""></p>
    </div>
</body>
</html>