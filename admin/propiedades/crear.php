<?php
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Arreglo con mendajes de errores
    $errores = [];

    // echo '<pre>';
    // var_dump($_SERVER['REQUEST_METHOD']); // Nos permite leer los valores del servidor
    // echo '</pre>';

    // Ejecutar el código después que el usuario envia el formulario 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo '<pre>';
        // var_dump($_POST); // Nos permite leer los valores del formulario
        // echo '</pre>';

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedores_id = $_POST['vendedores_id'];

        if(!$titulo) { // !$titulo significa que si no hay titulo o si esta vacío 
            $errores[] = "Debes añadir un titulo"; // Detecta que $errores es un arreglo y la sintaxias va agregarlo en el arreglo
        }
        if(!$precio) { 
            $errores[] = "Debes añadir un titulo"; 
        }
        if(!$descripcion) { 
            $errores[] = "La descripción es obligatoria"; 
        }
        if(!$habitaciones) { 
            $errores[] = "Debes añadir un titulo"; 
        }
        if(!$wc) { 
            $errores[] = "Debes añadir un titulo"; 
        }
        if(!$estacionamiento) { 
            $errores[] = "Debes añadir un titulo"; 
        }
        if(!$vendedores) { 
            $errores[] = "Debes añadir un titulo"; 
        }

            echo '<pre>';
            var_dump($errores);
            echo '</pre>';

        exit;

        // Insertar en la Base de Datos
        $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id ) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id' ) ";

        // echo $query;

        $resultado = mysqli_query($db, $query);

        if($resultado) {
            echo 'Insertado Correctamente';
        }

    }

    require '../../includes/funciones.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad"> <!--Name permite leer lo que el usuario escriba-->
            
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento"  name="estacionamiento" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="1">Alonso</option>
                <option value="2">Karen</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Popiedad" class="boton boton-verde">

        </form>
    </main>

<?php
    incluirTemplate('footer'); 
?>