<?php

    // Validar por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /'); // Si el id no es un entero nos redirecciona al index
    }

    require 'includes/app.php'; 

    $db = conectarDB();

    // Consultar la Base de Datos
    $query = "SELECT * FROM propiedades WHERE id={$id}";

    // Obtener el resultado
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows === 0) { //  Como $resultado nos devuelve un objeto y num_rows nos indica si un id es valido o no, para acceder a el utilizamos la funcion flecha -> y asi podemos leer el resultado $resultado->num_rows
        header('Location /');
    }

    // Obtener todo el contenido del registro y guardar en la variabel $propiedad
    $propiedad = mysqli_fetch_assoc($resultado);
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>

<?php
    mysqli_close($db);

    incluirTemplate('footer'); 
?>