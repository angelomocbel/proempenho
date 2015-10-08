<?php

//RECUPERANDO ID DO EMPENHO
$id = filter_input(INPUT_GET, 'id');
//VERIFICANDO SE O ID FOI INFORMADO
if (!empty($id)):
    $read = new Read;
    $read->ExeRead("pe_empenho", "WHERE id = :id", "id={$id}");
    if (count($read->getResult()) == 0):
        WSErro("Empenho não encontrado", WS_ERROR);
    else:
        $empenho = $read->getResult()[0];
        extract($empenho, EXTR_PREFIX_ALL, 'em');
        $editar = filter_input(INPUT_GET, "editar");
        $excluir = filter_input(INPUT_GET, "excluir");
        $read->ExeRead("pe_pessoa", "WHERE id = :id", "id={$em_pessoa_id}");
        $pessoa = $read->getResult()[0];
        if ($excluir): 
            $admin = new AdminEmpenho();
            $admin->ExeDelete($id);
            if($admin->getResult()): 
                header("Location: home.php?page=empenhos&pessoa_id={$em_pessoa_id}");
            endif;
        endif;
        if ($editar):
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($dados['salvar'])):
                unset($dados['salvar']);
                $admin = new AdminEmpenho();
                $admin->ExeUpdate($id, $dados);
                if($admin->getResult()): 
                    header("Location: home.php?page=empenhos&pessoa_id={$em_pessoa_id}");
                endif;
            endif;
            echo "<div class='formulario'>";
            echo "<h2>Editar Empenho para {$pessoa['nome']}</h2>";
            include '/pages/forms/form_empenho.php';
            echo "</div>";
        else:
            include '/pages/info_empenho.php';
        endif;
    endif;
else:
    WSErro("Empenho não informado", WS_ERROR);
endif;