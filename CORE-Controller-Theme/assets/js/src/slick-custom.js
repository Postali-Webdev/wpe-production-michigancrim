/**
 * Slick Custom
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

	$('#awards').slick({
		dots: false,
		infinite: true,
        arrows:false,
		fade: false,
		autoplay: true,
  		autoplaySpeed: 3000,
  		speed: 800,
		slidesToShow: 8,
		slidesToScroll: 1,
    	swipeToSlide: true,
		cssEase: 'ease-in-out',
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
              breakpoint: 821,
              settings: {
                    slidesToShow: 4,
                }
            },
            {
              breakpoint: 601,
              settings: {
                    slidesToShow: 2,
                }
            }
        ]
	});

    $('.results-scroller').slick({
		dots: true,
		infinite: true,
        arrows:true,
		fade: false,
		autoplay: false,
  		speed: 800,
		slidesToShow: 1,
		slidesToScroll: 1,
    	swipeToSlide: true,
		cssEase: 'ease-in-out',
        appendDots: '.nav-dots',
        appendArrows: '.nav-arrows',
	});

    $('.pa-slides').slick({
		dots: false,
		infinite: true,
        arrows:true,
		fade: false,
		autoplay: false,
  		speed: 800,
		slidesToShow: 3,
		slidesToScroll: 1,
    	swipeToSlide: true,
		cssEase: 'ease-in-out',
        appendArrows: '.pa-slider-arrows',

        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 821,
                settings: {
                    slidesToShow: 1.7,
                }
            }
        ]
	});

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        infinite: false,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 4,
        variableWidth: true,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: false,
        focusOnSelect: false,
        infinite: false,
    });

    $('.next-arrow').on('click', function(){
        $('.slider-for').slick('slickNext');
        $('.slider-nav').slick('slickNext');
    });
    $('.prev-arrow').on('click', function(){
        $('.slider-for').slick('slickPrev');
        $('.slider-nav').slick('slickPrev');
    });

    $('.slider-nav .slick-slide').on('click', function (event) {
        $('.slider-for').slick('slickGoTo', $(this).data('slickIndex'));
    });
	
});