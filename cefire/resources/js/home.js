const { delay } = require("lodash");




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

window.fecha_format = function (d = new Date) {
    let mes = String(d.getMonth() + 1);
    let dia = String(d.getDate());
    const any = String(d.getFullYear());

    if (mes.length < 2) mes = '0' + mes;
    if (dia.length < 2) dia = '0' + dia;

    return `${dia}/${mes}/${any}`;
  }

window.newTab = function(url){
    var win = window.open(url);
    win.focus();
}
