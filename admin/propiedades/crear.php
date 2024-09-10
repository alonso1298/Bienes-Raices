<?php
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // echo '<pre>';
    // var_dump($_SERVER['REQUEST_METHOD']); // Nos permite leer los valores del servidor
    // echo '</pre>';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo '<pre>';
        // var_dump($_POST); // Nos permite leer los valores del formulario
        // echo '</pre>';

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
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
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">
            
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ej: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select>
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