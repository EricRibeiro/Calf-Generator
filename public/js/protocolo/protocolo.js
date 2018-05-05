window.onload = function () {
    createAnimalList();
    updateAnimalList();
    insertDates();
    dateInfo();
};

var animais = [];
var $dataDeInseminacao = $("input[name='dataDeInseminacao']");
var $dataDeRetornoAoCio = $("input[name='dataDeRetornoAoCio']");
var $dataDeDiagnostico1 = $("input[name='dataDeDiagnostico1']");
var $dataDeDiagnostico2 = $("input[name='dataDeDiagnostico2']");

function createAnimalList() {

    $("tbody tr").each(function () {
        if ($(this).find('.input-checkbox').is(':checked')) {
            animais.push($(this).children(".idAnimal").html());
            $("input[name='lsIDsAnimais']").val(animais.join("-"));
        }
    });
}

function updateAnimalList() {
    $('.input-checkbox').unbind().change(function () {

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
    $dataDeInseminacao.keyup(function () {
        if (isDateValid($(this).val())) {
            var dataDeInseminacao = $dataDeInseminacao.val();
            var dataDeRetornoAoCio = moment(dataDeInseminacao, "DD/MM/YYYY").add(20, 'days');
            var dataDeDiagnostico1 = moment(dataDeInseminacao, "DD/MM/YYYY").add(27, 'days');
            var dataDeDiagnostico2 = moment(dataDeDiagnostico1, "DD/MM/YYYY").add(60, 'days');

            $dataDeRetornoAoCio.val(dataDeRetornoAoCio.format('DD/MM/YYYY'));
            showDateInfo($dataDeRetornoAoCio, $dataDeInseminacao, "Data de Inseminação");

            $dataDeDiagnostico1.val(dataDeDiagnostico1.format('DD/MM/YYYY'));
            showDateInfo($dataDeDiagnostico1, $dataDeInseminacao, "Data de Inseminação");

            $dataDeDiagnostico2.val(dataDeDiagnostico2.format('DD/MM/YYYY'));
            showDateInfo($dataDeDiagnostico2, $dataDeDiagnostico1, "Data de Diagnóstico 1");

        } else {
            $dataDeRetornoAoCio.val("");
            $dataDeRetornoAoCio.next().hide();

            $dataDeDiagnostico1.val("");
            $dataDeDiagnostico1.next().hide();

            $dataDeDiagnostico2.val("");
            $dataDeDiagnostico2.next().hide();
        }
    });
}

function dateInfo() {
    $dataDeRetornoAoCio.keyup(function () {
        showDateInfo($dataDeRetornoAoCio, $dataDeInseminacao, "Data de Inseminação");
    });

    $dataDeDiagnostico1.keyup(function () {
        showDateInfo($dataDeDiagnostico1, $dataDeInseminacao, "Data de Inseminação");
        if ($dataDeDiagnostico2 != "")
            showDateInfo($dataDeDiagnostico2, $dataDeDiagnostico1, "Data de Diagnóstico 1");
    });

    $dataDeDiagnostico2.keyup(function () {
        showDateInfo($dataDeDiagnostico2, $dataDeDiagnostico1, "Data de Diagnóstico 1");
    });
}

function showDateInfo($inputDataA, $inputDataB, descDataB) {
    if (isDateValid($inputDataA.val()) && isDateValid($inputDataB.val())) {
        var diferenca = getDateDiff($inputDataA.val(), $inputDataB.val());

        $inputDataA.next().show()

        if (diferenca > 0) {
            $inputDataA.next().removeClass("text-danger").addClass("text-info");
            $inputDataA.next().html("<b>" + diferenca + " dias </b> após a <b>" + descDataB + "</b>");
        } else {
            $inputDataA.next().removeClass("text-info").addClass("text-danger");
            $inputDataA.next().html("<b>O valor informado deve ser maior do que a " + descDataB + ".</b>");
        }
    } else {
        $inputDataA.next().hide()

    }
}

function isDateValid(data) {
    var momentDate = moment(data, "DD/MM/YYYY");
    return (data.length === 10 && momentDate.isValid());
}

function getDateDiff(a, b) {
    var a = moment(a, "DD/MM/YYYY");
    var b = moment(b, "DD/MM/YYYY");

    return a.diff(b, 'days');
}