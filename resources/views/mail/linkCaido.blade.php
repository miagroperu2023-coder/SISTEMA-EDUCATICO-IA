<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Link Caído - Aviso para los Administradores!</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f1eff1e0; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 20px;">
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" width="150" height="150"
                                style="display: block;">
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: rgba(255,255,255,0.842); border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                            <h1 style="color: #1a1f71; margin-top: 0;">Cod-Lección: {{ $lesson->id }}</h1>
                            <p style="font-size: 18px; margin: 5px 0;">Nombre de la lección: {{ $lesson->name }}</p>
                            <p style="font-size: 18px; margin: 5px 0;">Nombre de la sección: {{ $section->name }}</p>
                            <p style="font-size: 18px; margin: 5px 0;">Nombre del Curso: {{ $course->title }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: rgba(255,255,255,0.842); border-radius: 10px; padding: 20px;">
                            <h2 style="color: #1a1f71; font-size: 20px; margin-top: 0;">Soporte</h2>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 5px;">
                                    <a href="https://www.linkedin.com/in/anthony-eduardo-nu%C3%B1ez-canchari-05b1371a0/"
                                        target="_blank" style="color: #1a1f71; text-decoration: none;">
                                        +51 924 080 517
                                    </a>
                                </li>
                                <li style="margin-bottom: 5px; color: #26c942;">eduperuapp@gmail.com</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
