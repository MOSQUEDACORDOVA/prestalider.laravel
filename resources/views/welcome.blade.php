<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRESTALIDER</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --primary: #7929bb;
            --secondary: #BD6DFF;
            --accent: #f3e8ff;
            --dark: #333;
            --light: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            background-color: var(--light);
            color: var(--dark);
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            overflow-x: hidden;
        }

        .full-height {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Asegura centrado vertical */
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 20px;
            top: 20px;
            z-index: 10;
        }

        .content {
            text-align: center;
            z-index: 2;
            padding: 2rem;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto; /* Asegura centrado horizontal */
        }

        .title {
            font-size: 5rem;
            font-weight: 700;
            letter-spacing: -1px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease-out;
        }

        .subtitle {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 1.2s ease-out;
        }

        .links > a {
            color: var(--light);
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.05rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            background-color: var(--primary);
            box-shadow: 0 4px 6px rgba(121, 41, 187, 0.3);
            display: inline-block;
        }

        .links > a:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(121, 41, 187, 0.4);
        }

        .auth-links > a {
            color: var(--primary);
            margin-left: 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .auth-links > a:hover {
            color: var(--secondary);
            background-color: rgba(121, 41, 187, 0.1);
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            animation: float 15s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 500px;
            height: 500px;
            top: -250px;
            left: -100px;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 400px;
            height: 400px;
            bottom: -200px;
            right: -100px;
            animation-delay: 3s;
        }

        .shape:nth-child(3) {
            width: 300px;
            height: 300px;
            bottom: 30%;
            left: 10%;
            animation-delay: 6s;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 2rem;
            box-shadow: 0 10px 20px rgba(121, 41, 187, 0.3);
            transition: all 0.3s ease;
            animation: fadeInUp 1.4s ease-out;
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(121, 41, 187, 0.4);
        }

        /* Añadimos un resplandor sutil alrededor del título */
        .title-container {
            position: relative;
            display: inline-block;
        }

        .title-container::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(189, 109, 255, 0.2) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: -1;
            filter: blur(20px);
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .title {
                font-size: 3rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }

            .links {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .links > a {
                margin: 0.5rem;
                width: 80%;
                max-width: 250px;
            }

            .top-right {
                position: relative;
                display: flex;
                justify-content: center;
                right: 0;
                top: 0;
                margin: 1rem 0;
            }

            .auth-links > a {
                margin: 0 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="full-height position-ref">
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="top-right auth-links">
            <!-- Mantiene la estructura de autenticación de Laravel -->
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">Mi Cuenta</a>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrarse</a>
                    @endif
                @endauth
            @endif
        </div>

        <div class="flex-center content">
            <div>
                <div class="title-container">
                    <div class="title">
                        PRESTALIDER
                    </div>
                </div>

                <div class="subtitle">
                    Soluciones financieras innovadoras para impulsar tu crecimiento. Préstamos rápidos, seguros y con las mejores condiciones del mercado.
                </div>

                <div class="links">
                    <a href="#servicios">Nuestros Servicios</a>
                    <a href="#nosotros">Sobre Nosotros</a>
                    <a href="#contacto">Contacto</a>
                </div>

                <a href="#solicitar" class="cta-button">Solicitar Préstamo</a>
            </div>
        </div>
    </div>
</body>
</html>
