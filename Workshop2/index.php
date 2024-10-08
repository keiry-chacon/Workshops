
<?php
  $nombre   = @$_REQUEST['name'];
  $apellido = @$_REQUEST['lastname'];
  $telefono = @$_REQUEST['telefono'];
  $correo   = @$_REQUEST['correo'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Datos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #6a82fb, #fc5c7d);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      margin: 0;
    }
    .form-container {
      background: white;
      padding: 3rem;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      width: 90%;
      max-width: 600px;
    }
    .form-group label {
      font-weight: bold;
      font-size: 2.1rem;
    }
    .form-control {
      font-size: 2.1rem;
      margin-bottom: 1.5rem;
      width: 100%;
      
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: background-color 0.3s;
      font-size: 2rem;
      
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    h2 {
      margin-bottom: 1.5rem;
      font-size: 2rem;
      text-align: center;
      color: #333;
    }
  </style>
</head>
<body>
<form action="save.php" method="POST">
  <div class="form-group">
    <label for="">Datos Personales</label>
    <input type="text" class="form-control" name="nombre"   id="" value="<?php echo $nombre;   ?>"  placeholder="Nombre">
    <input type="text" class="form-control" name="apellido" id="" value="<?php echo $apellido; ?>"  placeholder="Apellido">
    <input type="text" class="form-control" name="telefono" id="" value="<?php echo $telefono; ?>"  placeholder="Télefono">
    <input type="text" class="form-control" name="correo"   id="" value="<?php echo $correo;   ?>"  placeholder="Correo Electronico">

  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
</body>
</html>