function limpa_formulario_cep() {
    $('#endereco').val('');
    $('#bairro').val('');
    $('#estado').val('');
    $('#cidade').val('');
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        $('#endereco').val(conteudo.logradouro);
        $('#bairro').val(conteudo.bairro);
        $('#cidade').val(conteudo.localidade);
        $('#estado').val(conteudo.uf);


    } else {
        limpa_formulario_cep();
    }
}

function pesquisacep(valor) {
    console.log(valor);
    let cep = valor.replace(/\D/g, '');

    if (cep !== "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            document.getElementById('endereco').value = "...";
            document.getElementById('bairro').value = "...";

            var script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            document.body.appendChild(script);
        } else {
            limpa_formulario_cep();
            // alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulario_cep();
    }
}
