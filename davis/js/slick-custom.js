/**
 * Theme scripting
 *
 * @package Margolis_2017
 * @author Postali
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
  "use strict";

// Slick
  $('#practice_areas_carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow:4,
    autoplay: true,
    slidesToScroll: 3,
    prevArrow: $('#practice_areas_prev'),
    nextArrow: $('#practice_areas_next'),
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 3,
          infinite: true,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 2,
          arrows:false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows:false
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });


  $('.testimonial-widget').slick({
    vertical: true,
    verticalSwiping: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    speed: 300,
    dots: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 5000,
    adaptiveHeight: false
  });

});