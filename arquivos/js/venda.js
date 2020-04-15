$("#formVenda").validate({
    rules: {
        idCliente: {
            required: true,
        },
        formaPagamento: {
            required: true,
        },
        parcelas: {
            required: true,
            min: 1
        },
        valor: {
            required: true,
        }

    },
    messages: {

        idCliente: {
            required: "Obrigatório*",
        },
        formaPagamento: {
            required: "Obrigatório*",
        },
        parcelas: {
            required: "Obrigatório*",
            min: "Mínimo de 1 parcela"
        },
        valor: {
            required: "Obrigatório*",
        }
    }
});
