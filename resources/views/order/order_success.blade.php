<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Realizado com Sucesso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            color: #4CAF50;
            font-size: 60px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="success-icon">&#10004;</div>
    <h1>Pedido Realizado com Sucesso!</h1>
    <p>Agradecemos por escolher nossos serviços. Seu pedido foi recebido e está sendo processado.</p>
    <a href="{{ route('home') }}" class="home-button">Voltar para o site</a>
</div>
</body>
</html>
