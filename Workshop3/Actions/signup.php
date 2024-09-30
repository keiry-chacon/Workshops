<?php
require '../Utils/functions.php';

if($_POST && $_REQUEST['firstName']) {

  if (saveUser()) {

    header( "Location: ../index.php?success=registered");

  } else {
    header( "Location: ../index.php?error=Invalid user data");
  }
  
}