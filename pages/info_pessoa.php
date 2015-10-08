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

$read->ExeRead("pe_banco", "WHERE id = :id", "id={$banco_id}");
$banco = $read->getResult()[0]['nome'];
?>
<div class="formulario dados">
    <h2><?= $nome ?></h2>
    <p>
        <a href="?page=novoempenho&pessoa_id=<?= $id ?>">Novo Empenho</a> 
        <a href="?page=empenhos&pessoa_id=<?= $id ?>">Ver Empenhos</a>
        <a href="?page=pessoa&id=<?= $id ?>&editar=1">Editar dados</a>
    </p>
    <fieldset>
        <legend>Identificação</legend>
        <p><label>Tipo: </label><?= ($tipo == 1 ? 'FÍSICA' : 'JURÍDICA') ?></p>
        <p><label>CPF/CNPJ: </label><?= $cadastro ?></p>
        <?php
        if ($nome_fantasia != ''):
            echo "<p><label>Nome Fantasia: </label><?= $nome_fantasia ?></p>";
        endif;
        ?>
    </fieldset>
    <fieldset><legend>Localização</legend>
        <p><label>Endereço: </label><?= $endereco ?></p>
        <p><label>Bairro: </label><?= $bairro ?></p>
        <p><label>Cidade: </label><?= $cidade ?></p>
        <p><label>Estado: </label><?= $estado ?></p>
        <p><label>Cep: </label><?= $cep ?></p>
    </fieldset>
    <fieldset><legend>Contato</legend>
        <p><label>Celular: </label><?= ($celular == '' ? 'Não informado' : $celular) ?></p>
        <p><label>Telefone: </label><?= ($telefone == '' ? 'Não informado' : $telefone) ?></p>
        <p><label>Email: </label><?= $email ?></p>
    </fieldset>
    <fieldset><legend>Informações Bancárias</legend>
        <p><label>Banco: </label><?= $banco ?></p>
        <p><label>Agência: </label><?= $agencia ?></p>
        <p><label>Conta: </label><?= $conta ?></p>
    </fieldset>
</div>