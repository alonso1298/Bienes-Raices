<?php
    session_start();

    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';

    $auth = $_SESSION['login'];

    if(!$auth) {
        header('Location: /');
    }

    // echo('<pre>');
    // var_dump($_POST);
    // echo('</pre>');

    // 1- Importar la conexión a la BD 
    require '../includes/config/database.php';
    $db = conectarDB();

    // 2- Exscribir el Query
    $query = "SELECT * FROM propiedades";

    // 3- Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    // // Para leer el mendaje de crear php se accede mediante GET
    // echo '<pre>';
    // var_dump($_GET['mensaje']);
    // echo '</pre>';
    // exit; 

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; // El paceholder ?? null busca el valor $_GET['resultado'] y si no existe le asigna null }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Se hace de esta manera porque ese id no va a existir hata que se haga el REQUEST_METHOD ya que de lo contrario nos daria un error de undefined
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            //Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = {$id}";

            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            //Eliminar la propiedad 
            $query = "DELETE FROM propiedades WHERE id = {$id}";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('location: /admin?resultado=3');
            }
        }
    }

    // Incluye un template
    require '../includes/funciones.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif( intval($resultado) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif( intval($resultado) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>   
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imgen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- 4- Mostrar los Resultados -->
                <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td><?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">

                            <!--Se crea un input que no se vea que contenga toda la informacion de la propiedad-->
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </main>

<?php

    // 5- Opcional, cerrar la conexión 
    mysqli_close($db);

    incluirTemplate('footer'); 
?>