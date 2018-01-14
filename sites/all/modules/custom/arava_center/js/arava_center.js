(function (Drupal, $) {
    'use strict';

    Drupal.behaviors.arava_center = {
        attach: function (context) {

            if (context == document) {
                $('.view-animals .view-grouping-content').hide();
                $('.view-animals .view-grouping-header').prepend('<span class="toggle plus">+</span> ');

                $('.view-animals .view-grouping-header').click(function(){
                    var sibling = $(this).siblings('.view-grouping-content');
                    sibling.toggle();

                    $('.view-animals .view-grouping-content').not(sibling).hide();
                });
            }
        }

    }
}(window.Drupal, window.jQuery));

jQuery(document).ready(function ($) { 
    if($("body").hasClass("page-courses-archive")){
       $("#edit-semester--2").on("change",function(){      
           $("#edit-submit-courses-archive").click();
           $(".views-reset-button").html("<img style='width:40px; margin-top:25px;' src='/sites/all/themes/arava_center/images/loader.gif'/>");
           $(".views-submit-button").hide();
           
       });
   }
});
