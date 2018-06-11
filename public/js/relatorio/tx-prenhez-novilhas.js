jQuery(function ($) {
    onSelectChangeGetProtocolos();
    onSelectChangeShowTableOrSelect();
});

var $selEstacao = $('#sel-estacao');
var $selProtInduzidas = $('#sel-protocolo-induzidas');
var $selProtNaoInduzidas = $('#sel-protocolo-naoInduzidas');

var idEstacao;
var idProtInduzidas;
var idProtNaoInduzidas;
var protocolos;

function onSelectChangeGetProtocolos() {
    $selEstacao.unbind().change(function () {
        idEstacao = $(this).val();

        $.ajax({
            url: '/app/relatorio/getJsonProtocolosDaEstacao',
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
            getTableData();
        }

    });

    $selProtNaoInduzidas.unbind().change(function () {
        idProtNaoInduzidas = $(this).val();

        if ($selProtInduzidas.val() != 'unselected') {
            getTableData();
        }

    });
}

function showTable(dados) {

    let table = "";
    table += "<table id='tabTxPrenhezNovilhas' class='table'>";
    table += "<thead>";
    table += "<tr>";
    table += "<th class='text-center'>Nº do Protocolo</th>";
    table += "<th class='text-center'>Total de Nov. no Protocolo</th>";
    table += "<th class='text-center'>Nº de Nov. Repetiu</th>";
    table += "<th class='text-center'>Nº de Novilhas Prenhas</th>";
    table += "<th class='text-center'>Tx. de Prenhez do Protocolo %</th>";
    table += "</thead>";
    table += "<tbody>";
    table += "</tbody>";
    table += "</table>";

    $('#row-tabTxPrenhezNovilhas').html(table);

    let content = "";

    dados.map(function (item) {
        content += "<tr>";
        content += "<td class='content-align'>" + item.NumProt + "</td>";
        content += "<td class='content-align'>" + item.TotalNovilhasNoProt + "</td>";
        content += "<td class='content-align'>" + item.NumNovilhasRepetiuNoProt + "</td>";
        content += "<td class='content-align'>" + item.NumNovilhasPrenhasNoProt + "</td>";
        content += "<td class='content-align'>" + item.TxPrenhez + "</td>";
        content += "</tr>";
    });

    $('tbody').html(content);
    $('#row-card-table').show();
    $('#row-tabTxPrenhezNovilhas').show('fast');

    initDataTables();
}

function showGraphics(dados) {
    let content =  "<canvas id='myChart' width='400' height='200'></canvas>"
    $("#row-graphicTxPrenhezNovilhas").html(content);

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Total de Novilhas no Protocolo", "Nº de Novilhas Repetiu", "Nº de Novilhas Prenhas"],
            datasets: [{
                label: 'Protocolo ' + dados[0].NumProt,
                data: [dados[0].TotalNovilhasNoProt, dados[0].NumNovilhasRepetiuNoProt, dados[0].NumNovilhasPrenhasNoProt],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }, {
                label: 'Protocolo ' + dados[1].NumProt,
                data: [dados[1].TotalNovilhasNoProt, dados[1].NumNovilhasRepetiuNoProt, dados[1].NumNovilhasPrenhasNoProt],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }],

        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    $('#row-card-graphic').show();
}



function getTableData() {
    $.ajax({
        url: '/app/relatorio/getDadosTxPrenhezNovilhas',
        type: 'POST',
        dataType: 'json',
        async: true,
        data: {idEstacao: idEstacao, idProtInduzidas: idProtInduzidas, idProtNaoInduzidas: idProtNaoInduzidas},
        success: function (data) {
            let dados = strToJsonArrayTable(data)
            showTable(dados);
            showGraphics(dados);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function strToJsonArrayTable(data) {
    let dados = [];

    data.map(function (item) {
        item = JSON.parse(item);

        dados.push({
            "NumProt": item.NumProt,
            "TotalNovilhasNoProt": item.TotalNovilhasNoProt,
            "NumNovilhasRepetiuNoProt": item.NumNovilhasRepetiuNoProt,
            "NumNovilhasPrenhasNoProt": item.NumNovilhasPrenhasNoProt,
            "TxPrenhez": item.TxPrenhez
        });
    })

    return dados;
}

function initDataTables() {
    var table = $('#tabTxPrenhezNovilhas').DataTable({
        columnDefs: [
            {targets: '_all', className: 'dt-center'},
        ],
        order: [[1, 'desc']],
        paging: false,
        buttons: [
            {extend: 'csv', title: $('.title').html(), className: 'btn btn-success btn-fill'},
            {extend: 'excel', title: $('.title').html(), className: 'btn btn-success btn-fill'},
            {extend: 'pdf', title: $('.title').html(), className: 'btn btn-success btn-fill'},
            {extend: 'print', title: $('.title').html(), className: 'btn btn-success btn-fill', text: 'Imprimir'}
        ]
    });

    table.buttons().container()
        .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    $('#tabTxPrenhezNovilhas_filter label input').addClass('form-control border-input');
}