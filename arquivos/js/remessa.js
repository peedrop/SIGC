$('#quantidade').mask("0000000000", {
    reverse: true
});
$('#precoCusto').mask("00000000.00", {
    reverse: true
});
$('#precoVarejo').mask("00000000.00", {
    reverse: true
});
jQuery.validator.addMethod("validarPreco", function (value, element) {

        var retorno = true;

        var custo = parseFloat($("#precoCusto").val());
        var varejo = parseFloat($("#precoVarejo").val());

        console.log(custo);
        console.log(varejo);

        if (custo > varejo) {
            retorno = false;
        }

        return retorno;

    },

    "O preço varejo deve ser maior ou igual ao preço de custo*"
);
$("#formRemessa").validate({
    rules: {
        idProduto: {
            required: true,
        },
        precoCusto: {
            required: true,
        },
        precoVarejo: {
            required: true,
            validarPreco: true
        },
        quantidade: {
            required: true,
        },
        dataRemessa: {
            required: true,
        }
    },
    messages: {
        idProduto: {
            required: "Obrigatório*",
        },
        precoCusto: {
            required: "Obrigatório*",
        },
        precoVarejo: {
            required: "Obrigatório*",
            validarEstoque: "O preço varejo deve ser maior ou igual ao preço de custo*"
        },
        quantidade: {
            required: "Obrigatório*",
        },
        dataRemessa: {
            required: "Obrigatório*"
        }
    }
});
