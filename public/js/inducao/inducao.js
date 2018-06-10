window.onload = function () {
    createAnimalList();
    updateAnimalList();
    insertDates();
    dateInfo();
};

var animais = [];
var $dataDeInicio = $("input[name='dataDeInicio']");
var $dataDeFim = $("input[name='dataDeFim']");

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
    $dataDeInicio.keyup(function () {
        if (isDateValid($(this).val())) {

            var dataDeInicio = $dataDeInicio.val();
            var dataDeFim = moment(dataDeInicio, "DD/MM/YYYY").add(12, 'days');
            alert(dataDeFim)

            $dataDeFim.val(dataDeFim.format('DD/MM/YYYY'));
            showDateInfo($dataDeFim, $dataDeInicio, "Data de Início");

        } else {
            $dataDeFim.val("");
            $dataDeFim.next().hide();
        }
    });
}

function dateInfo() {
    $dataDeFim.keyup(function () {
        showDateInfo($dataDeFim, $dataDeInicio, "Data de Início");
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