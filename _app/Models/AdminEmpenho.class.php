<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminEmpenho
 *
 * @author Miguel
 */
class AdminEmpenho {

    private $dados;
    private $id;
    private $error;
    private $result;

    const entidade = "pe_empenho";

    public function getEmpenhosByFiltro($sec_id = 0, $ano = 0){
        $read = new Read();
        $and = '';
        $e = '';
        $where = '';
        if($sec_id != 0 && $ano != 0):
            $and = ' AND ';
            $e = '&';
        endif;
        if($sec_id != 0 || $ano != 0):
            $where = 'WHERE ';
        endif;
        $termos = $where.($sec_id == 0 ? '' : 'secretaria_id = :sec_id').$and.($ano == 0 ? '' : 'year(data_pag) = :ano');
        $parseString = ($sec_id == 0 ? '' : "sec_id={$sec_id}").$e.($ano == 0 ? '' : "ano={$ano}");

        $read->ExeRead(self::entidade, $termos, $parseString);
        if($read->getRowCount() > 0):
            $this->result = $read->getResult();
        else:
            $this->result = false;
        endif;
        
    }
    
    public function ExeCreate(array $dados) {
        $this->dados = $dados;
        $this->setDados();
        if ($this->Check()):
            $this->Create();
        endif;
    }

    public function ExeUpdate($id, array $dados) {
        $this->id = $id;
        $this->dados = $dados;
        $this->Update();
    }

    public function ExeSelect($id = 0) {
        $this->id = $id;
        $this->select();
    }
    

    public function ExeDelete($id) {
        $this->id = $id;
        $this->Delete();
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    private function setDados() {
        $this->dados['data_registro'] = date('Y-m-d H:i:s');
    }

    private function Check() {
        $readEmpenho = new Read;
        $readEmpenho->ExeRead(self::entidade, "WHERE id = :id", "id={$this->dados['id']}");
        if ($readEmpenho->getRowCount() > 0):
            $this->result = false;
            $this->error = ["A identificação {$this->dados['id']} já consta no sistema", WS_ALERT];
            return false;
        else:
            return true;
        endif;
    }

    private function select() {
        $read = new Read;
        $read->ExeRead(self::entidade, ($this->id != 0 ? 'WHERE id = :id' : '') . ' ORDER BY nome', ($this->id != 0 ? "id={$this->id}" : null));
        if ($read->getRowCount() > 0):
            $this->result = $read->getResult();
        else:
            $this->result = null;
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::entidade, $this->dados);
        if ($Create->getResult() != null):
            $this->result = true;
            $this->error = ["O empenho <b>{$this->dados['id']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::entidade, $this->dados, "WHERE id = :id", "id={$this->id }");
        if ($Update->getRowCount() > 0):
            $this->error = ["O Empenho <b>{$this->dados['id']}</b> foi atualizada com sucesso!", WS_ACCEPT];
            $this->result = true;
        endif;
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::entidade, "WHERE id = :id", "id={$this->id}");
        if ($Delete->getResult()):
            $this->result = true;
            $this->error = ["Empenho removido com sucesso", WS_ACCEPT];
        endif;
    }

}
