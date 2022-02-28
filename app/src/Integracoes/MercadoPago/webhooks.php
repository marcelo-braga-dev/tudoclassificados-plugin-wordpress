<?php

class ConstantesDB
{
    protected const DB_HOST = 'localhost';
    protected const DB_USER = 'tudocl45_tudoclassceo';
    protected const DB_PASS = '^4)wW{]wQyjS';
    const DB_NAME = 'tudocl45_tudoclassi1';

    public function salvarWebhooks()
    {
        $this->conectaTabela();

        $salvar = $this->mysql->prepare("INSERT INTO `class_imp_contas_premium` 
                                          ( 
                                             `pacote`                                            
                                          ) 
                                       VALUES (?)");
        $salvar->bind_param(
            's',
            $_GET['topic']
        );
        echo $salvar->execute();
    }

    protected function conectaTabela()
    {
        $mysql = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
        $mysql->set_charset('utf8');

        if ($mysql == FALSE) {
            echo "Erro na conexão";
            exit();
        }

        $this->mysql = $mysql;
    }
}

$salvar = new ConstantesDB();
$salvar->salvarWebhooks();
