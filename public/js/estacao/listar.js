jQuery(function ($) {
    updateAnimalList();
});

var animais = [];

if (window.attachEvent) {
    window.attachEvent('onload', createAnimalList());
} else {
    if (window.onload) {
        var curronload = window.onload;
        var newonload = function (evt) {
            curronload(evt);
            createAnimalList()(evt);
        };
        window.onload = newonload;
    } else {
        window.onload = createAnimalList();
    }
}

function createAnimalList() {
    $("tbody tr").each(function () {
        animais.push($(this).children(".idAnimal").html());
    });

    $("input[name='lsIDsAnimais']").val(animais.join("-"));
}

function updateAnimalList() {
    $('.input-checkbox').unbind().change(function(){

        if ($(this).is(':checked')) {
            var elementoAdicionado = $(this).parent().parent().next().html();
            animais.push(elementoAdicionado);

        } else {
            var elementoRemovido = $(this).parent().parent().next().html();
            animais = animais.filter(e => e !== elementoRemovido);
        }

        $("input[name='lsIDsAnimais']").val(animais.join("-"));
    });
}
