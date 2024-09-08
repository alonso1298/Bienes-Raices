<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>

    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-header" src="build/img/logo.svg" alt="Logotipo de Bienes Rices">
                </a>
                
                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>

            </div> <!--Cierre de la barra-->

        </div>
    </header>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="imege/webp">
            <source srcset="build/img/destacada2.jpg" type="imege/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>01/09/2024</span> por <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, temporibus modi iste eligendi suscipit animi vero quas eaque dolorum magni fuga labore laboriosam porro similique distinctio molestiae, exercitationem voluptatibus repellat? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta enim corrupti voluptatem ipsa culpa saepe dolor et nesciunt ut obcaecati inventore ab, eius nostrum assumenda commodi reprehenderit veritatis rerum repellat! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit aut provident, laboriosam veniam, temporibus eaque nihil delectus harum deleniti minima asperiores deserunt minus voluptates ipsam totam aliquam, error debitis est?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque modi dicta voluptatem rerum doloremque earum, neque reprehenderit non quae ex aspernatur ducimus, odio illo expedita repellendus architecto debitis nostrum praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus harum, dicta ipsa ex distinctio beatae magni incidunt unde nam ullam perferendis tempore hic asperiores rerum! Animi vitae necessitatibus rem ducimus.</p>
        </div>
    </main>

    <?php include 'includes/footer.php' ?>
    
    <script src="build/js/bundle.min.js"></script>
</body>
</html>