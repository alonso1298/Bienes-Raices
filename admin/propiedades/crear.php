<?php
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mendajes de errores
    $errores = [];

    // Se inicializan las variables vacias para despues en el REQUEST_METHOD asignarles un valor
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedores_id = '';

    // echo '<pre>';
    // var_dump($_SERVER['REQUEST_METHOD']); // Nos permite leer los valores del servidor
    // echo '</pre>';

    // Ejecutar el código después que el usuario envia el formulario 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo '<pre>';
        // var_dump($_POST); // Nos permite leer los valores del formulario
        // echo '</pre>';

        // $numero = '1HOLA';
        // $numero2 = 'hola';

        // // Sanitizar 
        // $resultado = filter_var($numero, FILTER_SANITIZE_NUMBER_INT); // Solo mantiene los enteros 

        // // Validar
        // $resultado = filter_var($numero2, FILTER_VALIDATE_INT);

        var_dump($resultado);

        $titulo = mysqli_real_escape_string($bd, $_POST['titulo'] );
        $precio = mysqli_real_escape_string($bd, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string($bd, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string($bd, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string($bd, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string($bd, $_POST['estacionamiento'] );
        $vendedores_id = mysqli_real_escape_string($bd, $_POST['vendedores_id'] );

        if(!$titulo) { // !$titulo significa que si no hay titulo o si esta vacío 
            $errores[] = "Debes añadir un titulo"; // Detecta que $errores es un arreglo y la sintaxias va agregarlo en el arreglo
        }
        if(!$precio) { 
            $errores[] = "Debes añadir un precio"; 
        }
        if(strlen( $descripcion ) < 50 || strlen( $descripcion ) > 255 ) { // Validamos que la descripción tenga al menos 50 caracteres y maximo 500 caracteres
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

        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';

        // Revisar que el arreglo de errores este vacio

        if(empty($errores)) { // Empty revisa que un arreglo este vacío 

            // Insertar en la Base de Datos
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id ) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id' ) ";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // redireccionar al usuario

                header('Location: /admin'); // Esta funcion sirve para redireccionar al usuario, solo sirve si no hay nada de html previo y se recomienda usarlo poco
            }
        }

    }

    require '../../includes/funciones.php'; 
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

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>"> <!--Name permite leer lo que el usuario escriba-->
            
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento"  name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="">-- Seleccione --</option>
                // Se le ponen los : para cerrar con ; y no con {}
                <?php while( $vendedor = mysqli_fetch_assoc($resultado) ) : ?> 
                    <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']; ?> </option>
                <?php endwhile; ?>
                <!-- Selected es para poner un valor por default, entonces si vendedores_id tiene el mismo id que vendedor se le agrega el atributo de selected -->
            </select>
        </fieldset>

        <input type="submit" value="Crear Popiedad" class="boton boton-verde">

        </form>
    </main>

<?php
    incluirTemplate('footer'); 
?>