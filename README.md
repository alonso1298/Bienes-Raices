# 🏡 Bienes Raíces
Este proyecto es una aplicación web completa para la gestión de propiedades inmobiliarias. Implementa un sistema CRUD (Crear, Leer, Actualizar, Eliminar) utilizando Programación Orientada a Objetos (POO) en PHP y una base de datos MySQL en el backend. El frontend está desarrollado con HTML, CSS y JavaScript, proporcionando una interfaz interactiva y responsiva para los usuarios.​
GitHub

![Imagen de la pagina principal](https://github.com/alonso1298/Bienes-Raices/blob/72f098f38620ec5b49e299a51ac35f10ebe859af/src/img/HomeBienesRaices.png)


## 🚀 Características Principales
- Gestión de Propiedades: Permite crear, visualizar, actualizar y eliminar propiedades desde un panel administrativo.

- Autenticación de Usuarios: Sistema de login y logout para proteger las secciones administrativas.

- Carga de Imágenes: Funcionalidad para subir y gestionar imágenes de las propiedades.

- Formulario de Contacto: Los usuarios pueden enviar consultas a través de un formulario de contacto.

- Blog Informativo: Sección de blog para publicar artículos relacionados con bienes raíces.

- Diseño Responsivo: Adaptado para una experiencia óptima en dispositivos móviles y de escritorio.​


## 🛠️ Tecnologías Utilizadas
- Frontend:

    - HTML5

    - CSS3

    - JavaScript

- Backend:

    - PHP con Programación Orientada a Objetos (POO)

    - MySQL para la gestión de la base de datos

- Herramientas de Desarrollo:

    - Composer para la gestión de dependencias

    - Gulp para la automatización de tareas​

# 📁 Estructura del Proyecto

```graphql
Bienes-Raices/
├── admin/                 # Panel administrativo
├── build/                 # Archivos compilados
├── classes/               # Clases PHP para la lógica del negocio
├── includes/              # Archivos reutilizables (headers, footers, etc.)
├── src/                   # Archivos fuente (JS, SCSS)
├── imagenes/              # Imágenes de las propiedades
├── index.php              # Página principal
├── anuncio.php            # Página de detalle de una propiedad
├── anuncios.php           # Listado de propiedades
├── contacto.php           # Página de contacto
├── blog.php               # Página del blog
├── login.php              # Página de inicio de sesión
├── cerrar-sesion.php      # Script para cerrar sesión
├── gulpfile.js            # Configuración de Gulp
├── composer.json          # Configuración de Composer
├── package.json           # Configuración de Node.js
└── README.md              # Documentación del proyecto
```

## 🔧 Instalación y Configuración
1. Clonar el repositorio:

    ```bash
    git clone https://github.com/alonso1298/Bienes-Raices.git
    cd Bienes-Raices
    ```

2. Instalar dependencias de PHP:

    ``` 
    composer install
    ```
3. Instalar dependencias de Node.js:

    ```bash
    npm install
    ```
4. Configurar la base de datos:

- Crear una base de datos en MySQL.

- Importar el archivo bienes_raices.sql (si está disponible) para crear las tablas necesarias.

- Actualizar las credenciales de la base de datos en el archivo de configuración correspondiente.​

5. Compilar archivos SCSS y JS:

    ``` bash
    gulp
    ```
6. Iniciar el servidor local:

- Utilizar un servidor local como XAMPP, WAMP o MAMP para servir el proyecto.

- Asegurarse de que el servidor esté apuntando al directorio del proyecto.​

## 📸 Capturas de Pantalla
** Login **

![Imagen la pagina de inicio de sesión](https://github.com/alonso1298/Bienes-Raices/blob/72f098f38620ec5b49e299a51ac35f10ebe859af/src/img/Login.png)

** Panel de administración ***

![Imagen la pagina de administracion](https://github.com/alonso1298/Bienes-Raices/blob/2ba646fc31f408aa5c9fd080e6550320ae48ac76/src/img/Administrador.png)

## 📄 Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.