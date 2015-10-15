<?php
    $id = (empty($em_numero_doc) ? '' : $em_id );
    $numero_doc = (empty($em_numero_doc) ? '' : $em_numero_doc );
    $descricao = (empty($em_descricao) ? '' : $em_descricao);
    $valor_bruto = (empty($em_valor_bruto) ? '' : $em_valor_bruto);
    $valor_liquido = (empty($em_valor_liquido) ? '' : $em_valor_liquido);
    $banco_id = (empty($em_banco_id) ? '' : $em_banco_id);
    $conta = (empty($em_conta) ? '' : $em_conta);
    $cheque = (empty($em_cheque) ? '' : $em_cheque);
    $secretaria_id = (empty($em_secretaria_id) ? '' : $em_secretaria_id);
    $data_pag = (empty($em_data_pag) ? '' : $em_data_pag);
    $obs = (empty($em_obs) ? '' : $em_obs);
    $pessoa_id = (empty($em_pessoa_id) ? '' : $em_pessoa_id);
?>
<form method="post" action="">
    <input type="hidden" name="pessoa_id" value="<?= $pessoa_id ?>"/>
    <fieldset><legend>Dados gerais</legend>
        <p class="p100">
            <label for="campo_descricao">Descrição</label>
            <input class="w95" type="text" name="descricao" id="campo_descricao" value="<?= $descricao ?>" />

        </p>
        <p class="p50">
            <label for="campo_id">NE/OP</label>
            <input type="text" name="id" id="campo_id" value="<?= $id ?>" />
        </p>
        <p class="p50">
            <label for="campo_numero_doc">Nº Documento</label>
            <input class="entrada_form" type="text" name="numero_doc" id="campo_numero_doc" value="<?= $numero_doc ?>" />
        </p>
    </fieldset>
    <fieldset><legend>Valores</legend>
        <p class="p50">
            <label for="campo_valor_bruto">Valor Bruto</label>
            <input class="entrada_form" type="text" name="valor_bruto" id="campo_valor_bruto" value="<?= $valor_bruto ?>" />
        </p>
        <p class="p50">
            <label for="campo_valor_liquido">Valor Líquido</label>
            <input class="entrada_form" type="text" name="valor_liquido" id="campo_valor_liquido" value="<?= $valor_liquido ?>" />
        </p>
    </fieldset>
    <fieldset><legend>Informações bancárias</legend>
        <p class="p100">
            <label for="campo_banco">Banco*</label>
            <select class="entrada_form" name="banco_id" id="campo_banco">
                <?php
                $adminBanco = new AdminBanco;
                $adminBanco->ExeSelect(0);
                $bancos = $adminBanco->getResult();
                if ($bancos):
                    echo "<option disabled selected >Selecione</option>";
                    foreach ($bancos as $banco):
                        echo "<option ".  ($banco_id == $banco['id'] ? 'selected' : '') ." value='{$banco['id']}'>{$banco['nome']}</option>";
                    endforeach;
                else:
                    echo "<option disabled >Nenhum registro</option>";
                endif;
                ?>
            </select>
        </p>
        <p class="p50">
            <label for="campo_conta">Conta*</label>
            <input class="entrada_form" type="text" name="conta" id="campo_conta" value="<?= $conta ?>" />
        </p>
        <p class="p50">
            <label for="campo_cheque">Cheque*</label>
            <input class="entrada_form" type="text" name="cheque" id="campo_cheque" value="<?= $cheque ?>"/>
        </p>
    </fieldset>
    <fieldset><legend>Informações Adicionais</legend>
        <p class="p100">
            <label for="campo_secretaria">Secretaria*</label>
            <select class="w95" name="secretaria_id" id="campo_secretaria">
                <?php
                $adminSec = new AdminSecretaria;
                $adminSec->ExeSelect(0);
                $secretarias = $adminSec->getResult();
                if ($secretarias):
                    echo "<option disabled selected >Selecione</option>";
                    foreach ($secretarias as $secretaria):
                        echo "<option ".($secretaria_id == $secretaria['id'] ? 'selected' : '')." value='{$secretaria['id']}'>{$secretaria['nome']}</option>";
                    endforeach;
                else:
                    echo "<option disabled >Nenhuma registro</option>";
                endif;
                ?>
            </select>
        </p>
        <p class="p50">
            <label for="campo_data_pag">Data de pagamento</label>
            <input class="entrada_form" type="date" name="data_pag" id="campo_data_pag" value="<?= $data_pag ?>"/>
        </p>
        <p class="p50">
            <label for="campo_obs">Observação</label>
            <textarea class="entrada_form" name="obs" id="campo_obs"><?= $obs ?></textarea>
        </p>
    </fieldset>
    <p>
        <input type="reset" value="Limpar" name="limpar" />
        <input type="submit" value="Salvar" name="salvar" />
    </p>
</form>