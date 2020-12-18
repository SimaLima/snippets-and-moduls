var JSAjax = (function() {
    // On click call ajax function, send request and handle request

    var element = $('#static_element');
    var message_box = $('#message-box');


    // TRIGGER AJAX CALL
    element.on('click', 'button', function(event) {
        event.preventDefault();

        ajaxCall(123, 'string');
    });



    // AJAX CALL FUNCTION - DESCRIPTION
    function ajaxCall( number, string ) {
        $.ajax({
            url: ajaxurl, // var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            type: 'POST',
            data: {
                    action: 'action_function',
                    number: number,
                    string: string,
                    security: LOCALIZE.security
                    // security: LOCALIZE.security_stat
            },
            success: function( response ) {
              // console.log(response);

                // wp_send_json_success
                if ( response.success === true ) {

                    handleResponseSuccess(response.data);

                }
                else {
                    // wp_send_json_error  -  This will work properly if WP_DEBUG is FALSE in WP-config.php
                    message_box.append(response.data).addClass('show-message error');
                }

            }
        }); // $.ajax
    }




    // HANDLE AJAX RESPONSE
    function handleResponseSuccess( ajax_response ) {

        // update neccessary elements
        var elements = section.find('div');

        for (var i = 0; i < elements.length; i++) {

             // current element
             var current_el = elements.eq(i);

             // add new content
             current_el.html('...');
        }

        // success message
        // message_box.append(LOCALIZE.succ_added_txt).addClass('show-message success');
        message_box.append('Message - success.').addClass('show-message success');
    }



})(); // !JSAjax
