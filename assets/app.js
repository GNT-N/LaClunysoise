import './app.scss';

// Chargement de la bibliothèque jQuery
const $ = require('jquery');

// Chargement de la partie JS de bootstrap
require('bootstrap');

// Sélectionne tous les éléments avec la classe 'count'
$('.count').each(function () {
    // Initialise la propriété 'Counter' de chaque élément à 0
    $(this).prop('Counter',0).animate({
        // Animer la propriété 'Counter' jusqu'à la valeur du texte de l'élément
        Counter: $(this).text()
    }, {
        // Définit la durée de l'animation à 4000 millisecondes (4 secondes)
        duration: 2500,
        // Utilise l'effet 'swing' pour l'animation
        easing: 'swing',
        // À chaque étape de l'animation, exécute cette fonction
        step: function (now) {
            // Met à jour le texte de l'élément avec la valeur actuelle de 'Counter', arrondie à l'entier le plus proche
            $(this).text(Math.ceil(now));
        }
    });
});