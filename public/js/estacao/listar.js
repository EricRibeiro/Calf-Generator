jQuery(function ($) {
    updateAnimalList();
});

var lsAnimaisEstacaoOriginal = [];
var lsAnimaisEstacaoPosEdicao = [];

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
        if($(this).find('.input-checkbox').is(':checked')) {
            lsAnimaisEstacaoOriginal.push($(this).children(".idAnimal").html());
            lsAnimaisEstacaoPosEdicao.push($(this).children(".idAnimal").html());
        }
    });
}

function updateAnimalList() {
    $('.input-checkbox').unbind().change(function(){

        if ($(this).is(':checked')) {
            var elementoAdicionado = $(this).parent().parent().next().html();
            lsAnimaisEstacaoPosEdicao.push(elementoAdicionado);

        } else {
            var elementoRemovido = $(this).parent().parent().next().html();
            lsAnimaisEstacaoPosEdicao = lsAnimaisEstacaoPosEdicao.filter(e => e !== elementoRemovido);
        }

        var lsDeAnimaisAdicionados = lsAnimaisEstacaoPosEdicao.filter(function(val) {
            return lsAnimaisEstacaoOriginal.indexOf(val) == -1;
        });

        var lsDeAnimaisRemovidos = lsAnimaisEstacaoOriginal.filter(function(val) {
            return lsAnimaisEstacaoPosEdicao.indexOf(val) == -1;
        });

        $("input[name='lsIDsAnimaisAdicionados']").val(lsDeAnimaisAdicionados.join("-"));
        $("input[name='lsIDsAnimaisRemovidos']").val(lsDeAnimaisRemovidos.join("-"));

    });
}