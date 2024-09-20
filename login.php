<?php
    require 'includes/config/database.php';
    $db = conectarDB();

    // Autenticar el usuario
    $errores = [];
    // Para leer los resultados de post
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        // Filtrar para ve si es un email valido
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = 'El email es obligatorio o no es válido';
        }
        if(!$password) {
            $errores[] = 'El password es obligatorio o no es válido';
        }

        if(empty($errores)) {
            
        }

        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';
    }

    // Inclye el header
    require 'includes/funciones.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset> <!--Grupo de campos-->
                <legend>Email y Password</legend> <!--Explica lo que es ese campo-->

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email" required> <!-- Required hace que el navegador requiera los campos y aplique el filtro de correo en el front-->

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer'); 
?>