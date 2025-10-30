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

  $('#menu-icon').click(function(e){
    e.preventDefault();
    $('#mobile-nav').slideToggle(300);
    // Change this boolean number to adjust animation speed
    $(this).toggleClass('open');
    $('body').toggleClass('freeze');
  });

  $('#menu-mobile-menu-1 .menu-item-has-children').on('click', function() {
      $(this).find('.sub-menu').slideToggle('medium');
      $(this).toggleClass('active');
  })

  //keeps menu expanded so user can tab through second, then closes menu after user tabs away from last child
$(document).ready(function() {
    function tabableMenu() {
        var screenSize = $(document).outerWidth();
        if( screenSize > 1100 ) {
            var focusActive = false;
            var navMenu = 'li.menu-item-has-children';

            //do functions below while user is focused on sub menu
            $(navMenu).on('focusin keydown', function(e) {
                var subMenu = $(this).find('.second');
                //adding active menu state while user is focused on sub menu
                subMenu.addClass('focus-active');
                focusActive = true;
                //remove menu when user tabs away from menus last child item
                $(this).find('li:last-child').on('focusout', function(e) {
                    subMenu.removeClass('focus-active');
                    focusActive = false;
                });
            })
            //remove active sub menu when user reverse tabs away 
            $(navMenu).on('focusout keydown', function(e) { 
                //focusActive = false;
                var subMenu = $(this).find('.second');

                if( e.type === "keydown" ) {
                    var shiftKey = e.shiftKey;
                    var keyCode = e.keyCode;
                }

                if (e.type === "focusout") {
                    var parentElId = $(e.relatedTarget).parent()[0].id;
                    var parentInFocus = navMenu.includes(parentElId);
                    var currentId = $(this).attr('id');
                }

                if(shiftKey && keyCode == 9 && parentInFocus === currentId) { 
                    subMenu.removeClass('focus-active');
                    focusActive = false;
                }
            });
            //remove active sub menu when user clicks anywhere on page outside of the menu
            $('html').on('click', function(e) {
                var target = e.target;
                if( $(target).closest('.second').length ) {
                    return;
                } else {
                    if ( focusActive ) {
                        $('.second').removeClass('focus-active');
                        focusActive = false;
                    }
                }
            });
        } 
    }
    tabableMenu();
    $(window).resize(function() {
        tabableMenu();
    });
});

  
});



//Function responsible for updated transition affects and selected option on practice area pages (mobile only)
(function($) {
  $( document ).ready(function() {
    if ($('.page-child aside .widget_nav_menu div:first-of-type select').length) {
      let currentUrl = window.location.href;
      let menu = '.page-child aside .widget_nav_menu div:first-of-type';
      let menuArray = [];
      let sel = $(menu + ' select')[0].children;
      let userAgent = window.navigator.userAgent;

      for (var i=0, n=$(sel).length; i<n;i++) {
        menuArray.push(sel[i]);
        
        if ( $(sel[i]).val() === currentUrl) {
          $(sel[i]).attr("selected", "selected");
        }
      }
      if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
        menuArray.forEach((item, index) => {
          if ($(item).val() === currentUrl) {
            $(menu + ' select').prepend(`<option selected="selected" disabled="disabled" value="#">${item.outerText}</option>`)
          }
        })

      }
      $(menu + ' select').on('click', function(e) {
         $(menu).addClass('active-select');
      })
    }
  });
})(jQuery);

/* Adding accessibility labels to progress bars */
(function($) {
  $( document ).ready(function() {
    if ( $('.weblator-chart-container').length ) {
      setTimeout(() => {
        $('.progress-bar').attr('aria-label', 'progress bar');
      }, 1000);
    }
  });
})(jQuery)