<?php

    require '../../includes/app.php'; 

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    // Se crea nueva instancia sin pasarle valores ya que la propiedad por defecto tiene los valores vacios
    $propiedad = new Propiedad;

    // Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el código después que el usuario envia el formulario 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        /** Crea una nueva instancia **/
        $propiedad = new Propiedad($_POST['propiedad']);

        /** SUBIDA DE ARCHIVOS **/

        // Generar un nombre unico a la imagen
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        // Setear la imagen
        if($_FILES['propiedad']['tmp_name']['imagen']){
            // Realiza un resize a la imagen con intervetion
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validar();

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) { // Empty revisa que un arreglo este vacío

            // Crear la carpeta
            if(!is_dir(CARPETA_IMAGENES)){ //La función is_dir retorna si una carpeta existe o no existe
                    mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de datos
            $propiedad->guardar();
        }

    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" Especifica cómo los datos del formulario deben ser codificados antes de ser enviados al servidor-->

        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear Popiedad" class="boton boton-verde">

        </form>
    </main>

<?php
    incluirTemplate('footer'); 
?>