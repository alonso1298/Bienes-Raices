<?php

    require '../../includes/app.php'; 

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    $db = conectarDB();

    // Se crea nueva instancia sin pasarle valores ya que la propiedad por defecto tiene los valores vacios
    $propiedad = new Propiedad;

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta);

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
            $resultado = $propiedad->guardar();

            // Mensaje de exito o error
            if($resultado) {

                // redireccionar al usuario
                header('Location: /admin?resultado=1'); // Esta funcion sirve para redireccionar al usuario, solo sirve si no hay nada de html previo y se recomienda usarlo poco
                // Para mostrar mensajes en otra pantalla se utiliza el query string con un signo ? seguido de llaves y valores, para registrar mas de un valor es con & y seguido del valor, ejmplo: Location: /admin?mensaje=Registrado Correctamente&registrado=1
            }
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