jQuery(function ($) {
    $(".validate-date").blur(function () {
        if (!(moment($(this).val()).isValid()))
            this.setCustomValidity("Insira uma data válida no formato: Dia/Mês/Ano")
    });
});