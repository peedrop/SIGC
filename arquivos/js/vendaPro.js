$("#formPedidoProduto").validate({
    rules: {
        idProdRem: {
            required: true,
        },
        quantidade: {
            required: true,
            min: 1
        }

    },
    messages: {

        idProdRem: {
            required: "Obrigatório*",
        },
        quantidade: {
            required: "Obrigatório*",
            min: "Mínimo 1 peça"
        }
    }
});
