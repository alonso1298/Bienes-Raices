<?php

namespace App;

class Propiedad {

    // Base de datos 
    protected static $db; // Si creamos una propiedad estatico el metodo tiene que se estatico también
    
    public $id;
    public $titulo;
    public $precio;
    public $descripcion;
    public $imagen;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function guardar() {
        // Insertar en la Base de Datos
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id ) VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id' ) ";

        $resultado = self::$db->query($query);

        debuguear($resultado);
    }

    //Definir la conexión a la base de datos
    public static function setDB($database) {
        self::$db = $database; // Accedemos con self a las propiedades estaticas
    }
}