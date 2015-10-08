<?php
$admin = new AdminBanco;
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['salvar'])):
    unset($dados['salvar']);
    $admin->ExeCreate($dados);
endif;
?>
<div >
    <h2>Novo Banco</h2>
    <?php
    if ($admin->getResult()):
        WSErro($admin->getError()[0], $admin->getError()[1]);
    endif;
    ?>
    <form method="post" action="">
        <fieldset>
            <p class="p50">
                <label for="campo_sigla">Sigla</label>
                <input class="entrada_form" type="text" name="sigla" id="campo_sigla"/>
            </p>
            <p class="p50">
                <label for="campo_nome">Nome</label>
                <input class="entrada_form" type="text" name="nome" id="campo_nome"/>
            </p>
        </fieldset>
        <p class="p100">
            <input class="botao_form" type="reset" name="limpar" value="Limpar"/>
            <input class="botao_form" type="submit" name="salvar" value="Salvar"/>
        </p>
    </form>
</div>
<div >
    <h2>Bancos Cadastrados</h2>
    <form method="get" action="">
        <p class="p100">

            <select name="bancos" id="lista_bancos" size="5">
                <?php
                $admin->ExeSelect();
                $bancos = $admin->getResult();
                if ($bancos):
                    foreach ($bancos as $banco):
                        echo "<option value=\"{$banco['id']}\">{$banco['nome']}</option>";
                    endforeach;
                endif;
                ?>
            </select>
        </p>
        <p class="p100">
            <input class="botao_form" type="submit" name="acao" value="Editar"/>
            <input class="botao_form" type="submit" name="acao" value="Deletar"/>
        </p>
    </form>
</div>