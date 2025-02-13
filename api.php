<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datos = json_decode(file_get_contents("php://input"), true);

    if (isset($datos["palabra"])) {
        $palabra = trim($datos["palabra"]);
        $cantidad_letras = mb_strlen($palabra, 'UTF-8'); // Para soportar caracteres especiales

        echo json_encode(["palabra" => $palabra, "cantidad_letras" => $cantidad_letras]);
    } else {
        echo json_encode(["error" => "No se proporcionó una palabra"]);
    }
} else {
    echo json_encode(["error" => "Método de solicitud no válido"]);
}
?>
