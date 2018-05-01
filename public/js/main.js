jQuery(function ($) {
    mudarInfoAbaAtiva();
});

function mudarInfoAbaAtiva() {
    var nomeDoCaminho = window.location.pathname;
    nomeDoCaminho = nomeDoCaminho.substr(nomeDoCaminho.indexOf("/") + 1);
    nomeDoCaminho = nomeDoCaminho.replace(/\//ig, "-");

    if (nomeDoCaminho === "")
        nomeDoCaminho = "app-dashboard";

    $('ul li').removeClass('active');

    var $abaAtual = $('.' + nomeDoCaminho);

    $abaAtual.addClass('active');

    $('.navbar-brand').text($abaAtual.find('p').text()).css('textTransform', 'capitalize');
}