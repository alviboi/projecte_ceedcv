const { delay } = require("lodash");

window.canvi = function(url) {
    $("#app").fadeOut(500, function () {
        $("#app").load("seccio/"+url, function(){
            $("#app").fadeIn(500);
        });
    });
}
