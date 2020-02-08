//import $ from 'jquery';
//import Search from './modules/search';
//var search = new Search();

$(document).ready(function(){
    $('.en_all_news').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        arrows: true,
        nextArrow: '<span class="dashicons dashicons-arrow-right-alt2 slick-arrow slick-next d-flex justify-content-center align-items-center"></span>',
        prevArrow: '<span class="dashicons dashicons-arrow-left-alt2 slick-arrow slick-prev d-flex justify-content-center align-items-center"></span>',
        centerMode: true,
        dots: false,
        pauseOnHover: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 2
            }
        }]
    });
});


