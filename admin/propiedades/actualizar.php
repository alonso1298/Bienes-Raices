<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

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

        // Validación 
        $errores = $propiedad->validar();

        /* Subida de archivos */

        // Generar un nombre único a la imagen
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        if($_FILES['propiedad']['tmp_name']['imagen']){
            // Realiza un resize a la imagen con intervetion
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) { // Empty revisa que un arreglo este vacío
            // Almacenar la imagen
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            $propiedad->guardar();
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