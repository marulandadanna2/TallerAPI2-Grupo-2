<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 404 - Página no encontrada</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
        }

        .error-image {
            max-width: 250px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 6rem;
            margin-bottom: 10px;
            color: #007bff;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #218838;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 4rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('img/denied.png') }}" alt="404" class="error-image">
        <h1>404</h1>
        <h2>Recurso no encontrado</h2>
        <p>La página que estás buscando no existe o ha sido movida.</p>
        <a href="javascript:history.back()">Volver atrás</a>
    </div>
</body>
</html>
