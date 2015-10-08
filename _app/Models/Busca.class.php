<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Busca
 *
 * @author Miguel
 */
class Busca {
    private $dados;
    private $result;
    private $error;

    public function ExeSearch(array $dados){
        $this->dados = $dados;
        $this->Search();
    }


    private function Search(){
        $entidade = "pe_".$this->dados['entidade'];
        $busca = $this->dados['busca'];
        $termos = '';
        $parseString = "busca={$busca}";
        if($entidade == "pe_pessoa"){
            $termos = "WHERE nome LIKE '%' :busca '%' OR nome_fantasia LIKE '%' :busca '%' OR cadastro LIKE '%' :busca '%' OR email LIKE '%' :busca '%'";
        } elseif ($entidade == "pe_empenho"){
            $termos = "WHERE id LIKE '%' :busca '%' OR numero_doc LIKE '%' :busca '%' OR descricao LIKE '%' :busca '%' OR obs LIKE '%' :busca '%'";
        }
        $readBusca = new Read;
        $readBusca->ExeRead($entidade, $termos, $parseString);

        if($readBusca->getRowCount() > 0){
            $this->result = $readBusca->getResult();
            $this->error = null;
        } else {
            $this->result = false;
            $this->error = ["Nenhum registro encontrado em {$entidade} para a busca {$busca}", WS_ALERT];
        }
        //var_dump($readBusca);
    }
    function getResult() {
        return $this->result;
    }

    function getError() {
        return $this->error;
    }


}
