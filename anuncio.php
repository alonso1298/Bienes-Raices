<?php
    require 'includes/funciones.php'; 
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="imege/webp">
            <source srcset="build/img/destacada.jpg" type="imege/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, temporibus modi iste eligendi suscipit animi vero quas eaque dolorum magni fuga labore laboriosam porro similique distinctio molestiae, exercitationem voluptatibus repellat? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta enim corrupti voluptatem ipsa culpa saepe dolor et nesciunt ut obcaecati inventore ab, eius nostrum assumenda commodi reprehenderit veritatis rerum repellat! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit aut provident, laboriosam veniam, temporibus eaque nihil delectus harum deleniti minima asperiores deserunt minus voluptates ipsam totam aliquam, error debitis est?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque modi dicta voluptatem rerum doloremque earum, neque reprehenderit non quae ex aspernatur ducimus, odio illo expedita repellendus architecto debitis nostrum praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus harum, dicta ipsa ex distinctio beatae magni incidunt unde nam ullam perferendis tempore hic asperiores rerum! Animi vitae necessitatibus rem ducimus.</p>
        </div>
    </main>

<?php
    incluirTemplate('header'); 
?>