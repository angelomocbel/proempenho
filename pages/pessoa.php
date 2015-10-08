<?php

//RECUPERANDO ID DA PESSOA
$id = filter_input(INPUT_GET, 'id');
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$admin;
if(!empty($dados['salvar'])):
    unset($dados['salvar']);
    $admin = new AdminPessoa();
    $admin->ExeUpdate($id, $dados);
    if($admin->getResult()):
        header("Location: home.php?page=pessoa&id={$id}");
    endif;
endif;
//VERIFICANDO SE O ID FOI INFORMADO
if (!empty($id)):
    $admin = new AdminPessoa();
    $admin->ExeSelect($id);
    $read = new Read;
    $read->ExeRead("pe_pessoa", "WHERE id = :id", "id={$id}");
    if (!$admin->getResult()):
        WSErro("Pessoa não encontrada", WS_ERROR);
    else:
        $pessoa = $admin->getResult()[0];
        extract($pessoa, EXTR_PREFIX_ALL, 'p');
        $editar = filter_input(INPUT_GET, "editar");
        $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);
        if ($editar):
            echo "<div class='formulario'>";
            echo "<h2>Editar Pessoa</h2>";
            include 'forms/form_pessoa.php';
            echo "</div>";
        else:
            include 'info_pessoa.php';
        endif;
    endif;
else:
    WSErro("Pessoa não informada", WS_ERROR);
endif;