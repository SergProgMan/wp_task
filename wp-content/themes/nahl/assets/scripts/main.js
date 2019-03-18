// import external dependencies

import "jquery"
import AOS from 'aos';
// Import everything from autoload
import "./autoload/**/*"
/* eslint-disable */

jQuery(document).ready(() => {
        $('.dropdown-menu a.dropdown-toggle').on('click', function() {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');

            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function() {
                $('.dropdown-submenu .show').removeClass("show");
            });
            return false;
        });
        $('.single__right--bottom p img').parents('p').addClass('center_flex')

});


$(window).load(function() {
    AOS.init({
        duration: 3000,
    });
});


