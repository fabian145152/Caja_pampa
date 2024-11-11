<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de pantalla de un formulario</title>
    <!-- Incluye html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>
    <h2>Formulario de ejemplo</h2>
    <form id="formulario">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <br><br>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo">
        <br><br>
        <!-- Botón para capturar la pantalla -->
        <button type="button" onclick="capturarPantalla()">Capturar Pantalla</button>
    </form>
    <br>
    <!-- Donde se mostrará la captura de pantalla -->
    <div id="resultado"></div>






    <script>
        function capturarPantalla() {
            // Selecciona el formulario por su ID
            const formulario = document.getElementById('formulario');

            // Usa html2canvas para capturar el formulario
            html2canvas(formulario).then(canvas => {
                // Muestra la imagen en el div 'resultado'
                document.getElementById('resultado').appendChild(canvas);

                // Para descargar la imagen, descomenta las siguientes líneas:
                let link = document.createElement('a');
                link.download = 'captura.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }
    </script>
    
</body>

</html>