<?php

namespace App;

class Propiedad {

    // Base de datos 
    protected static $db; // Si creamos una propiedad estatico el metodo tiene que se estatico también
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    // Errores
    protected static $errores = [];
    
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

    //Definir la conexión a la base de datos
    public static function setDB($database) {
        self::$db = $database; // Accedemos con self a las propiedades estaticas
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? 1;
    }

    public function guardar() {

        // Sanitizar la entrada de los datos 
        $atributos = $this->sanitizarAtributos(); // Para mandar llamar un método dentro de otro método es con this 

        // Insertar en la Base de Datos
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos)); // Join crea un nuevo string a partir de un arreglo toma dos valores el primero es el separador y el segundo el arreglo
        $query .= " ) VALUES (' ";  
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    // Identificar y unir los atributos de la base de datos 
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue; // continue hace que cuando de cumpla la condicion ignora y se va a la siguiente elemento del foreach
            $atributos[$columna] = $this->$columna; // Se le pone el signo de $ despues del this ya que es una variable del foreach
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen){
        // Elimina la imagen previa
        if($this->id) {
            // Comprobar si existe el archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo) {
                // Si existe el archivo se elimina con Unlink
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Validacion
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        
        if(!$this->titulo) { // !$titulo significa que si no hay titulo o si esta vacío 
            self::$errores[] = "Debes añadir un titulo"; // Detecta que $errores es un arreglo y la sintaxias va agregarlo en el arreglo
        }
        if(!$this->precio) { 
            self::$errores[] = "Debes añadir un precio"; 
        }
        if(strlen( $this->descripcion ) < 50 || strlen( $this->descripcion ) > 500 ) { // Validamos que la descripción tenga al menos 50 caracteres y maximo 500 caracteres
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones) { 
            self::$errores[] = "El número de habitaciones es obligatorio"; 
        }
        if(!$this->wc) { 
            self::$errores[] = "El número de baños es obligatorio"; 
        }
        if(!$this->estacionamiento) { 
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio"; 
        }
        if(!$this->vendedores_id) { 
            self::$errores[] = "Elige un vendedor"; 
        }

        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    // Lista todos los registros
    public static function all() {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
 
    // Busca un registro por su ID
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); // array_shift nos retorna el primer elemento de un arreglo
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria 
        $resultado->free();

        // Retornar los resultados 
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)) { // property_exists verifica si que propiedad exista ya sea key o titulo
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria por los cambios realizados por el usuario
    public function sincronizar( $args = [] ){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)) { // This es el objeto actual y si no esta nullo el valor sigue siendo el del value
                $this->$key = $value;
            } 
        }
    }
}