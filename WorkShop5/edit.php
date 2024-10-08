<?php
include('Utils/functions.php');
$provincias = getProvinces();
// Verificar si se recibió el ID en la URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Obtener la información del usuario
    $useredit = getID($userId); 

    if (empty( $useredit)) {
        echo "User not found";
        exit;
    }
} else {
    echo "No user ID provided";
    exit;
}
?>

<?php require('Inc/header.php'); ?>

<div class="container">
    <h2>Edit User</h2>
    <form method="POST" action="Utils/processEdit.php">  <!-- Se envía a otro archivo -->
        <input type="hidden" name="id" value="<?php echo  $useredit ['Id']; ?>">
     
        <div class="form-group">
            <label for="nombre">First Name:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo  $useredit ['Nombre']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido">Last Name:</label>
            <input type="text" name="apellido" id="apellido" value="<?php echo  $useredit['Apellido']; ?>" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="usuario">Username:</label>
            <input type="text" name="usuario" id="usuario" value="<?php echo  $useredit['Usuario']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="contrasena">Password</label>
        <input id="contrasena" class="form-control" type="password" name="contrasena" >
      </div>
        <div class="form-group">
            < <label for="provincia">Province:</label>
            <select name="provincia" id="provincia" class="form-control" required>
                  <?php
                  foreach($provincias as $id => $province) {
                    $selected = ($id == $useredit['Id_Provincia']) ? 'selected' : '';
                    echo "<option value=\"$id\" $selected>$province</option>";                    
                  }
                 
                 
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php require('Inc/footer.php'); ?>
