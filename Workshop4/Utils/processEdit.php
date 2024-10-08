<?php
include('functions.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = [
    'Id' => $_REQUEST['id'],
    'Nombre' => $_REQUEST['nombre'],
    'Apellido' => $_REQUEST['apellido'],
    'Estado' => 1,
    'Usuario' => $_REQUEST['usuario'],
    'Contrasena' => $_REQUEST['contrasena'], // Asegúrate de que la contraseña se maneje de manera segura
    'Id_Provincia' => $_REQUEST['provincia'],
];
 
  
    // Llamar a la función para actualizar el usuario
    $updated = updateUser($user);

    // Redirigir a la lista de usuarios si se actualizó correctamente
    if ($updated) {
        header("Location: ../users.php?success=User updated successfully");
        exit;
    } else {
        // Si hubo un error, mostrar mensaje o redirigir con un mensaje de error
        header("Location: ../edit.php?id=$userId&error=Error updating user");
        exit;
    }
} else {
    // Si no se envió el formulario correctamente, redirigir con error
    header("Location: /users.php?error=Invalid request");
    exit;
}
