
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Prestalider</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #7929bb;
            --secondary: #7929bb;
            --accent: #BD6DFF;
            --dark: #2d3436;
            --light: #f5f6fa;
            --success: #00b894;
            --error: #d63031;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #BD6DFF 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 30px;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .login-card {
                padding: 48px;
            }
        }

        .login-card:hover {
            transform: translateY(-5px) rotateX(2deg) rotateY(2deg);
            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center,
                    rgba(255, 255, 255, 0.4) 0%,
                    rgba(255, 255, 255, 0) 70%);
            transform: rotate(30deg);
            z-index: 1;
            pointer-events: none;
        }

        .login-content {
            position: relative;
            z-index: 2;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.4);
            transition: transform 0.5s ease;
            animation: float 4s ease-in-out infinite;
        }

        @media (min-width: 768px) {
            .logo-circle {
                width: 100px;
                height: 100px;
            }
        }

        .logo-circle:hover {
            transform: scale(1.05) rotate(15deg);
        }

        .logo-circle i {
            font-size: 36px;
            color: white;
        }

        @media (min-width: 768px) {
            .logo-circle i {
                font-size: 48px;
            }
        }

        .logo-section h1 {
            color: var(--dark);
            font-size: 24px;
            font-weight: 700;
            margin-top: 16px;
            letter-spacing: -0.5px;
        }

        @media (min-width: 768px) {
            .logo-section h1 {
                font-size: 28px;
            }
        }

        .logo-section p {
            color: #666;
            font-size: 14px;
            margin-top: 8px;
        }

        .input-group {
            margin-bottom: 28px;
            position: relative;
        }

        .input-field {
            width: 100%;
            padding: 16px 20px;
            border: none;
            background: rgba(245, 246, 250, 0.8);
            border-radius: 12px;
            font-size: 15px;
            color: var(--dark);
            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.05),
                0 5px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            padding-left: 48px;
            /* Placeholder for floating label */
            placeholder: " ";
        }

        @media (min-width: 768px) {
            .input-field {
                padding: 18px 24px;
                padding-left: 52px;
                font-size: 16px;
            }
        }

        .input-field:focus {
            outline: none;
            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.1),
                0 5px 15px rgba(108, 92, 231, 0.2);
            background: white;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: all 0.3s;
        }

        @media (min-width: 768px) {
            .input-icon {
                left: 20px;
            }
        }

        .input-field:focus+.input-icon {
            color: var(--primary);
        }

        .input-label {
            position: absolute;
            left: 48px;
            top: 16px;
            color: #777;
            font-size: 15px;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        @media (min-width: 768px) {
            .input-label {
                left: 52px;
                top: 18px;
                font-size: 16px;
            }
        }

        .input-field:focus~.input-label,
        .input-field:not(:placeholder-shown)~.input-label {
            top: -10px;
            left: 16px;
            font-size: 12px;
            background: white;
            padding: 0 8px;
            color: var(--primary);
            font-weight: 500;
        }

        @media (min-width: 768px) {
            .input-field:focus~.input-label,
            .input-field:not(:placeholder-shown)~.input-label {
                left: 20px;
            }
        }

        .login-button {
            width: 100%;
            padding: 16px;
            border: none;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .login-button {
                padding: 18px;
            }
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: 0.5s;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.6);
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 24px;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Animaciones */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Efecto de error/success */
        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .input-group.error .input-field {
            box-shadow: 0 0 0 2px rgba(214, 48, 49, 0.2);
        }

        .input-group.error .input-icon {
            color: var(--error);
        }

        .input-group.success .input-field {
            box-shadow: 0 0 0 2px rgba(0, 184, 148, 0.2);
        }

        .input-group.success .input-icon {
            color: var(--success);
        }

        /* Status message */
        .status-message {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-message.success {
            background-color: rgba(0, 184, 148, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .status-message.error {
            background-color: rgba(214, 48, 49, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }

        .status-message i {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-content">
            <div class="logo-section">
                <div class="logo-circle">
                    <i class="fas fa-key"></i>
                </div>
                <h1>Recuperar Contraseña</h1>
                <p>Ingresa tu email para recibir instrucciones</p>
            </div>

            @if (session('status'))
                <div class="status-message success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form id="forgotForm" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group @error('email') error @enderror">
                    <input type="email" id="recovery-email" name="email" class="input-field" value="{{ old('email') }}"
                        required autocomplete="email" autofocus placeholder=" ">
                    <i class="fas fa-envelope input-icon"></i>
                    <label for="recovery-email" class="input-label">Correo electrónico</label>
                    @error('email')
                        <span class="error-message" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="login-button">
                    <span>Enviar Instrucciones</span>
                </button>
            </form>
            <div class="register-link">
                <p><a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Volver al inicio de sesión</a></p>
            </div>
        </div>
    </div>
</body>

</html>
