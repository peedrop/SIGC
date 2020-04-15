$("#formLogin").validate({
    rules: {
        login: {
            required: true,
        },
        senha: {
            required: true,
        }
    },
    messages: {
        login: {
            required: "Obrigatório*",
        },
        senha: {
            required: "Obrigatório*",
        }
    }
});
