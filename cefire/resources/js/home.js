const { delay } = require("lodash");

window.canvi = function(url) {
    $("#app").fadeOut(500, function () {
        $("#app").load("seccio/"+url, function(){
            $("#app").fadeIn(500);
        });
    });
}

window.data_db = function (data) {
    let dia = data.getDate();
    let mes = data.getMonth() + 1;
    let an = data.getFullYear();
    let ret = an + "-" + mes + "-" + dia;
    return ret;
}

