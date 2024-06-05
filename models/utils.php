<?php

namespace models;

use \PDO;
use \PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Utils
{

    public static function conectar()
    {
        global $DB_SERVER, $DB_SCHEMA, $DB_USER, $DB_PASSWD;

        $conPDO = null;
        try {
            require_once("../config/global.php");
            $conPDO = new PDO("mysql:host=" . $DB_SERVER . ";dbname=" . $DB_SCHEMA, $DB_USER, $DB_PASSWD);
            $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conPDO;
        } catch (PDOException $e) {
            print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
            return null;
        }
    }

    public static function limpiar_datos($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function generar_salt($tam)
    {
        $letras = "abcdefghijklmnopqrstuvwxyz1234567890*-.,";

        $salt = "";
        for ($i = 0; $i < $tam; $i++) {
            $salt .= $letras[rand(0, strlen($letras) - 1)];
        }

        return $salt;
    }

    public static function generar_codigo_activacion()
    {
        return rand(1111, 9999);
    }

    public static function enviarCorreoActivacion($email, $codigoActivacion)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';

        try {
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Activación de cuenta';
            $mail->Body = "Hola,<br><br>Para activar tu cuenta, utiliza el siguiente código de activación: " . $codigoActivacion . "<br><br>Haz clic <a href='http://localhost/temploWargames/views/activate_account.php?email=" . $email . "'>aquí</a> para activar tu cuenta.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }



    public static function enviarCambiarPass($email)
    {
        require_once("../vendor/autoload.php");
        require_once("../config/email_config.php");

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = $HOST;
            $mail->SMTPAuth = true;
            $mail->Username = $SMTP_USER;
            $mail->Password = $SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $SMTP_PORT;

            // Recipients
            $mail->setFrom($SMTP_EMAIL, $SMTP_NAME);
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Cambio de contraseña';
            $mail->Body = "Hola,<br><br>Para cambiar tu contraseña, haz clic en el siguiente enlace: <a href='http://localhost/temploWargames/controllers/Auth_Controller.php?action=showChangePassword&email=" . $email . "'>Cambiar Contraseña</a>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }
}
