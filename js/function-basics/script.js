// FUNCTION BASICS:
// declaration, expression, IIFE


// Function declaration
function functionDeclaration() {
    console.log('function declaration')
}
//functionDeclaration();


// Function expression
var functionExpression = function(){
    console.log('function expression');

    // return some_value
}
// functionExpression();


//IIFE - immediately invoked function
(function(){
    var name = 'simun';
})();
