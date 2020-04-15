$("#formUsuario").validate({
    rules: {
        login: {
            required: true,
            minlength: 3,
            remote: {
                url: "UsuarioControlador.php?operacao=verificarLogin&idUsuario=" + $("#idUsuario").val(),
                type: "post",
                data: {
                    login: function () {
                        return $("#login").val();
                    }
                }
            }
        },
        senha: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        }
    },
    messages: {
        login: {
            required: "Obrigatório*",
            minlength: "Mínimo 3 caracteres*",
            remote: "Login já cadastrado*"
        },
        senha: {
            required: "Obrigatório*",
        },
        email: {
            required: "Obrigatório*",
            email: "E-mail inválido*",
        }
    }
});
