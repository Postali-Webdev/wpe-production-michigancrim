/**
 * Home Page Scripting
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

    var counterAnimated = false;

    jQuery(window).on('scroll', function() {
        if (counterAnimated) {
            return;
        }

        var counterElement = jQuery("#counter2");
        var elementPosition = counterElement.offset().top;
        var scrollPosition = jQuery(window).scrollTop() + window.innerHeight;

        if (scrollPosition > elementPosition) {
            counterAnimated = true;

            jQuery('.alert-2').addClass('fadeup');
            jQuery('.half-donut-chart').addClass('fadeup');
            jQuery('.half-donut-chart').find('.half-donut-fill').addClass('animate');

            jQuery(".counter-value2").each(function() {
                var $counter = jQuery(this);
                var targetCount = $counter.attr("data-count");

                jQuery({
                    countNum: $counter.text()
                }).animate({
                    countNum: targetCount
                }, {
                    duration: 2e3,
                    easing: "swing",
                    step: function() {
                        $counter.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $counter.text(this.countNum);
                    }
                });
            });
        }
    });

    $('.tabs-container .main-content .tab-content:first-of-type').addClass('active');


    $('.main-buttons span').click(function() {

        // Check for active
        $('.main-buttons li').removeClass('active');
        $(this).parent().addClass('active');

        // Display active tab
        var currentTab = $(this).attr('id');
        $('.main-content .tab-content').removeClass('active');
        $(currentTab).addClass('active');

        return false;
    });


});