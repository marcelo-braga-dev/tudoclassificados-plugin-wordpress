<?php

namespace TudoClassificados\App\src\Integracoes\Bling\Marketplace;

use TudoClassificados\App\src\Anuncios\Imagens\BaixarImagens;
use TudoClassificados\App\src\Anuncios\Imagens\CadastrarImagem;
use TudoClassificados\App\src\Anuncios\Marketplace\CadastrarAnuncioMarketplace;
use TudoClassificados\App\src\Anuncios\Marketplace\DadosAnuncioMarketplace;
use TudoClassificados\App\src\Classificados\DadosAnuncio;

class CadastrarProduto extends CadastrarAnuncioMarketplace
{
    private $dataExpiracao;
    private $tipo;

    public function __construct()
    {
        $this->dataExpiracao = date('Y-m-d H:i:s', strtotime('+60 days'));
        $this->tipo = 'marketplace';
    }

    public function cadastrar($produtos): void
    {
        $infoSelecionados = $_POST['produto'];
        $idSelecionados = $_POST['checks'];

        foreach ($produtos['produtos'] as $var) {
            $produto = $var->produto;
            $infos = $infoSelecionados[$produto->id];

            if (in_array($produto->id, $idSelecionados)) {

                if ($this->idEmpty($produto->id) && !$this->required($infos)) {
                    $qtdCadastrado++;

                    $idImagens = $this->imagens($produto->imagem);

                    $dados = new DadosAnuncioMarketplace();
                    $dados->preco = number_format($produto->preco, 2, '.', '');
                    $dados->origem = 'bling';
                    $dados->tipo = $this->tipo;
                    $dados->produto = $produto;
                    $dados->infos = $infos;
                    $dados->dataExpiracao = $this->dataExpiracao;
                    $dados->idImagens = $idImagens;

                    $this->store($dados, $terms = 10);
                }
            }
        }
    }

    private function idEmpty($id)
    {
        global $wpdb;

        return empty($wpdb->get_results("SELECT meta_id FROM class_postmeta WHERE meta_key = 'id' AND meta_value = '$id'"));
    }

    private function required($args): bool
    {
        return empty($args['largura']) ||
            empty($args['altura']) ||
            empty($args['profundidade']) ||
            empty($args['peso']);
    }

    private function imagens($imagens): array
    {
        $count_img = 0;
        $idImagens = [];

        foreach ($imagens as $argImg) {
            if ($count_img < 12) {
                $count_img++;
                $url = wp_strip_all_tags($argImg->link);
                $titulo = 'img';

                $imagens = new BaixarImagens();
                $urlImg = $imagens->download($url, $titulo, 'bling');

                $imagem = new CadastrarImagem();
                $idImagens[] = $imagem->cadastrar($argImg->NomeArquivo, $urlImg);
            }
        }

        return $idImagens;
    }

    private function descricaoAnuncio($produto)
    {
        $conteudoAnuncio = $produto->descricaoCurta;

        if ($produto->observacoes) {
            $conteudoAnuncio .= "\n\n Observa????es:\n" . $produto->observacoes . "\n\n";
        }

        if ($produto->pesoBruto) {
            $conteudoAnuncio .= "\n\n Peso bruto: " . round($produto->pesoBruto, 2) . ' kg';
        }
        if ($produto->pesoLiq) {
            $conteudoAnuncio .= "\n Peso l??quido: " . round($produto->pesoLiq, 2) . " kg \n\n";
        }

        if ($produto->larguraProduto) {
            $conteudoAnuncio .= "\n\n Largura: " . $produto->larguraProduto . ' ' . $produto->unidadeMedida;
        }
        if ($produto->alturaProduto) {
            $conteudoAnuncio .= "\n Altura: " . $produto->alturaProduto . ' ' . $produto->unidadeMedida;
        }
        if ($produto->profundidadeProduto) {
            $conteudoAnuncio .= "\n Profundidade: " . $produto->profundidadeProduto . ' ' . $produto->unidadeMedida;
        }

        if ($produto->descricaoComplementar) {
            $conteudoAnuncio .= "\n\n" . $produto->descricaoComplementar;
        }

        if ($produto->freteGratis == 'S') {
            $conteudoAnuncio .= "\n\n Frete Gr??tis." . $produto->freteGratis;
        }
    }
}