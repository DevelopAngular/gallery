
function down() {

    var a = document.querySelector('.droplink');
    if(a.style.display == 'none') {
        a.style.display = 'block';
    }
    else{
        if(a.style.display == 'block'){
            a.style.display = 'none';
        }

    }
}

