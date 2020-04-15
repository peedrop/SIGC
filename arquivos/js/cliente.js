
function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#estado").val("");
    $("#ibge").val("");
}

//Quando o campo cep perde o foco.
$("#cep").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");
            $("#ibge").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#estado").val(dados.uf);
                    $("#ibge").val(dados.ibge);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});
       
$('#cpf').mask("000.000.000-00", {
    reverse: true
});
$('#rg').mask("00.000.000", {
    reverse: true
});
$('#telefone').mask("(00)00000-0000");
$('#cep').mask("00.000-000", {
    reverse: true
});
$('#estado').mask("SS"); //S-> somente letras
$("#formCliente").validate({
    rules: {
        nome: {
            required: true,
        },
        cpf: {
            required: true,
            cpf: {
                cpf: true,
                required: true
            },
            remote: {
                url: "ClienteControlador.php?operacao=verificarCpf&idCliente=" + $("#idCliente").val(),
                type: "post",
                data: {
                    login: function () {
                        return $("#cpf").val();
                    }
                }
            }
        },
        rg: {
            required: true,
        },
        telefone: {
            required: true,
        },
        dataNascimento: {
            required: true,
        },
        cep: {
            required: true,
        },
        numero: {
            required: true,
        },
        complemento: {
            required: true,
        },
        rua: {
            required: true,
        },
        estado: {
            required: true,
        },
        cidade: {
            required: true,
        },
        bairro: {
            required: true,
        }
    },
    messages: {
        nome: {
            required: "Obrigatório*",
        },
        cpf: {
            required: "Obrigatório*",
            cpf: "CPF inválido*",
            remote: "CPF já cadastrado*"
        },
        rg: {
            required: "Obrigatório*",
        },
        telefone: {
            required: "Obrigatório*",
        },
        dataNascimento: {
            required: "Obrigatório*",
        },
        cep: {
            required: "Obrigatório*",
        },
        numero: {
            required: "Obrigatório*",
        },
        complemento: {
            required: "Obrigatório*",
        },
        rua: {
            required: "Obrigatório*",
        },
        estado: {
            required: "Obrigatório*",
        },
        cidade: {
            required: "Obrigatório*",
        },
        bairro: {
            required: "Obrigatório*",
        }
    }
});
jQuery.validator.addMethod("cpf", function (value, element) {
    value = jQuery.trim(value);

    value = value.replace('.', '');
    value = value.replace('.', '');
    cpf = value.replace('-', '');
    while (cpf.length < 11) cpf = "0" + cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) {
        a[9] = 0
    } else {
        a[9] = 11 - x
    }
    b = 0;
    c = 11;
    for (y = 0; y < 10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) {
        a[10] = 0;
    } else {
        a[10] = 11 - x;
    }

    var retorno = true;
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

    return this.optional(element) || retorno;

}, "CPF inválido*");
