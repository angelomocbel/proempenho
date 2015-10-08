<div class="formulario">
    <?php
    //RECUPERANDO ID DA PESSOA
    $pessoa_id = filter_input(INPUT_GET, 'pessoa_id');
    //VERIFICANDO SE O ID FOI INFORMADO
    if (!empty($pessoa_id)):
        $read = new Read();
        $read->ExeRead("pe_pessoa", "WHERE id = :id", "id={$pessoa_id}");
        //VERIFICANDO SE O ID CORRESPONDE A ALGUEM CADASTRADO
        if ($read->getRowCount() > 0):
            $nome = $read->getResult()[0]['nome'];
            echo "<h2>Empenho para: <a href='home.php?page=pessoa&id={$pessoa_id}'>{$nome}<a> </h2>";
            //RECUPERANDO DADOS PARA O CADASTRO
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //VERIFICANDO SE OS DADOS FORAM INFORMADOS
            if (!empty($dados['salvar'])):
                unset($dados['salvar']);
                $admin = new AdminEmpenho();
                //CADASTRANDO DADOS
                $admin->ExeCreate($dados);
                WSErro($admin->getError()[0], $admin->getError()[1]);
                if (!$admin->getResult()):
                    extract($dados, EXTR_PREFIX_ALL , 'em');
                    include 'forms/form_empenho.php';
                else:
                    echo "<p><a href='home.php?page=novoempenho&pessoa_id={$pessoa_id}'>Cadastrar novo empenho</a><a href='home.php?page=empenhos&pessoa_id={$pessoa_id}'>Ver empenhos</a></p>";
                endif;
            else:
                include 'forms/form_empenho.php';
            endif;
        else:
            WSErro("Pessoa não encontrada", WS_ERROR);
        endif;
    else:
        WSErro("Pessoa não informada", WS_ERROR);
    endif;
    ?>
</div>