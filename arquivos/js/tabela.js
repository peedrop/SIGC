$(document).ready(function () {
    $("#example1").dataTable({
        "scrollX": true,
        "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            }
        }
    })
});
$(function () {
    $('body').confirmation({
        selector: '[data-toggle="confirmation"]'
    });

    $('.confirmation-callback').confirmation({
        onConfirm: function (event, element) {
            alert('confirm')
        },
        onCancel: function (event, element) {
            alert('cancel')
        }
    });
});

function editarCliente(id) {
    window.location.href = "FormularioCliente.php?idCliente=" + id;
}
