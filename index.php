<?php require "config.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login Seguro</title>

<!-- Bootstrap para diseño -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Fondo con degradado */
body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    height: 100vh;
}
</style>

</head>
<body class="d-flex justify-content-center align-items-center">

<!-- Tarjeta de login -->
<div class="card p-4 shadow-lg" style="width: 350px;">
    
    <h3 class="text-center mb-3">🔐 Login</h3>

    <form method="POST" action="login.php">
        
        <!-- Token CSRF oculto -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <!-- Campo usuario -->
        <div class="mb-3">
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        </div>

        <!-- Campo contraseña -->
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>

        <!-- Botón -->
        <button class="btn btn-primary w-100">Entrar</button>
    </form>

</div>

</body>
</html>