<?php
include('functions.php');

// Verificar si el ID del usuario está presente en la solicitud GET
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Obtener la información del usuario
    $userdelete = getID($userId);
    $userdelete['Estado'] = 0;

   
    // Llamar a la función para actualizar el usuario cambiando el estado a 0 (eliminar)
    $updated = updateUser($userdelete);

    // Redirigir a la lista de usuarios si se actualizó correctamente
    if ($updated) {
        header("Location: ../users.php?success=User deleted successfully");
        exit;
    } else {
        // Si hubo un error, redirigir con un mensaje de error
        header("Location: ../users.php?error=Error deleting user");
        exit;
    }

} else {
    // Redirigir si no se proporcionó un ID de usuario
    header("Location: ../users.php?error=Invalid request");
    exit;
}
