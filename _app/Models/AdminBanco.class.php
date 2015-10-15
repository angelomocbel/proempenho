<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminBanco
 *
 * @author Miguel
 */
class AdminBanco {

    private $dados;
    private $id;
    private $error;
    private $result;

    const entidade = "pe_banco";

    public function ExeCreate(array $dados) {
        $this->dados = $dados;
        if ($this->Check()):
            $this->Create();
        endif;
    }

    public function ExeUpdate($id, array $dados) {
        $this->id = $id;
        $this->dados = $dados;
        $this->Update();
    }

    public function ExeDelete($id) {
        $this->id = $id;
    }

    public function ExeSelect($id = 0) {
        $this->id = $id;
        $this->select();
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    private function Check() {
        $ReadBanco = new Read;
        $ReadBanco->ExeRead(self::entidade, "WHERE sigla = :sigla || nome = :nome", "sigla={$this->dados['sigla']}&nome={$this->dados['nome']}");
        if ($ReadBanco->getRowCount() > 0):
            $this->result = false;
            $this->error = ["O registro de {$this->dados['nome']} já consta no sistema", WS_ALERT];
            return false;
        else:
            return true;
        endif;
    }

    private function select() {
        $ReadBanco = new Read;
        $ReadBanco->ExeRead(self::entidade, ($this->id != 0 ? 'WHERE id = :id' : null) . ' ORDER BY sigla', ($this->id != 0 ? "id={$this->id}" : null));
        if ($ReadBanco->getRowCount() > 0):
            $this->result = $ReadBanco->getResult();
        else:
            $this->result = null;
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::entidade, $this->dados);
        if ($Create->getResult()):
            $this->result = $Create->getResult();
            $this->error = ["O registro de <b>{$this->dados['nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::entidade, $this->dados, "WHERE id = :id", "id={$this->id }");
        if ($Update->getRowCount() >= 1):
            $this->error = ["O registro de <b>{$this->dados['nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->result = true;
        endif;
    }

}
