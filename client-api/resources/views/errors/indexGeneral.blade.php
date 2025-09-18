<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error del Servidor</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fce4e4;
            color: #721c24;
            text-align: center;
            padding: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            font-size: 6rem;
            color: #e3342f;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        a {
            background-color: #e3342f;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #cc1f1a;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('img/denied.png') }}" alt="500" class="error-image">
        <h1>Ups!</h1>
        <h2>Algo salió mal</h2>
        <a href="javascript:history.back()">Volver atrás</a>
    </div>
</body>
</html>
