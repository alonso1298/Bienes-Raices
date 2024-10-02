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
    $errores = [];

    // Se inicializan las variables vacias para despues en el REQUEST_METHOD asignarles un valor
    $titulo = $propiedad->titulo;
    $precio = $propiedad->precio;
    $descripcion = $propiedad->descripcion;
    $habitaciones = $propiedad->habitaciones;
    $wc = $propiedad->wc;
    $estacionamiento = $propiedad->estacionamiento;
    $vendedores_id = $propiedad->vendedores_id;
    $imagenPropiedad = $propiedad->imagen;


    // Ejecutar el código después que el usuario envia el formulario 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo '<pre>';
        //     var_dump($_POST);
        // echo '</pre>';

        $titulo = mysqli_real_escape_string($db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string($db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string($db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] );
        $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id'] );
        $creado = date('Y/m/d');

        // Asignar files hacia una variable 
        $imagen = $_FILES['imagen'];

        // var_dump($imagen['name']); // En caso de que ese valor exista es que el usuario si subio una imagen

        if(!$titulo) { // !$titulo significa que si no hay titulo o si esta vacío 
            $errores[] = "Debes añadir un titulo"; // Detecta que $errores es un arreglo y la sintaxias va agregarlo en el arreglo
        }
        if(!$precio) { 
            $errores[] = "Debes añadir un precio"; 
        }
        if(strlen( $descripcion ) < 50 || strlen( $descripcion ) > 500 ) { // Validamos que la descripción tenga al menos 50 caracteres y maximo 500 caracteres
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones) { 
            $errores[] = "El número de habitaciones es obligatorio"; 
        }
        if(!$wc) { 
            $errores[] = "El número de baños es obligatorio"; 
        }
        if(!$estacionamiento) { 
            $errores[] = "El número de lugares de estacionamiento es obligatorio"; 
        }
        if(!$vendedores_id) { 
            $errores[] = "Elige un vendedor"; 
        }

        // Validar por tamaño (1 Mb máximo)
        $medida = 1000 * 1000;
        if ($imagen['size'] > $medida){
            $errores[] = "La imagen es muy grande";
        }

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