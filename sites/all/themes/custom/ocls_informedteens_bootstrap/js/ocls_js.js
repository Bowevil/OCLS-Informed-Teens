/**
 * Created by Michael on 5/6/15.
 */
(function ($) {

    Drupal.behaviors.ocls_informedteens_bootstrap = {

        attach: function (context, settings) {

            // All our js code here
            var img2 = jQuery('.field-content.flexslider-img-selector').outerHeight(true);
            var description2 = jQuery('.views-field-field-description-flexslider').outerHeight(true);
            var title2 = jQuery('.views-field-title-flexslider').outerHeight(true);
            jQuery('.flexslider-img-selector img').hover(
                function () {
                    jQuery('.views-field-field-description-flexslider').css("visibility", "visible");
                    jQuery('.jquery-div').css("bottom", "125px");
                    jQuery('.views-field-title-flexslider').css("opacity", ".7");
                },
                function () {
                    jQuery('.views-field-field-description-flexslider').css("visibility", "hidden");
                    jQuery('.jquery-div').css("bottom", "40px");
                    jQuery('.views-field-title-flexslider').css("opacity", "1");
                }
            );

            jQuery('a[href^="http://"]').attr('target','_blank');
            jQuery('a[href^="https://"]').attr('target','_blank');
            jQuery(".views-field-field-feed-image  a > img").addClass('center-block');
            jQuery(".views-field-field-feed-image  a > img").css({"width": "150px", "height": "150px"});
            jQuery(".views-field-field-media-image a > img").addClass('center-block');
            jQuery(".views-field-field-vol-header-image > span > img").addClass('img-responsive center-block');
            jQuery(".views-field-field-taxonomy-image > span > img").addClass('img-responsive center-block');
            // end our js code

        }

    };})(jQuery);