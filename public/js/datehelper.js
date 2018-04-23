jQuery(function ($) {
    $(".validate-date").change(function () {
        var momentDate = moment($(this).val(), "DD/MM/YYYY");

        if (!(momentDate).isValid()) {
            this.setCustomValidity("Insira uma data válida no formato: Dia/Mês/Ano")
        }
    });
});