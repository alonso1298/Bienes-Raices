<?php

    // // Para leer el mendaje de crear php se accede mediante GET
    // echo '<pre>';
    // var_dump($_GET['mensaje']);
    // echo '</pre>';
    // exit; 

    $resultado = $_GET['resultado'] ?? null; // El paceholder ?? null busca el valor $_GET['resultado'] y si no existe le asigna null 
    require '../includes/funciones.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php endif; ?>   
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>

<?php
    incluirTemplate('footer'); 
?>