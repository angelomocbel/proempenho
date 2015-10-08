<?php
$admin = new AdminSecretaria;
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['salvar'])):
    unset($dados['salvar']);
    $admin->ExeCreate($dados);
endif;
?>
<div>
    <h2>Nova Secretaria</h2>
    <form method="post" action="">
        <?php
        if ($admin->getResult()):
            WSErro($admin->getError()[0], $admin->getError()[1]);
        endif;
        ?>
        <fieldset>
            <p class = "p50">
                <label for="campo_sigla">Sigla</label>
                <input type="text" name="codigo" id="campo_sigla"/>
            </p>
            <p class = "p50">
                <label for="campo_nome">Nome</label>
                <input type="text" name="nome" id="campo_nome"/>
            </p>
        </fieldset>
        <p class = "p100">
            <input type="reset" name="limpar" value="Limpar"/>
            <input type="submit" name="salvar" value="Salvar"/>
        </p>
    </form>
</div>
<div>
    <h2>Secretarias Cadastradas</h2>
    <form method="get" action="">
        <p class = "p100">

            <select name="secretaria" id="lista_secretarias" size="10">
                <?php
                $admin->ExeSelect();
                $secretarias = $admin->getResult();
                if ($secretarias):
                    foreach ($secretarias as $secretaria):
                        echo "<option value=\"{$secretaria['id']}\">{$secretaria['nome']}</option>";
                    endforeach;
                else:
                    echo "<option disabled>Nenhum registro</option>";
                endif;
                ?>
            </select>
        </p>
        <p class = "p100">
            <input class="botao_form" type="submit" name="acao" value="Editar"/>
            <input class="botao_form" type="submit" name="acao" value="Deletar"/>
        </p>
    </form>
</div>