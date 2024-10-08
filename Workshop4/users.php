<?php
  include('Utils/functions.php');
  $error_msg = isset($_GET['error']) ? $_GET['error'] : '';

  // Obtener todos los usuarios desde la base de datos
  $users = getAllUsers(); 

?>

<?php require('Inc/header.php')?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="navId">
    <li class="nav-item">
      <a href="Actions/logout.php" class="nav-link active">Logout</a>
    </li>

    
    
  </ul>
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
          <th>Password</th>
          <th>Province</th>
          <th>State</th>
          <th>Actions</th> 
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
              echo "<td>" . "" . "</td>";
              echo "<td>" . $user['Provincia'] . "</td>";
              echo "<td>" . $user['Estado'] . "</td>";
               // Botones para editar y eliminar
          echo "<td>
          <a href='edit.php?id=" . $user['Id'] . "' class='btn btn-warning'>Edit</a>
          <a href='Utils/processDelete.php?id=" . $user['Id'] . "' class='btn btn-danger'>Delete</a>
        </td>";
  echo "</tr>";

              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
  <?php require('Inc/footer.php');
