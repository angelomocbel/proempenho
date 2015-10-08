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

$read->ExeRead("pe_banco", "WHERE id = :id", "id={$banco_id}");
$banco = $read->getResult()[0]['nome'];
$read->ExeRead("pe_secretaria", "WHERE id = :id", "id={$secretaria_id}");
$secretaria = $read->getResult()[0]['nome'];
?>
<div class="formulario dados">
    <h2>Empenho para <?= $pessoa['nome'] ?></h2>
    <fieldset><legend>Dados gerais</legend>
        <p><label>NE/OP</label><?= $id ?></p>
        <p><label>Número Doc.</label><?= $numero_doc ?></p>
        <p><label>Descrição</label><?= $descricao ?></p>
    </fieldset>
    <fieldset><legend>Informações bancárias</legend>
        <p><label>Banco</label><?= $banco ?></p>
        <p><label>Conta</label><?= $conta ?></p>
        <p><label>Cheque</label><?= $cheque ?></p>
    </fieldset>
    <fieldset><legend>Informações adicionais</legend>
        <p><label>Secretaria</label><?= $secretaria ?></p>
        <p><label>Data Pag</label><?= $data_pag ?></p>
        <p><label>Observação</label><?= $obs ?></p>
    </fieldset>
</div>