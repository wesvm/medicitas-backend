<!DOCTYPE html>
<html lang="es">

<head>
    <title>Restablecer Contraseña</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        main {
            text-align: center;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            color: #333;
            font-size: 24px;
        }

        section {
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
        }

        h2 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        span {
            display: block;
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <main>
        <header>
            <h1>Medicitas - UNAM</h1>
        </header>
        <section>

            <h3>Hola {{ $user->nombres }} {{ $user->apellidos }}</h3>
            <h2>¿OLVIDÓ SU CONTRASEÑA?</h2>
            <p>
                Hay una solicitud de cambio de contraseña!
            </p>
            <span>Se generó el siguiente TOKEN:</span>
            <p>{{$token}}</p>
        </section>
        <footer>
            <span>
                Si no solicitó esta accion, por favor ignore este mensaje.
            </span>
        </footer>
    </main>
</body>

</html>