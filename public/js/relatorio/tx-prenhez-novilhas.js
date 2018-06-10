jQuery(function ($) {
    onSelectChangeGetProtocolos();
    onSelectChangeShowTableOrSelect();
});

var $selEstacao = $('#sel-estacao');
var $selProtInduzidas = $('#sel-protocolo-induzidas');
var $selProtNaoInduzidas = $('#sel-protocolo-naoInduzidas');

var dadosTabela;
var idEstacao;
var idProtInduzidas;
var idProtNaoInduzidas;
var protocolos;

function onSelectChangeGetProtocolos() {
    $selEstacao.unbind().change(function () {
        idEstacao = $(this).val();

        $.ajax({
            url: '/app/relatorio/getProtocolos',
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {idEstacao: idEstacao},
            success: function (data) {
                protocolos = strToJsonArrayProtocolo(data);
                showSelectProtocolos('induzidas');
                showSelectProtocolos('naoInduzidas');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
}

function strToJsonArrayProtocolo(data) {
    let protocolos = [];

    data.map(function (item) {
        item = JSON.parse(item);

        protocolos.push({
            "id_protocolo": item.id_protocolo,
            "id_estacao": item.id_estacao,
            "id_estado": item.id_estado,
            "numero": item.numero
        });
    })

    return protocolos;
}

function showSelectProtocolos(protLetter) {
    let $select = $('#sel-protocolo-' + protLetter);
    let option = "<option hidden selected value='unselected'>Selecionar Protocolo</option>";

    protocolos.map(function (item) {
        option += "<option value='" + item.id_protocolo + "'>";
        option += "Protocolo " + item.numero;
        option += "</option>";
    });

    $select.html(option);
    $('#row-sel-protocolo-' + protLetter).show("fast");
}

function onSelectChangeShowTableOrSelect() {
    $selProtInduzidas.unbind().change(function () {
        idProtInduzidas = $(this).val();

        if ($selProtNaoInduzidas.val() != 'unselected') {
            showTable();
        }

    });

    $selProtNaoInduzidas.unbind().change(function () {
        idProtNaoInduzidas = $(this).val();

        if ($selProtInduzidas.val() != 'unselected') {
            showTable();
        }

    });
}

function showTable() {
    dadosTabela = getTableData();

// let table = "";
    // table += "<table id='tabTxPrenhezNovilhas' class='table'>";
    // table += "<thead>";
    // table += "<tr>";
    // table += "<th class='text-center'>Nº do Protocolo</th>";
    // table += "<th class='text-center'>Total de Nov. no Protocolo</th>";
    // table += "<th class='text-center'>Nº de Nov. Repetiu</th>";
    // table += "<th class='text-center'>Nº de Novilhas Prenhas</th>";
    // table += "<th class='text-center'>Tx. de Prenhez do Protocolo %</th>";
    // table += "</thead>";
    // table += "<tbody>";
    // table += "</tbody>";
    // table += "</table>";

    // content += "<tr>";
    // content += "<td class='content-align'>" + aliments[i].descricao + "</td>";
    // content += "<td class='content-align'>" + evalAlimentsContent(aliments[i].energia.kcal, "kcal") + "</td>";
    // content += "<td class='content-align'>" + evalAlimentsContent(aliments[i].calcio, "g") + "</td>";
    // content += "<td class='content-align'>" + evalAlimentsContent(aliments[i].ferro, "g") + "</td>";
    // content += "<td class='content-align'>" + evalAlimentsContent(aliments[i].fibra_alimentar, "g") + "</td>";
    // content += "<td class='content-align'>" + evalAlimentsContent(aliments[i].lipideos, "g") + "</td>";
    // content += "<td class='content-align'>" + evalAlimentsContent(aliments[i].proteina, "g") + "</td>";
    // content += getDetailsBtnContent(i);
    // content += getRemoveBtnContent(i);
    // content += "</tr>";
}

function getTableData() {
    $.ajax({
        url: '/app/relatorio/getDados',
        type: 'POST',
        dataType: 'json',
        async: true,
        data: {idEstacao: idEstacao, idProtInduzidas: idProtInduzidas, idProtNaoInduzidas: idProtNaoInduzidas},
        success: function (data) {
            alert("BATATA");
        },
        error: function (data) {
            console.log(data);
        }
    });
}

