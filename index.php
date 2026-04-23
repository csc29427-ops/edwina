<?php
$conn = new mysqli("localhost", "root", "123456", "test");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // ❌ SQL Injection
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "Bienvenido " . $usuario;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<form method="POST">
    Usuario: <input type="text" name="usuario"><br><br>
    Contraseña: <input type="password" name="password"><br><br>
    <input type="submit" value="Ingresar">
</form>

<?php
// ❌ XSS
if (isset($_GET['mensaje'])) {
    echo "<p>" . $_GET['mensaje'] . "</p>";
}

// ❌ Credenciales expuestas
$admin_password = "admin123";
?>

</body>
</html>
