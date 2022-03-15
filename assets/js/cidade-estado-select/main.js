$(function () {
    let selectEstadosClassi = $('.estados-classificados'),
        selectCidadesClassi = $('.cidades-classificados');

    let selectEstadosImoveis = $('.estados-imoveis'),
        selectCidadesImoveis = $('.cidades-imoveis');


    let url = '/wp-content/plugins/tudoclassificados/assets/js/cidade-estado-select/db-estados-cidades.json';

    $.getJSON(url, function (data) {
        let options = "<option value=''>Selecione um estado</option>";

        $.each(data.estados, function (key, val) {
            options += "<option value='" + val.sigla + "'> " + val.nome + "</option>";
        });

        selectEstadosClassi.html(options);
        selectEstadosClassi.change( function () {
            preencheCidade(data, selectEstadosClassi, selectCidadesClassi);
        });

        selectEstadosImoveis.html(options);
        selectEstadosImoveis.change( function () {
            preencheCidade(data, selectEstadosImoveis, selectCidadesImoveis);
        });
    });

    function preencheCidade(data, selectEstados, selectCidades) {
        let estado = data.estados.find(function (estado) {
            return selectEstados.val() === estado.sigla;
        });

        let options = "<option value=''>Selecione uma cidade</option>";

        $.each(estado.cidades, function (key, val) {
            options += "<option value='" + val + "'> " + val + "</option>";
        });

        selectCidades.html(options);
        $('.cidade-select').show();
    }

    // function cidadeAnuncio(data) {
    //     if (estado) {
    //         selectEstadosClassi.val(estado).select2();
    //         preencheCidade(data);
    //         selectCidadesClassi.val(cidade).select2();
    //     }
    // }
});