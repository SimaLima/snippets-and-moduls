(function($) {


    var slider = $('#slider');
    var images_holder = slider.find('#images-holder');
    var single_images = images_holder.find('.single-image-holder');
    var active;


    // OPTIONS:
    // set starting position (1-10)
    var position = parseInt(single_images.length/2);

    // infinite sliding
    var infinite = true;

    // keyboard arrows sliding
    var arrows = true;





    // SET SLIDER CSS, and show buttons
    function init() {

        // it has to be at least 2 images to trigger slider
        if ( single_images.length < 2 ) return;


        // if position not set right, stop
        if ( typeof position != 'number' || (position % 1) != 0 ) return;
        if ( position < 1 || position > single_images.length ) return;


        // check option values
        if ( typeof infinite != 'boolean' ) infinite = false;
        if ( typeof arrows != 'boolean' ) arrows = false;



        // hide slider until viewport position is set
        images_holder.addClass('hide');



        // set active image
        position--;
        active = single_images.eq(position);
        active.addClass('active');



        // if infinite enabled -> get position and append or prepend image if necessary
        if ( infinite ) {
            if ( position == 0 ) {
                images_holder.prepend(images_holder.find('.single-image-holder').eq(single_images.length-1));
                position++;
            }
            else if ( position == single_images.length-1 ) {
                images_holder.append(images_holder.find('.single-image-holder').eq(0));
                position--;
            }
        }





        // IMAGE HOLDER CSS
        // width: number of images * width of container
        // height: height of container
        // left: (negative) starting position * width of container
        images_holder.css({
            'width': (single_images.length * slider.width() ) + 'px',
            'height': slider.height() + 'px',
            'left': -(position * slider.width() )
        });



        // each image css
        single_images.css({
            'width': slider.width() + 'px',
            'height': slider.height() + 'px'
        });




        // if there are prev items, show "prev" button
        if ( active.prev('.single-image-holder').length ) {
            slider.find('#btn-prev').removeClass('hide-button');
        }

        // if there are next items, show "next" button
        if ( active.next('.single-image-holder').length ) {
            slider.find('#btn-next').removeClass('hide-button');
        }



        // when loaded, show it
        images_holder.removeClass('hide');
    }

    // load slider
    init();




    // KEY PRESS -> if ENABLED, trigger button click to execute sliding
    $('body').on('keydown', function(event) {
        if ( !arrows ) return;


        if (event.keyCode == 37)
            slider.find('#btn-prev').trigger('click');

        if (event.keyCode == 39)
            slider.find('#btn-next').trigger('click');
    });







    // NEXT IMAGE
    slider.on('click', '#btn-next', function() {
        // prevention, just in case
        if ( $(this).hasClass('hide-button') ) return;

        // next image
        var next = active.next('.single-image-holder');;

        // set next image as active
        active.removeClass('active');
        next.addClass('active');
        active = next;


        // if infinite sliding enabled...
        if ( infinite ) {

            // append first image as last
            images_holder.append(images_holder.find('.single-image-holder').eq(0));

            // first adjust left property to keep right viewport position
            images_holder.css({ 'left': '+=' + slider.width() + 'px' });

            // then slide to left
            images_holder.animate({ left: '-=' + slider.width() + 'px' }, 300);

            // no need to go further, stop here
            return;
        }




        // slide
        images_holder.animate({ left: '-=' + slider.width() + 'px' }, 300);


        // if there are no next items after next, hide "next" button
        if ( !next.next('.single-image-holder').length ) {
            $(this).addClass('hide-button');
        }


        // if there are prev items, show "prev" button
        if ( next.index() == 1 ) {
            $(this).siblings('#btn-prev').removeClass('hide-button');
        }

    });








    // PREVIOUS IMAGE
    slider.on('click', '#btn-prev', function() {
        // prevention, just in case
        if ( $(this).hasClass('hide-button') ) return;

        // previous image
        var prev = active.prev('.single-image-holder');

        // set previous image as active
        active.removeClass('active');
        prev.addClass('active');
        active = prev;


        // if infinite sliding enabled...
        if ( infinite ) {

            // prepend last image as first
            images_holder.prepend(images_holder.find('.single-image-holder').eq(single_images.length-1));

            // first adjust left property to keep right viewport position
            images_holder.css({ 'left': '-=' + slider.width() + 'px' });

            // then slide to left
            images_holder.animate({ left: '+=' + slider.width() + 'px' }, 300);

            // no need to go further, stop here
            return;
        }



        // slide
        images_holder.animate({ left: '+=' + slider.width() + 'px' }, 300);


        // if there are no prev items, hide "prev" button
        if ( !prev.prev('.single-image-holder').length ) {
            $(this).addClass('hide-button');
        }


        // if there are next items, show "next" button
        if ( prev.index() == (single_images.length-2) ) {
            $(this).siblings('#btn-next').removeClass('hide-button');
        }


    });




})(jQuery);
