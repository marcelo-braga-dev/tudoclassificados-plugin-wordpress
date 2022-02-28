<?php
$path = TUDOCLASSIFICADOS_PATH . "app/Helpers/";
$diretorio = dir($path);

while ($arquivo = $diretorio->read()) {
    if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'includes.php') {
        require_once $path . $arquivo;
    }
}

$diretorio->close();