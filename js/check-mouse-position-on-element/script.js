// CHECK WHERE IS MOUSE RELATIVE TO HOVERED ELEMENT
// horizontal: left, right
// vertical: top, bottom
// center is ignored!

element.on( 'mousemove', 'div', function(event) {
    event.preventDefault();

    var el_width = $(this).width();
    var el_height = $(this).height();
    var horizontal_pos = event.offsetX;
    var vertical_pos = event.offsetY;


    if ( horizontal_pos > (el_width / 2) ) {
        console.log('Hovering on right side of element');
    }
    else if ( horizontal_pos < (el_width / 2) ) {
        console.log('Hovering on left side of element');
    }


    if ( vertical_pos > (el_height / 2) ) {
        console.log('Hovering on bottom side of element');
    }
    else if ( vertical_pos < (el_height / 2) ) {
        console.log('Hovering on top side of element');
    }
});
