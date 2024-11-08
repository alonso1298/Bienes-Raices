<?php

    require '../includes/app.php'; 
    estaAutenticado();

    // Importar las clases
    use App\Propiedad;
    use App\Vendedor;

    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; // El paceholder ?? null busca el valor $_GET['resultado'] y si no existe le asigna null }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validar id
        //Se hace de esta manera porque ese id no va a existir hata que se haga el REQUEST_METHOD ya que de lo contrario nos daria un error de undefined
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)){
                
                // Compara lo que vamos a eliminar
                if($tipo === 'vendedor') {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } else if($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }

    // Incluye un template
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php
            $mensaje = mostrarNotificacion( intval($resultado) ); // intval lo convierte en entero
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php } 
        ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) Vendedor</a>

        <h2>Propiedades</h2>

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
                <?php foreach( $propiedades as $propiedad ): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <!--Se crea un input que no se vea que contenga toda la informacion de la propiedad-->
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Télefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- 4- Mostrar los Resultados -->
                <?php foreach( $vendedores as $vendedor ): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </main>

<?php
    incluirTemplate('footer'); 
?>