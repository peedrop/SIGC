function exibirRelogio() {

    var tempo = document.querySelector("#tempo");

    var temp = tempo.textContent;
    temp = temp.split(':');

    var minutos = parseInt(temp[0]);
    var segundos = parseInt(temp[1]);

    if ((segundos == 0) && (minutos == 0)) {
        alert('A sessão expirou..');
        location.href = '../login/LoginControlador.php?operacao=encerrar';
    } else {
        if (segundos == 0) {
            minutos = minutos - 1;
            segundos = 59
        } else {
            segundos = segundos - 1;
        }
    }

    var novoTempo = minutos + ":" + segundos;

    tempo.textContent = novoTempo;

    setTimeout("exibirRelogio()", 1000);

}
