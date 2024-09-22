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

        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';

        if(empty($errores)) {

            // Revisar si el usuario existe 
            $query = "SELECT * FROM usuarios WHERE email = '{$email}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado->num_rows ){ // Num_rows nos sirve para comprobar que hay resultados en una consulta a la base de datos
                // Revisar si es password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // var_dump($usuario['password']);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                // var_dump($auth);

                if($auth) {
                    // El usuario esta autenticado
                    session_start(); // Se inicia la sesión

                    // Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = 'La contraseña o el usuario son incorrectos';
                }

            }else {
                $errores[] = 'El usuario o contraseña es incorrecto';
            }

        }

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