<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenido a EduPeruapp</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f1eff1e0; margin: 0; padding: 20px;">
    <div
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 20px;">

        <!-- Logo redondo -->
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('img/logo/logo.png') }}" alt="Logo"
                style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
        </div>

        <!-- Bienvenida -->
        <div style="background-color: #ffffffd6; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
            <h1 style="color: #1a1f71; font-size: 24px; margin-top: 0;">{{ $user->name }}</h1>
            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                ¡Correo registrado en nuestra base de datos, <strong>{{ $user->email }}</strong>!
            </p>
            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                Nos llena de alegría que hayas decidido unirte a nuestra plataforma en línea. Continúa tu viaje de
                aprendizaje y avanza a través de las lecciones. Estamos emocionados de ser parte de tu camino hacia
                el conocimiento y el crecimiento.
            </p>
            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                Si en algún momento tienes preguntas o necesitas asistencia, no dudes en ponerte en contacto con
                nosotros a través del correo electrónico <strong>eduperuapp@gmail.com</strong>.
            </p>
            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                ¡Bienvenido y que disfrutes de tu experiencia educativa con nosotros!
            </p>
        </div>

        <!-- Soporte -->
        <div style="background-color: #ffffffd6; border-radius: 10px; padding: 20px;">
            <h2 style="color: #1a1f71; font-size: 20px; margin-top: 0;">Soporte</h2>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 10px; font-size: 16px;">
                    <a href="https://www.linkedin.com/in/anthony-eduardo-nu%C3%B1ez-canchari-05b1371a0/" target="_blank"
                        style="color: #1a1f71; text-decoration: none;">
                        +51 924 080 517 (LinkedIn)
                    </a>
                </li>
                <li style="font-size: 16px; color: #333;">
                    📧 eduperuapp@gmail.com
                </li>
            </ul>
        </div>

    </div>
</body>

</html>
