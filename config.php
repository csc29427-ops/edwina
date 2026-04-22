<?php
// Inicia la sesión para manejar datos del usuario
session_start();

// Configuración de seguridad para cookies de sesión
ini_set('session.cookie_httponly', 1); // Evita acceso desde JavaScript (protección XSS)
ini_set('session.use_only_cookies', 1); // Obliga a usar cookies (no URL)

// Datos de conexión a la base de datos
$host = "localhost";
$db = "login_seguro";
$user = "root";
$pass = "123";

try {
    // Crear conexión usando PDO (más seguro que mysqli)
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    // Configurar errores como excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Registrar error sin mostrar detalles sensibles
    error_log($e->getMessage());
    die("Error de conexión");
}

// Generar token CSRF si no existe
if (empty($_SESSION['csrf_token'])) {
    // random_bytes genera un token seguro
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>