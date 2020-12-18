// REMOVE TAGS (<>), TO AVOID EXECUTION OF CODE
function stripHTMLtags(text) {
    var map = {
        '<': '',
        '>': ''
    };
    return text.replace(/[<>]/g, function(m) { return map[m]; });
}
