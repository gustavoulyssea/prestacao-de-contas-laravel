<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resetar senha em meteorologia.net.br</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="message">
        <p>Recebemos um pedido de reset de senha com seu email.</p>
        <p>Se você não fez esta solicitação desconsidere este email.</p>
        <p>Para resetar sua senha por favor clique no link abaixo:</p>
        <p></p>
        <p><a href="{{url('form-reset-password/' . $mailData['reset_hash'])}}">Resetar senha</a></p>
        <p></p>
        <p>Ou copie o link e abra numa janela do navegador:</p>
        <p>{{url('form-reset-password/' . $mailData['reset_hash'])}}</p>
        <p></p>
        <p>Atenciosamente,</p>
        <p>Equipe de suporte - meteorologia.net.br</p>
    </div>

</div>
</body>

</html>
