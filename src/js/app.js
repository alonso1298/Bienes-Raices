document.addEventListener('DOMContentLoaded', function(){

    eventListeners(); //En cuanto este cargado el documento va a cargar esta función 
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive) //Para que se ejecute la funcion basta con solo nombrar la funcion 
}

function navegacionResponsive() {
    console.log('Desde navegacion responsive');
}