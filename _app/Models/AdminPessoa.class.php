<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminPessoa
 *
 * @author Miguel
 */
class AdminPessoa {

    private $dados;
    private $id;
    private $error;
    private $result;

    const entidade = "pe_pessoa";

    public function ExeCreate(array $dados) {
        $this->dados = $dados;
        $this->setDados();
        if ($this->checkPessoa()):
            $this->Create();
        endif;
    }

    public function ExeSelect($id = 0) {
        $read = new Read;
        $read->ExeRead(self::entidade, ($id != 0 ? 'WHERE id = :id' : '') . ' ORDER BY nome', ($id != 0 ? "id={$id}" : null));
        if ($read->getRowCount() > 0):
            $this->result = $read->getResult();
        else:
            $this->result = null;
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

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    private function setDados() {
        $this->dados['data_registro'] = date('Y-m-d H:i:s');
    }

    private function checkPessoa() {
        $ReadPessoa = new Read;
        $ReadPessoa->ExeRead(self::entidade, "WHERE cadastro = :cadastro", "cadastro={$this->dados['cadastro']}");
        if ($ReadPessoa->getRowCount() > 0):
            $this->result = false;
            $this->error = ["A identificação {$this->dados['cadastro']} já consta no sistema", WS_ALERT];
            return false;
        else:
            return true;
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::entidade, $this->dados);
        if ($Create->getResult()):
            $this->result = $Create->getResult();
            $this->error = ["A pessoa <b>{$this->dados['nome']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::entidade, $this->dados, "WHERE id = :id", "id={$this->id }");
        if ($Update->getResult()):
            $this->error = ["A Pessoa <b>{$this->dados['nome']}</b> foi atualizada com sucesso!", WS_ACCEPT];
            $this->result = true;
        else:
            $this->error = ["Não foi possivel atualizar", WS_ERROR];
            $this->result = false;
        endif;
    }

}
