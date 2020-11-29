window.canvi = function(url) {
    var elem = document.getElementById('mycontent');
    axios.get('home2')
    .then(res => {
        //console.log(res);
        elem.innerHTML = res.data;
        elem.style.display = 'none';
        $('#mycontent').fadeIn(750);

    })
    .catch(err => {
        console.error(err);
    })

}
