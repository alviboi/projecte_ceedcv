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

window.getDiumenge= function (d) {
    d = new Date(d);
    var day = d.getDay(),
        diff = d.getDate() - day; // ajustar
    return new Date(d.setDate(diff));
  }

window.avis = function() {
    UIkit.modal('modal_avis').show();
}
