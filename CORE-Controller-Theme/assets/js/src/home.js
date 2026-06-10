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