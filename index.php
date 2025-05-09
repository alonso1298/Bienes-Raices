<?php
    require 'includes/app.php'; // Requiere es mas efectivo cuando importamos funciones, codigo, etc.. 
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nostros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio ipsa, eligendi eum accusantium error a totam doloribus sunt earum soluta dolorem nihil similique, qui magni ea quaerat dicta. Ipssam, quidem!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio ipsa, eligendi eum accusantium error a totam doloribus sunt earum soluta dolorem nihil similique, qui magni ea quaerat dicta. Ipssam, quidem!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Timpo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio ipsa, eligendi eum accusantium error a totam doloribus sunt earum soluta dolorem nihil similique, qui magni ea quaerat dicta. Ipssam, quidem!</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php
            include 'includes/templates/anuncios.php';
         ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llenea el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog"> <!--Cada entrada de blog tiene que estar colocado en un article-->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>26/08/2024</span> por: <span>Admin</span> </p>

                        <p>
                            Consejos para contruir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog"> <!--Cada entrada de blog tiene que estar colocado en un article-->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Gia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/02/2024</span> por: <span>Admin</span> </p>

                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                        </p>
                    </a>
                </div>
            </article>
        </section>
        
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote> <!--Generalmente las citas se ponen en las etiquetas blockquote-->
                    El personal se conporto de una excelente forma, my buena atención y la casa que me ofrecieron cumple con todas mis expectativas. 
                </blockquote>
                <p>- Alonso Sagrero</p>
            </div>
        </section>
    </div>

<?php
    incluirTemplate('footer'); 
?>