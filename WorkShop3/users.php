<?php
  include('Utils/functions.php');

  // Obtener todos los usuarios desde la base de datos
  $users = getAllUsers(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users List</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="display-4">Users List</h1>
      <p class="lead">Here is a list of all users in the system</p>
      <hr class="my-4">
    </div>

    <!-- Tabla para mostrar los usuarios -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th>Province</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (!empty($users)) {
            foreach($users as $user) {
              echo "<tr>";
              echo "<td>" . $user['Id'] . "</td>";
              echo "<td>" . $user['Nombre'] . "</td>";
              echo "<td>" . $user['Apellido'] . "</td>";
              echo "<td>" . $user['Usuario'] . "</td>";
              echo "<td>" . $user['Provincia'] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
  <button class="btn btn-primary" onclick="window.location.href='index.php'">Go to Home</button>

</body>

</html>
