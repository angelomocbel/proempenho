<?php
$tipo = (empty($p_tipo) ? '' : $p_tipo);
$nome = (empty($p_nome) ? '' : $p_nome);
$cadastro = (empty($p_cadastro) ? '' : $p_cadastro);
$nome_fantasia = (empty($p_fantasia) ? '' : $p_fantasia);
$endereco = (empty($p_endereco) ? '' : $p_endereco);
$bairro = (empty($p_bairro) ? '' : $p_bairro);
$cidade = (empty($p_cidade) ? '' : $p_cidade);
$estado = (empty($p_estado) ? '' : $p_estado);
$cep = (empty($p_cep) ? '' : $p_cep);
$telefone = (empty($p_telefone) ? '' : $p_telefone);
$celular = (empty($p_celular) ? '' : $p_celular);
$email = (empty($p_email) ? '' : $p_email);
$banco_id = (empty($p_banco_id) ? '' : $p_banco_id);
$agencia = (empty($p_agencia) ? '' : $p_agencia);
$conta = (empty($p_conta) ? '' : $p_conta);
?>
<form name = "nova_pessoa" method = "post" action = "">
    <p class = "p100">
        <label for = "campo_tipo">Tipo: </label>
        <select name = "tipo" id = "campo_tipo">
            <option disabled <?= (empty($tipo) ? 'selected' : '') ?> = "">Selecione</option>
            <option <?= ($tipo == "1" ? 'selected' : '') ?> value = "1">FÍSICA</option>
            <option <?= ($tipo == "2" ? 'selected' : '') ?> value = "2">JURÍDICA</option>
        </select>
    </p>
    <fieldset><legend>Identificação</legend>
        <p class = "p100">
            <label for = "campo_nome">Razão Social/Nome*</label>
            <input class = "w95" type = "text" name = "nome" id = "campo_nome" required value="<?= $nome ?>" />
        </p>
        <p class = "p50">
            <label for = "campo_cadastro">CPF/CNPJ*</label>
            <input type = "text" name = "cadastro" id = "campo_cadastro" required value="<?= $cadastro ?>" />
        </p>
        <p class = "p50">
            <label for = "campo_nome_fantasia">Nome Fantasia</label>
            <input type = "text" name = "nome_fantasia" id = "campo_nome_fantasia" value="<?= $nome_fantasia ?>" />
        </p>
    </fieldset>
    <fieldset><legend>Localização</legend>
        <p class = "p100">
            <label for = "campo_endereco">Endereço</label>
            <input class = "w95" type = "text" name = "endereco" id = "campo_endereco" required value="<?= $endereco ?>" />
        </p>
        <p class = "p50">
            <label for = "campo_bairro">Bairro</label>
            <input type = "text" name = "bairro" id = "campo_bairro" required value="<?= $bairro ?>" />
        </p>
        <p class = "p50">
            <label for = "campo_municipio">Cidade*</label>
            <input type = "text" name = "cidade" id = "campo_municipio" required list = "cidades" value="<?= $cidade ?>" />
        </p>
        <p class = "p50">
            <label for = "campo_estado">Estado*</label>
            <select name = "estado" id = "campo_estado" >
                <option <?= ($estado == "PA" ? 'selected' : '') ?> value = "PA">Pará</option>
                <option <?= ($estado == "MA" ? 'selected' : '') ?> value = "MA">Maranhão</option>
            </select>
        </p>
        <p class = "p50">
            <label for = "campo_cep">CEP*</label>
            <input type = "text" name = "cep" id = "campo_cep" required maxlength = "8" value="<?= $cep ?>" />
        </p>
    </fieldset>
    <fieldset><legend>Contato</legend>
        <p class = "p50">
            <label for = "campo_telefone">Telefone</label>
            <input type = "text" name = "telefone" id = "campo_telefone" value="<?= $telefone ?>" />
        </p>
        <p class = "p50">
            <label for = "campo_celular">Celular*</label>
            <input type = "text" name = "celular" id = "campo_celular" required value="<?= $celular ?>" />
        </p>
        <p class = "p100">
            <label for = "campo_email">Email</label>
            <input class = "w95" type = "email" name = "email" id = "campo_email" value="<?= $email ?>" />
        </p>
    </fieldset>
    <fieldset><legend>Informação Bancária</legend>
        <p class = "p100">
            <label for = "campo_banco">Banco*</label>
            <select name = "banco_id" id = "campo_banco" required>
                <?php
                $admin = new AdminBanco;
                $admin->ExeSelect(0);
                $bancos = $admin->getResult();
                if ($bancos):
                    echo "<option disabled selected >Selecione</option>";
                    foreach ($bancos as $banco):
                        $selected = ($banco_id == $banco['id'] ? 'selected' : '');
                        echo "<option {$selected} value='{$banco['id']}'>{$banco['sigla']}</option>";
                    endforeach;
                else:
                    echo "<option disabled >Nenhum registro</option>";
                endif;
                ?>
            </select>
        </p>
        <p class="p50">
            <label for="campo_agencia">Agencia*</label>
            <input type="text" name="agencia" id="campo_agencia" required value="<?= $agencia ?>" />
        </p>
        <p class="p50">
            <label for="campo_conta">Conta*</label>
            <input type="text" name="conta" id="campo_conta" required value="<?= $conta ?>" />
        </p>

    </fieldset>

    <datalist id="cidades">
        <option value="CAMETA">Cametá</option>
        <option value="BELEM">Belém</option>
        <option value="CASTANHAL">Castanhal</option>
        <option value="ANANINDEUA">Ananindeua</option>
        <option value="BARCARENA">Barcarena</option>
    </datalist>
    <p>
        <input type="reset" value="Limpar" name="limpar" />
        <input type="submit" value="Salvar" name="salvar" />
    </p>
</form>