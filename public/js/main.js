jQuery(function ($) {
    mudarAbaAtiva();
    mudarCollapsablesNav();
});

var $collapsables = $("[data-toggle='collapse']");
var caminho = window.location.pathname;
var classe = getClasse(caminho);

function mudarAbaAtiva() {
    var $abaAtual;

    if (classe === "-undefined-undefined")
        classe = "app-dashboard";

    $('ul li').removeClass('active');

    $abaAtual = $('.' + classe);
    $abaAtual.addClass('active');

    $('.navbar-brand').text($abaAtual.find('p').text()).css('textTransform', 'capitalize');
}

function mudarCollapsablesNav() {
    var $parentCollapse;
    var $parentToggle;
    var vetClasse = classe.split("-");

    if(vetClasse[1] !== 'animal' && vetClasse[1] !== 'dashboard') {
        $parentCollapse = $('.' + classe).parent().parent();
        $parentToggle = $parentCollapse.prev();

        esconderCollapsablesNavRestantes();

        $parentCollapse.addClass('in');
        $parentToggle.removeClass('collapsed').attr('aria-expanded', 'true');
    }

    $collapsables.click(function() {
        esconderCollapsablesNavRestantes();
    });
}

function esconderCollapsablesNavRestantes() {
    $collapsables.addClass('collapsed').attr('aria-expanded', 'false');
    $('.collapse').removeClass('in');
}

function getClasse(caminho) {
    var delimitador;
    var vetCaminho;

    classe = "";

    caminho = caminho.substr(caminho.indexOf("/") + 1);
    vetCaminho = caminho.split("/");
    delimitador = (vetCaminho.length === 2) ? 2 : 3;

    for (var i = 0; i < delimitador; i++) {
        classe += vetCaminho[i] + "-";
    }

    classe = classe.substring(0, classe.length - 1);

    return classe;
}