<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminLogin
 *
 * @author Miguel
 */
class AdminUsuario {

    private $dados;
    private $id;
    private $error;
    private $result;

    const entidade = "pe_usuario";

    public function ExeCreate(array $dados) {
        $this->dados = $dados;
        $this->setDados();
        if ($this->check()) {
            $this->create();
        }
    }

    public function ExeSelect($id = 0) {
        $this->id = $id;
        $this->select();
    }

    public function ExeUpdate($id, array $dados) {
        $this->id = $id;
        $this->dados = $dados;
    }

    public function ExeDelete($id) {
        $this->id = $id;
        $this->delete();
    }

    public function ExeLogin(array $dados) {
        $email = $dados['email'];
        $senha = md5($dados['senha']);
        $readUsuario = new Read;
        $readUsuario->ExeRead(self::entidade, "WHERE email = :email AND senha = :senha", "email={$email}&senha={$senha}");
        var_dump($readUsuario);
        if ($readUsuario->getRowCount() > 0) {
            $this->result = $readUsuario->getResult();
            $this->error = ["Login efetuado com sucesso", WS_ACCEPT];
            $this->setUsuario();
        } else {
            $this->result = true;
            $this->error = ["Email ou senha incorretos", WS_ALERT];
        }
    }

    public function ExeLogout() {
        if (!session_id()):
            session_start();
        endif;
        session_destroy();
    }

    public function checkLogin() {
        if (empty($_SESSION['usuario'])):
            unset($_SESSION['usuario']);
            return false;
        else:
            return true;
        endif;
    }

    public function getUsuario() {
        return $_SESSION['usuario'][0];
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    private function setDados() {
        $this->dados['senha'] = md5($this->dados['senha']);
    }

    private function check() {
        $readUsuario = new Read;
        $readUsuario->ExeRead(self::entidade, "WHERE email = :email", "email={$this->dados['email']}");
        if ($readUsuario->getRowCount() > 0) {
            $this->result = false;
            $this->error = ["O email informado, {$this->dados['email']}, já consta no sistema, informe outro email", WS_ALERT];
            return false;
        } else {
            return true;
        }
    }

    private function setUsuario() {
        if (!session_id()):
            session_start();
        endif;
        $_SESSION['usuario'] = $this->result;
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

    private function create() {
        $create = new Create;
        $create->ExeCreate(self::entidade, $this->dados);
        if ($create->getResult()):
            $this->result = $create->getResult();
            $this->error = ["O usuário <b>{$this->dados['nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
        endif;
    }

    private function delete() {
        $delete = new Delete();
        $delete->ExeDelete(self::entidade, "WHERE id = :id", "id={$this->id}");
        if ($delete->getResult()):
            $this->result = $delete->getResult();
            $this->error = ["Removido com sucesso", WS_ACCEPT];
        endif;
    }

}
