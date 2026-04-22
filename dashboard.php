<?php
require "config.php";

// Verifica si el usuario inició sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<!-- htmlspecialchars evita XSS -->
<h2>Bienvenido <?php echo htmlspecialchars($_SESSION["usuario"]); ?> 😎</h2>

<a href="logout.php">Cerrar sesión</a>

</body>
</html>