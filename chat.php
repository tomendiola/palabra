<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    // Función para obtener la IP real del cliente y expandir IPv6
    function obtenerIpReal() {
        // Si hay un proxy, obtener la IP real del cliente
        if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        // Si la IP es IPv6, expandirla a su formato completo
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $ip = expandirIPv6($ip);
        }

        return $ip;
    }

    // Función para expandir una dirección IPv6
    function expandirIPv6($ip) {
        $hex = unpack("H*hex", inet_pton($ip));
        return substr(preg_replace("/([A-f0-9]{4})/", "$1:", $hex["hex"]), 0, -1);
    }

    $ip = obtenerIpReal(); // Obtener la IP del cliente

    // Mostrar la IP en la consola del servidor
    error_log("IP del cliente: " . $ip);

    if (!empty($mensaje)) {
        // Formato: [Hora] IP: Mensaje
        $ip = file_get_contents("https://api64.ipify.org");

        $linea = "[" . date("H:i") . "] " . $ip . ": " . $mensaje . "\n";
        
        // Guardar el mensaje en el archivo chat.txt
        $archivo = "chat.txt";
        file_put_contents($archivo, $linea, FILE_APPEND);
    }
}
?>