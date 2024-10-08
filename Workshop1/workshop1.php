<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reloj Digital PHP</title>
  <style>
    /* Estilo general */
    body {
      font-family: 'Courier New', monospace;
      background-color: #000;
      color: #fff;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Contenedor de reloj */
    .clock-container {
      background-color: #222;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
      text-align: center;
      width: 300px;
    }

    /* Estilo del título */
    h1 {
      font-size: 1.5rem;
      color: #08f7fe;
      margin-bottom: 20px;
      letter-spacing: 1px;
    }

    /* Estilo del párrafo de fecha y hora */
    p {
      font-size: 2rem;
      color: #39ff14;
      margin: 0;
      font-weight: bold;
      letter-spacing: 3px;
    }

    /* Efecto de brillo en el texto */
    p, h1 {
      text-shadow: 0 0 10px #08f7fe, 0 0 20px #08f7fe, 0 0 30px #39ff14;
    }
  </style>
</head>
<body>
  <div class="clock-container">
    <h1>Reloj Digital PHP</h1>
    <p>
      <?php
        date_default_timezone_set('America/Costa_Rica');

        $fechaActual = date("d-m-Y");
        $horaActual = date("h:i:s");

        echo " $fechaActual  $horaActual";
      ?>
    </p>
  </div>
</body>
</html>
