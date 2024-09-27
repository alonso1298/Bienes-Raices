<?php
    require 'includes/app.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote> <!--Se utiliza cuando estamos citando-->
                    25 Años De Experiencia
                </blockquote>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus numquam nobis temporibus delectus eum unde quas cumque minus, nisi facilis, repudiandae totam praesentium quia officia, illo error excepturi expedita dolorum. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit, quod dolore consectetur molestias, quo ipsam ipsum repellendus dolorum eveniet error adipisci sit ducimus quaerat? Sit beatae ex sunt minima debitis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat laudantium in odio dicta, alias provident reiciendis officia! Rerum a, reiciendis animi cupiditate id ex expedita! Placeat, saepe? Facere, vel maiores. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas alias, quaerat soluta doloribus reprehenderit qui ea assumenda odio sint aliquid fuga consectetur nulla minima amet inventore! Neque molestias voluptas consequuntur.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut quod, officiis obcaecati quis ex distinctio ipsum natus consectetur doloribus accusantium assumenda aliquid voluptatibus hic odit voluptas, consequatur temporibus eius reprehenderit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, excepturi ipsum eligendi quod laboriosam necessitatibus error. Nesciunt, odio. Suscipit minus provident ex laudantium minima consectetur facere at a voluptatum enim?</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>

<?php
    incluirTemplate('footer'); 
?>