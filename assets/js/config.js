function validarEmail(email) {

    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!expr.test(email)) {

        return false;

    } else {

        return true;

    }

}

function format(input) 
{
    var num = input.value.replace(/\./g,'');

    if(!isNaN(num))
    {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }
    else
    { 
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}