jQuery(function ($) {
    showSelectOptions();
    disableInputDataNovilha();
});

function disableInputDataNovilha() {
    $("[name='classificacao']").change(function () {
        if ($(this).val() != "Novilha")
            $("[name='dataUltimoParto']").removeAttr('disabled');
        else {
            $("[name='dataUltimoParto']").attr('disabled', true);
            $("[name='dataUltimoParto']").val('');
        }
    });
};

function showSelectOptions() {
    var $select = $("#sel1");
    var classificao = $("option:selected", $select).text();

    switch (classificao) {
        case 'Novilha':
            $select.find('option:contains("Primípara")').show();
            $select.find('option:contains("Multípara")').show();
            $("[name='dataUltimoParto']").attr('disabled', true);
            break;
        case 'Primípara':
            $select.find('option:contains("Novilha")').show();
            $select.find('option:contains("Multípara")').show();
            break;
        case 'Multípara':
            $select.find('option:contains("Novilha")').show();
            $select.find('option:contains("Primípara")').show();
            break;
    }
};