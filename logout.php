<?php
session_start();

// Destruye toda la sesión
session_destroy();

// Redirige al login
header("Location: index.php");
exit();