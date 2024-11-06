<fieldset>
            <legend>Información General</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php
            echo s( $vendedor->nombre ); ?>"> <!--Name permite leer lo que el usuario escriba-->
</fieldset>