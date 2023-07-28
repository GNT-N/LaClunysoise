// any CSS you import will output into a single css file (app.css in this case)
import './app.scss';

// Chargement de la bibliothèque jQuery
const $ = require('jquery');

// Chargement de la partie JS de bootstrap
require('bootstrap');

$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});