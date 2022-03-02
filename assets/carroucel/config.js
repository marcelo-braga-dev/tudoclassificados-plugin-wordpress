$(function () {
    $('.animado').hide();
    $(".slider").show();
    $(".espaco-carrocel").remove();

    $("div.card").mouseenter(function () {
        $("div.animado", this).stop();
        $("div.animado", this).toggle(400);
    }).mouseleave(function () {
        $("div.animado", this).stop();
        $("div.animado", this).toggle(400);
    });

    $(".slider").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        // dots: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

