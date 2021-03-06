window.onload = function () {
    disableDataUltimoParto();
};

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