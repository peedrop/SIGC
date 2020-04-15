$('#estoqueMin').mask("0000000000", {
    reverse: true
});
$('#quantidade').mask("0000000000", {
    reverse: true
});
$('#valor').mask("00000000.00", {
    reverse: true
});
$("#formProduto").validate({
    rules: {
        nome: {
            required: true,
        },
        idTipo: {
            required: true,
        },
        idMarca: {
            required: true,
        },
        estoqueMin: {
            required: true,
        },
        descricao: {
            required: true,
        },
        quantidade: {
            required: true,
        },
        valor: {
            required: true
        }
    },
    messages: {
        nome: {
            required: "Obrigatório*",
        },
        idTipo: {
            required: "Obrigatório*",
        },
        idMarca: {
            required: "Obrigatório*",
        },
        estoqueMin: {
            required: "Obrigatório*",
        },
        descricao: {
            required: "Obrigatório*",
        },
        quantidade: {
            required: "Obrigatório*",
        },
        valor: {
            required: "Obrigatório*"
        }
    }
});
