<?php

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

    // Incluye un template
    require '../includes/funciones.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
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
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton-amarillo-block">Actualizar</a>
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