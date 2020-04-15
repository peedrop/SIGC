$('#valor').mask("0000000.00", {
    reverse: true
});

$("#formDespesa").validate({
    rules: {
        nome: {
            required: true,
        },
        descricao: {
            required: true,
        },
        dataVencimento: {
            required: true,
        },
        valor: {
            required: true,
        },
        situacao: {
            required: true,
        }
    },
    messages: {
        nome: {
            required: "Obrigatório*",
        },
        descricao: {
            required: "Obrigatório*",
        },
        dataVencimento: {
            required: "Obrigatório*",
        },
        valor: {
            required: "Obrigatório*",
        },
        situacao: {
            required: "Obrigatório*",
        }
    }
});
