<?php
function tc_pagination()
{
    if (empty($paged)) {
        if ($_GET['page_index']) {
            $paged = $_GET['page_index'];
        } else {
            $paged = 1;
        }

        $paged = absint($paged);
    }

    function gerarLink($page)
    {
        $parse = parse_url($_SERVER['REQUEST_URI']);
        $url = $parse['path'];

        parse_str($parse['query'], $query);
        $query['page_index'] = $page;

        return $_SERVER['REQUEST_SCHEME'] . '://' .
            $_SERVER['HTTP_HOST'] .
            $url . '?' .
            http_build_query($query);
    }

    $numPageBack = $paged - 1;
    $numPageNext = $paged + 1;

    $urlPageBack = gerarLink($numPageBack);
    $urlPageNext = gerarLink($numPageNext);
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="<?= $urlPageBack; ?>" tabindex="-1">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php if ( $numPageBack) : ?>
                <li class="page-item"><a class="page-link" href="<?= $urlPageBack; ?>"><?= $numPageBack ?></a></li>
            <?php endif; ?>
            <li class="page-item active"><a class="page-link"><?= $paged ?></a></li>
            <li class="page-item"><a class="page-link" href="<?= $urlPageNext; ?>"><?= $numPageNext ?></a></li>
            <li class="page-item">
                <a class="page-link" href="<?= $urlPageNext; ?>">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php
}