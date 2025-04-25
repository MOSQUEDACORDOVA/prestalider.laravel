<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Prestalider</title>
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
            width: 40%;
            min-width: 600px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 48px;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
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
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.4);
            transition: transform 0.5s ease;
        }

        .logo-circle:hover {
            transform: scale(1.05) rotate(15deg);
        }

        .logo-circle i {
            font-size: 48px;
            color: white;
        }

        .logo-section h1 {
            color: var(--dark);
            font-size: 28px;
            font-weight: 700;
            margin-top: 16px;
            letter-spacing: -0.5px;
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
            padding: 18px 24px;
            border: none;
            background: rgba(245, 246, 250, 0.8);
            border-radius: 12px;
            font-size: 16px;
            color: var(--dark);
            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.05),
                0 5px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            padding-left: 52px;
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
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: all 0.3s;
        }

        .input-field:focus+.input-icon {
            color: var(--primary);
        }

        .input-label {
            position: absolute;
            left: 52px;
            top: 18px;
            color: #777;
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .input-field:focus~.input-label,
        .input-field:not(:placeholder-shown)~.input-label {
            top: -10px;
            left: 52px;
            font-size: 12px;
            background: white;
            padding: 0 8px;
            color: var(--primary);
            font-weight: 500;
        }

        .utility-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .remember-me input {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ddd;
            border-radius: 4px;
            margin-right: 8px;
            position: relative;
            transition: all 0.2s;
            cursor: pointer;
        }

        .remember-me input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .remember-me input:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            color: white;
            font-size: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .forgot-password a {
            color: #777;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
            cursor: pointer;
        }

        .forgot-password a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 18px;
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

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #999;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #ddd, transparent);
        }

        .divider::before {
            margin-right: 16px;
        }

        .divider::after {
            margin-left: 16px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-bottom: 30px;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            color: white;
            font-size: 20px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: translateX(-100%);
            transition: 0.5s;
        }

        .social-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .social-btn:hover::before {
            transform: translateX(100%);
        }

        .social-btn.google {
            background: linear-gradient(45deg, #4285F4, #34A853);
        }

        .social-btn.facebook {
            background: linear-gradient(45deg, #3b5998, #4267B2);
        }

        .social-btn.apple {
            background: linear-gradient(45deg, #000000, #333333);
        }

        .register-link {
            text-align: center;
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
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

        /* Efecto de partículas */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* Animaciones */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .logo-circle {
            animation: float 4s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .login-card {
                padding: 36px 24px;
            }

            .logo-circle {
                width: 80px;
                height: 80px;
            }

            .logo-circle i {
                font-size: 36px;
            }

            .input-field {
                padding: 16px 20px 16px 48px;
            }
        }

        /* Efecto de error/success */
        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        .input-group.error .input-field {
            box-shadow: 0 0 0 2px rgba(214, 48, 49, 0.2);
        }

        .input-group.error .input-icon {
            color: var(--error);
        }

        .input-group.error .error-message {
            display: block;
        }

        .input-group.success .input-field {
            box-shadow: 0 0 0 2px rgba(0, 184, 148, 0.2);
        }

        .input-group.success .input-icon {
            color: var(--success);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-content">
            <div class="logo-section">
                <div class="logo-circle">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h1>Acceso PrestaLider</h1>
                <p>Ingresa a tu cuenta para continuar</p>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="email" id="email" class="input-field" name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>
                    <i class="fas fa-envelope input-icon"></i>
                    <label for="email" class="input-label">Correo electrónico</label>
                    @error('email')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="password" id="password" class="input-field" name="password" required
                        autocomplete="current-password" minlength="6">
                    <i class="fas fa-lock input-icon"></i>
                    <label for="password" class="input-label">Contraseña</label>
                    @error('password')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="utility-section">
                    <label class="remember-me">
                        <input  type="checkbox" name="remember" id="remember">
                        <span>Recordar sesión</span>
                    </label>
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <button type="submit" class="login-button">
                    <span>Iniciar Sesión</span>
                </button>
            </form>

            <br>
            <div class="register-link">
                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate ahora</a></p>
            </div>
        </div>
    </div>


</body>

</html>
