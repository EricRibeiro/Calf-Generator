window.onload = function () {
    showSelectOptions();
    disableDataUltimoParto();
};

function showSelectOptions() {
    var classificacoes = getClassificacoes();
    var $select = $("#sel1");
    var classificacao = $("option:selected", $select).val();

    $.each(classificacoes, function (key, value) {
        var option = "";

        if(classificacao === key)
            option = "<option selected value='" + key + "'>" + value + "</option>";
        else
            option = "<option value='" + key + "'>" + value + "</option>";

        $select.append(option);
    });
}

function getClassificacoes() {
    return {
        1: "Novilha",
        2: "Primípara Pós-Parto",
        3: "Primípara Gestante da Estação Anterior",
        4: "Multípara Pós-Parto",
        5: "Multípara Gestante da Estação Anterior"
    };
}

function disableDataUltimoParto() {
    var $inputClassificacao =  $("[name='classificacao']");

    if (isDateNeeded($inputClassificacao.val())) {
        $("[name='dataUltimoParto']").removeAttr('disabled');
    } else {
        $("[name='dataUltimoParto']").attr('disabled', true);
        $("[name='dataUltimoParto']").val('');
    }

    $inputClassificacao.change(function () {
        var classificacao = $(this).val();

        if (isDateNeeded(classificacao)) {
            $("[name='dataUltimoParto']").removeAttr('disabled');
            $("[name='dataUltimoParto']").val('');
        } else {
            $("[name='dataUltimoParto']").attr('disabled', true);
            $("[name='dataUltimoParto']").val('');
        }
    });
}

function isDateNeeded($classificacao) {
    return ($classificacao === '2' || $classificacao === '4');
}