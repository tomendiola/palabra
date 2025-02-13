<?php
$archivo = "chat.txt";

if (file_exists($archivo)) {
    // Leer el archivo y mostrar su contenido
    echo nl2br(file_get_contents($archivo));
} else {
    echo "No hay mensajes aún.";
}
?>
