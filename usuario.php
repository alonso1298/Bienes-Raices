<?php

// Importar la conexión
require __DIR__ . '/includes/config/database.php';
$db = conectarDB();

// Crear un Emai y Password
$email = 'correo@correo.com';
$password = '123456';


// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$password}') ";

echo $query;

// Agregarlo a la Base de Datos 
mysqli_query($db, $query);