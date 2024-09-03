document.addEventListener('DOMContentLoaded', function(){

    eventListeners(); //En cuanto este cargado el documento va a cargar esta función 
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive); //Para que se ejecute la funcion basta con solo nombrar la funcion 
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    // navegacion.classList.toggle('mostrar'); //Toggle: si tiene la calse la quita y si no la tiene la agrega

    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}