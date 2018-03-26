jQuery(function ($) {
    mudarInfoAbaAtiva();
});

function mudarInfoAbaAtiva() {
    var nomeDoCaminho = window.location.pathname;
    nomeDoCaminho = nomeDoCaminho.split("/")[2];

    if(nomeDoCaminho == null)
        nomeDoCaminho = "dashboard";

    var $abas = $('.aba');
    $abas.removeClass('active');

    var $abaAtual = $('.' + nomeDoCaminho);
    $abaAtual.addClass('active');

    $('.navbar-brand').text(nomeDoCaminho).css('textTransform', 'capitalize');
}