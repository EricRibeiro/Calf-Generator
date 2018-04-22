jQuery(function ($) {
    updateAnimalList();
    insertDates();
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
        if ($(this).find('.input-checkbox').is(':checked')) {
            animais.push($(this).children(".idAnimal").html());
            $("input[name='lsIDsAnimais']").val(animais.join("-"));
        }
    });
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

function insertDates() {
    var $dataDeInseminacao = $("input[name='dataDeInseminacao']");
    var $dataDeRetornoAoCio = $("input[name='dataDeRetornoAoCio']");
    var $dataDeDiagnostico1 = $("input[name='dataDeDiagnostico1']");
    var $dataDeDiagnostico2 = $("input[name='dataDeDiagnostico2']");
    var momentDate = null;


    $dataDeInseminacao.keyup(function() {
        momentDate = moment($(this).val(), "DD/MM/YYYY");
        var isValid = momentDate.isValid();

        if($(this).val().length === 10 && isValid) {
            var dataDeInseminacao = $dataDeInseminacao.val();
            var dataDeRetornoAoCio = moment(dataDeInseminacao, "DD/MM/YYYY").add(20, 'days');
            var dataDeDiagnostico1 = moment(dataDeInseminacao, "DD/MM/YYYY").add(27, 'days');
            var dataDeDiagnostico2 = moment(dataDeDiagnostico1, "DD/MM/YYYY").add(60, 'days');

            $dataDeRetornoAoCio.val(dataDeRetornoAoCio.format('DD/MM/YYYY'));
            $dataDeDiagnostico1.val(dataDeDiagnostico1.format('DD/MM/YYYY'));
            $dataDeDiagnostico2.val(dataDeDiagnostico2.format('DD/MM/YYYY'));
        } else {
            $dataDeRetornoAoCio.val("");
            $dataDeDiagnostico1.val("");
            $dataDeDiagnostico2.val("");
        }
    });
}
