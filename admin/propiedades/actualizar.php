<?php

use App\Propiedad;

require '../../includes/app.php'; 

    estaAutenticado();

    // Validar por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin'); // Si el id no es un entero nos redirecciona al admin
    }

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el código después que el usuario envia el formulario 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        // Se agregan los errores
        $errores = $propiedad->validar();

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) { // Empty revisa que un arreglo este vacío

            // Crear carpeta
            $carpetaImages = '../../imagenes/';

            if(!is_dir($carpetaImages)){ //La función is_dir retorna si una carpeta existe o no existe
                mkdir($carpetaImages);
            }

            $nombreImagen = '';

            /** SUBIDA DE ARCHIVOS **/

            if($imagen['name']){

                // Eliminar la imagen previa
                unlink($carpetaImages . $propiedad['imagen']); // unlink() Funcion destinada para eliminar archivos 

                // Generar un nombre unico a la imagen
                $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

                // Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImages . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }

            // Insertar en la Base de Datos
            $query = " UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedores_id = {$vendedores_id} WHERE id = {$id} ";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {

                // redireccionar al usuario
                header('Location: /admin?resultado=2'); // Esta funcion sirve para redireccionar al usuario, solo sirve si no hay nada de html previo y se recomienda usarlo poco
            }
        }

    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" Especifica cómo los datos del formulario deben ser codificados antes de ser enviados al servidor-->

            <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Actualizar Popiedad" class="boton boton-verde">

        </form>
    </main>

<?php
    incluirTemplate('footer'); 
?>