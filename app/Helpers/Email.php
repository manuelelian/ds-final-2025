<?php
namespace App\Helpers;

class Email {
    private $host;
    private $port;
    private $username;
    private $password;
    private $from;
    private $fromName;

    public function __construct() {
        $this->host = SMTP_HOST;
        $this->port = SMTP_PORT;
        $this->username = SMTP_USER;
        $this->password = SMTP_PASS;
        $this->from = SMTP_FROM;
        $this->fromName = SMTP_FROM_NAME;
    }

    public function enviarEmail($para, $asunto, $mensaje) {
        $headers = array(
            'From: ' . $this->fromName . ' <' . $this->from . '>',
            'Reply-To: ' . $this->from,
            'X-Mailer: PHP/' . phpversion(),
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8'
        );

        $smtp_conn = fsockopen($this->host, $this->port, $errno, $errstr, 30);
        if (!$smtp_conn) return false;

        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "STARTTLS\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        stream_socket_enable_crypto($smtp_conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        
        fwrite($smtp_conn, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "AUTH LOGIN\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, base64_encode($this->username) . "\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, base64_encode($this->password) . "\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "MAIL FROM:<" . $this->from . ">\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "RCPT TO:<" . $para . ">\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "DATA\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        $headers = implode("\r\n", $headers);
        $mensaje = wordwrap($mensaje, 70);
        
        fwrite($smtp_conn, "Subject: " . $asunto . "\r\n" . $headers . "\r\n\r\n" . $mensaje . "\r\n.\r\n");
        $this->getSmtpResponse($smtp_conn);
        
        fwrite($smtp_conn, "QUIT\r\n");
        fclose($smtp_conn);
        
        return true;
    }

    private function getSmtpResponse($conn) {
        $resp = '';
        while ($str = fgets($conn, 515)) {
            $resp .= $str;
            if (substr($str, 3, 1) == ' ') break;
        }
        return $resp;
    }

    public function crearMensajeBienvenida($nombre, $email) {
        return "
        <html>
        <head>
            <title>Bienvenido al Sistema</title>
        </head>
        <body>
            <h1>¡Bienvenido/a {$nombre}!</h1>
            <p>Has sido registrado exitosamente en nuestro sistema.</p>
            <p>Tus datos de registro son:</p>
            <ul>
                <li>Nombre: {$nombre}</li>
                <li>Email: {$email}</li>
            </ul>
            <p>Gracias por registrarte.</p>
        </body>
        </html>";
    }
}