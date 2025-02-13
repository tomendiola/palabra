document.addEventListener('DOMContentLoaded', function () {
    const botonEnviar = document.getElementById('enviarPalabra');

    if (botonEnviar) {
        botonEnviar.addEventListener('click', function (event) {
            event.preventDefault();

            const palabra = document.getElementById('palabra').value.trim();
            const resultadoDiv = document.getElementById('resultado');

            if (!palabra) {
                resultadoDiv.className = "alert alert-danger mt-3";
                resultadoDiv.textContent = "Por favor, ingrese una palabra.";
                resultadoDiv.classList.remove("d-none");
                return;
            }

            fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ palabra: palabra })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    resultadoDiv.className = "alert alert-danger mt-3";
                    resultadoDiv.textContent = `Error: ${data.error}`;
                } else {
                    resultadoDiv.className = "alert alert-success mt-3";
                    resultadoDiv.innerHTML = `<strong>Palabra:</strong> ${data.palabra} <br> 
                                              <strong>Letras:</strong> ${data.cantidad_letras}`;
                }
                resultadoDiv.classList.remove("d-none");
            })
            .catch(error => {
                resultadoDiv.className = "alert alert-warning mt-3";
                resultadoDiv.textContent = "Hubo un error al procesar la solicitud.";
                resultadoDiv.classList.remove("d-none");
            });
        });
    }
});
