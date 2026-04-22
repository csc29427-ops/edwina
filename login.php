<?php
require "config.php"; // Importa conexión y configuración

// Inicializa contador de intentos si no existe
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

// Si supera el límite de intentos, bloquea acceso
if ($_SESSION['intentos'] >= 5) {
    die("Demasiados intentos. Intenta más tarde.");
}

// Verifica que el formulario fue enviado por método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validar token CSRF para evitar ataques
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Token inválido");
    }

    // Sanitiza el usuario (elimina caracteres peligrosos)
    $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);

    // Obtiene la contraseña sin modificar (se valida después)
    $password = $_POST["password"];

    // Verifica que no estén vacíos
    if (!empty($usuario) && !empty($password)) {

        // Consulta preparada para evitar SQL Injection
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $conn->prepare($sql);

        // Asocia el parámetro :usuario con la variable
        $stmt->bindParam(":usuario", $usuario);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene el usuario de la base de datos
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica contraseña encriptada
        if ($user && password_verify($password, $user["password"])) {

            // Regenera ID de sesión (evita secuestro de sesión)
            session_regenerate_id(true);

            // Guarda usuario en sesión
            $_SESSION["usuario"] = $user["usuario"];

            // Reinicia intentos fallidos
            $_SESSION['intentos'] = 0;

            // Redirige al dashboard
            header("Location: dashboard.php");
            exit();

        } else {
            // Aumenta intentos fallidos
            $_SESSION['intentos']++;

            echo "Credenciales incorrectas";
        }

    } else {
        echo "Campos obligatorios";
    }
}
?>