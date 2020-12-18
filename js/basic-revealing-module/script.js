// BASIC REVEALING MODULE:
// private & public variables and functions

var BasicModule = (function() {

    // private varibale (not accessible outside scope)
    var name = 'simun';


    // method 1
    function display() {}

    // method 2
    function hide() {}


    // make public functions (for accessing outside scope)
    return {
        display: display,
        hide: hide
    }

})(); // !BasicModule
