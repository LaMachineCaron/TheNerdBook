/**
 * Cette fonction permet d'ouvrir le menu si fermer et
 * de fermer si le menu était ouvert.
 */
function toggle_menu() {
    if ($('#contenu_page').hasClass('col-sm-9')){
        $('#contenu_page')
            .addClass('col-sm-12')
            .removeClass('col-sm-9');
        $('#bouton').text("Ouvrir menu");
    }else{
        $('#contenu_page')
            .addClass('col-sm-9')
            .removeClass('col-sm-12');
        $('#bouton').text("Fermer menu");
    }
}

/**
 * Ce code s'execute lorsque la page est prête à executé du code.
 *
 * Ce code consiste à ajouter une action lorsque l'on appuie sur le bouton
 */
$(document).ready(function() {
    $('[data-toggle=offcanvas]').click(function() {
        $('#sidebar').toggleClass('collapse').toggleClass('active');
        toggle_menu();
        /* Afin de retirer le focus sur le bouton apr�s le click */
        document.getElementById('bouton').blur();
    });
});

/**
 * Ce code s'execute lorsque la page est prete à executé du code.
 *
 * Permet d'avoir le menu fermer, puisque la page est faite
 * pour l'avoir ouvert au début.
 *
 */
$(document).ready(function() {
    toggle_menu();
});