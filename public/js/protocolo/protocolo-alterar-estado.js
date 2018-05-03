window.onload = function () {
    createAnimalList();
    updateAnimalList();
};

var animais = [];

function createAnimalList() {
    $("tbody tr").each(function () {
        var idAnimal = $(this).children('#idAnimal').html();
        var idEstado = $(this).find("select[name='estado']").val();
        animais.push(idAnimal + "/" + idEstado);
    });

    $("input[name='lsIDsAnimaisEstados']").val(animais.join("-"));
}

function updateAnimalList() {
    $('select').change(function () {
        var idAnimal = $(this).parent().prevAll("#idAnimal").html();
        var idEstado = $(this).val();
        var elemento =  idAnimal + "/" + idEstado;

        animais = animais.filter(e => e.charAt(0) !== idAnimal);
        animais.push(elemento);

        $("input[name='lsIDsAnimaisEstados']").val(animais.join("-"));
    });
}