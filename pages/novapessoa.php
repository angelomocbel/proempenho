<div class="formulario">
    <h2>Cadastrar Pessoa</h2>
    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($dados)):
        unset($dados['salvar']);
        $admin = new AdminPessoa();
        $admin->ExeCreate($dados);
        WSErro($admin->getError()[0], $admin->getError()[1]);
        if (!$admin->getResult()):
            extract($dados, EXTR_PREFIX_ALL, 'p');
            include 'forms/form_pessoa.php';
        else:
            $id = $admin->getResult();
            echo "<p>";
            echo "<a href='home.php?page=novoempenho&pessoa_id={$id}'>Cadastrar Empenho</a>";
            echo "<a href='home.php?page=novapessoa'>Cadastrar nova Pessoa</a>";
            echo "</p>";
        endif;
    else:
        include 'forms/form_pessoa.php';
    endif;
    ?>
</div>