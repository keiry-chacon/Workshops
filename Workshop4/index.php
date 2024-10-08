<?php
  include('Utils/functions.php');
  $error_msg = isset($_GET['error']) ? $_GET['error'] : '';
  
?>
<?php require('Inc/header.php')?>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="display-4">Login</h1>
      <p class="lead">User Login</p>
      <hr class="my-4">
    </div>
    <form method="post" action="Actions/login.php">
     
      <div class="form-group">
        <label for="user">User</label>
        <input id="username" class="form-control" type="text" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary"> Login </button>
    </form>
    <a href="registration.php" class="btn btn-primary">Registred</a>

  </div>
<?php require('Inc/footer.php');