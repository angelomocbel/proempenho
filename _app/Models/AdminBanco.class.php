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

    private $Dados;
    private $id;
    private $Error;
    private $Result;

    const Entidade = "pe_banco";

    public function ExeCreate(array $Dados) {
        $this->Dados = $Dados;
        if ($this->Check()):
            $this->Create();
        endif;
    }

    public function ExeUpdate($Banco_id, array $Dados) {
        $this->id = $Banco_id;
        $this->Dados = $Dados;
    }

    public function ExeDelete($Banco_id) {
        $this->id = $Banco_id;
    }

    public function ExeSelect($banco_id = 0) {
        $ReadBanco = new Read;
        $ReadBanco->ExeRead(self::Entidade, ($banco_id != 0 ? 'WHERE id :id' : null) . ' ORDER BY sigla', ($banco_id != 0 ? "id={$banco_id}" : null));
        if ($ReadBanco->getRowCount() > 0):
            $this->Result = $ReadBanco->getResult();
        else: 
            $this->Result = null;
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function Check() {
        $ReadBanco = new Read;
        $ReadBanco->ExeRead(self::Entidade, "WHERE sigla = :sigla || nome = :nome", "sigla={$this->Dados['sigla']}&nome={$this->Dados['nome']}");
        if ($ReadBanco->getRowCount() > 0):
            $this->Result = false;
            $this->Error = ["O registro de {$this->Dados['nome']} já consta no sistema", WS_ALERT];
            return false;
        else:
            return true;
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entidade, $this->Dados);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["O registro de <b>{$this->Dados['nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entidade, $this->Dados, "WHERE banco_id = :id", "id={$this->id }");
        if ($Update->getRowCount() >= 1):
            $this->Error = ["O registro de <b>{$this->Dados['nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}
