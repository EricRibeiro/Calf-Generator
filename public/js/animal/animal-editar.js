
      
      $('#animais tbody').on( 'click', 'tr', function () {
        
        jQuery("#modals").detach().appendTo('body');
        var table = $('#animais').DataTable();
        var linhaSelecionada= table.row(this).index();
        var data = table.rows(linhaSelecionada).data();
        var infoAnimal=data[0];
        var idAnimal=infoAnimal[0];
        var numeroAnimal=infoAnimal[1];
        var classificacao=infoAnimal[2];
        var dataUltimoParto=infoAnimal[7];
        var classificacaoId=infoAnimal[8];
        var qtdIasNaEstacaoAtual=infoAnimal[9];

        alert(qtdIasNaEstacaoAtual);

        $("select").html('');

        $("input[name='numero']").val(numeroAnimal);
        
        $("input[name=dataUltimoParto]").val(dataUltimoParto);
        
        $("[name=idAnimal]").val(idAnimal);

        var o= "<option selected value='" +classificacaoId+ "'>" +classificacao+ "</option>";

        $('select').append(o);

        showSelectOptions();
        disableDataUltimoParto();


    });

      function showSelectOptions() {
        var classificacoes = getClassificacoes();
        var $select = $('select');
        var classificacao = $("option:selected", $select).val();

        $.each(classificacoes, function (key, value) {
            var option = "";

            if(classificacao !== key)
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


