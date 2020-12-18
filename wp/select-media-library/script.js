var SelectMediaLibrary = (function() {

    // set all variables to be used in scope
    var dashboard = $('#dashboard');
    var frame;
    var img_container;
    var save_button;


    // OPEN MEDIA MODAL AND ADD NEW IMAGE
    dashboard.on( 'click', 'button', function( event ){
        event.preventDefault();

        var form = $(this).closest('#form');
        img_container = form.find('#new-images-holder');
        save_button = form.find('#save-button');


        // if the media frame already exists, reopen it
        if ( frame ) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select image',
            button: {
                text: 'Use this media'
            },
            multiple: true
        });


        // when an image is selected in the media frame...
        frame.on( 'select', function() {

            // get media attachment details from the frame
            var attachment = frame.state().get('selection').first().toJSON();

            // new item - with img, hidden input, cancel button
            var new_item = $('<figure/>')
                    .addClass('new-item')
                    .append(
                        $('<div class="new-gallery-image"><img src="' + attachment.url + '" alt=""></div>'),
                        $('<input type="hidden" name="image_id" value="' + attachment.id + '" >').trigger('change'),
                        $('<button class="button-link attachment-close media-modal-icon"></button>')
                    );


            // send content to container
            img_container.prepend(new_item);

            // show "save button"
            if ( save_button.hasClass('hidden') ) {
                save_button.removeClass('hidden');
            }

        });

        // open the modal on click
        frame.open();
    });

})(); // !SelectMediaLibrary
