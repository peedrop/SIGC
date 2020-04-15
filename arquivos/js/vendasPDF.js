jQuery.validator.addMethod("validarDatas", function (value, element) {

        var retorno = true;

        var inicio = Date.parse($("#inicio").val());
        var fim = Date.parse($("#fim").val());

        console.log(inicio);
        console.log(fim);

        if (inicio > fim) {
            retorno = false;
        }

        return retorno;

    },

    "Data final deve ser maior ou igual a data inicial*"
);
$("#formVendasPDF").validate({
    rules: {
        inicio: {
            required: true,
        },
        fim: {
            required: true,
            validarDatas: true,
        }
    },
    messages: {
        inicio: {
            required: "Obrigatório*",
        },
        fim: {
            required: "Obrigatório*",
            validarDatas: "Data final deve ser maior ou igual a data inicial*"
        }
    }
});
