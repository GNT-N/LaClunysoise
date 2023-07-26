// any CSS you import will output into a single css file (app.css in this case)
import './app.scss';

// Chargement de la bibliothèque jQuery
const $ = require('jquery');

// Chargement de la partie JS de bootstrap
require('bootstrap');

//  $('.count').each(function () {
//      $(this).prop('Counter',0).animate({
//          Counter: $(this).text()
//      }, {
//          duration: 1500,
//          easing: 'swing',
//          step: function (now) {
//              $(this).text(Math.ceil(now));
//          }
//      });
//  });

document.addEventListener("DOMContentLoaded", function() {

    const titleDesc = document.getElementById("titleDesc");
    const carouselExampleAutoplaying = document.getElementById("carouselExampleAutoplaying");
    const carouselExampleControls = document.getElementById("carouselExampleControls");
    const buttonsContainer = document.getElementById("buttonsContainer");
    
    setTimeout(function() {
        titleDesc.classList.add("active");
        carouselExampleAutoplaying.classList.add("active");
        carouselExampleControls.classList.add("active");
        buttonsContainer.classList.add("active");
    }, 100);
});