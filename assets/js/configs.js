$(document).ready(function () {
    $('.select2').select2({
        // theme: 'bootstrap4',
    });

    $('.adsbygoogle').show();
});

$(function (){
    $('#modalCadastroCep').modal('show');
    $('#modalSucesso').modal('show')
})

$.LoadingOverlaySetup({
    background: "rgba(0, 0, 0, 0.5)",
    //     imageAnimation  : "1.5s fadein",
    imageColor: "#004da9",
    imageAutoResize: true,
    imageResizeFactor: 0.5,
});