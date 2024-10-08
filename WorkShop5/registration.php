<?php
  include('utils/functions.php');
  $error_msg = isset($_GET['error']) ? $_GET['error'] : '';
  $provinces = getProvinces();
  $error_msg = '';
  if(isset($_GET['error'])) {
    $error_msg = $_GET['error'];
  }
?>
<?php require('Inc/header.php')?>
<body>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="display-4">Signup</h1>
      <p class="lead">This is the signup process</p>
      <hr class="my-4">
    </div>
    <form method="post" action="Actions/signup.php">
      <div class="error">
        <?php echo $error_msg; ?>
      </div>
      <div class="form-group">
        <label for="first-name">First Name</label>
        <input id="first-name" class="form-control" type="text" name="firstName" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name</label>
        <input id="last-name" class="form-control" type="text" name="lastName" required>
      </div>
      <div class="form-group">
        <label for="province">Province</label>
        <select id="province" class="form-control" name="province" required>
          <?php
          foreach($provinces as $id => $province) {
            echo "<option value=\"$id\">$province</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="user">User</label>
        <input id="user" class="form-control" type="text" name="user" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary"> Sign up </button>
    </form>
  </div>
  <div class="container-fluid">
      <!-- Botón para redirigir a users.php -->
  </div>
<?php require('Inc/footer.php');