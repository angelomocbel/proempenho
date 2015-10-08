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

    const Entidade = "pe_empenho";

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
        $readEmpenho->ExeRead(self::Entidade, "WHERE id = :id", "id={$this->dados['id']}");
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
        $Create->ExeCreate(self::Entidade, $this->dados);
        if ($Create->getResult() != null):
            $this->result = true;
            $this->error = ["O empenho <b>{$this->dados['id']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entidade, $this->dados, "WHERE id = :id", "id={$this->id }");
        if ($Update->getRowCount() > 0):
            $this->error = ["O Empenho <b>{$this->dados['id']}</b> foi atualizada com sucesso!", WS_ACCEPT];
            $this->result = true;
        endif;
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entidade, "WHERE id = :id", "id={$this->id}");
        if ($Delete->getResult()):
            $this->result = true;
            $this->error = ["Empenho removido com sucesso", WS_ACCEPT];
        endif;
    }

}
