<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminSecretaria
 *
 * @author Miguel
 */
class AdminSecretaria {

    private $dados;
    private $id;
    private $result;
    private $error;

    const entidade = "pe_secretaria";

    public function ExeCreate(array $Dados) {
        $this->dados = $Dados;
        if ($this->Check()):
            $this->Create();
        endif;
    }

    public function ExeSelect($id = 0) {
        $this->id = $id;
        $this->select();
    }

    public function ExeUpdate($Secretaria_id, array $Dados) {
        $this->id = $Secretaria_id;
        $this->dados = $Dados;
    }

    public function ExeDelete($Secretaria_id) {
        $this->id = $Secretaria_id;
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    private function Check() {
        $ReadSecretaria = new Read;
        $ReadSecretaria->ExeRead(self::entidade, "WHERE codigo = :codigo || nome = :nome", "codigo={$this->dados['codigo']}&nome={$this->dados['nome']}");
        if ($ReadSecretaria->getRowCount() > 0):
            $this->result = true;
            $this->error = ["O registro de {$this->dados['nome']} já consta no sistema", WS_ALERT];
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
        if ($Create->getResult()):
            $this->result = true;
            $this->error = ["O registro de <b>{$this->dados['nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::entidade, $this->dados, "WHERE secretaria_id = :id", "id={$this->id }");
        if ($Update->getRowCount() >= 1):
            $this->error = ["O registro de <b>{$this->dados['nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->result = true;
        endif;
    }

}
