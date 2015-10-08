<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="favicon.ico">
        <title>Relatórios de empenhos</title>
        <link href="resources/css/estilo.css" rel="stylesheet" type="text/css"/>
        <script>
            onload:window.print();
        </script>
    </head>
    <body>
        <header class="secretaria">
            <p><?= date('H:i:s - d/m/y'); ?></p>
            <div >
                <img src="resources/img/brasao-cameta.png" alt=""/>
                <h3>SERVIÇO PÚBLICO MUNICIPAL</h3>
                <h3>PREFEITURA MUNICIPAL DE CAMETÁ</h3>
                <h3>SECRETARIA MUNICIPAL DE FINANÇAS - SEFIN</h3>
            </div>
        </header>
        <?php
        include './_app/Config.inc.php';
        $pessoa_id = filter_input(INPUT_GET, "pessoa_id");
        if (!empty($pessoa_id)):
            $read = new Read();
            $read->ExeRead("pe_pessoa", "WHERE id = :id", "id={$pessoa_id}");
            if ($read->getResult()):
                $pessoa = $read->getResult()[0];
                extract($pessoa);
                $read->ExeRead("pe_banco", "WHERE id = :banco_id", "banco_id={$banco_id}");
                $banco = $read->getResult()[0]['nome'];
                ?>
                <div class="info_pessoa">
                    <fieldset><legend>Identificação</legend>
                        <p>
                            <label>Nome/Razão Social</label><span><?= $nome ?></span>
                            <label>CPF/CNPJ</label><span><?= $cadastro ?></span>
                            <label>Nome Fantasia</label><span><?= $nome_fantasia ?></span>
                        </p>
                    </fieldset>
                    <fieldset><legend>Localização</legend>
                        <p>
                            <label>Endereço</label><span><?= $endereco ?></span>
                            <label>Bairro</label><span><?= $bairro ?></span>
                            <label>Cidade</label><span><?= $cidade ?></span>
                            <label>CEP</label><span><?= $cep ?></span>
                            <label>Estado</label><span><?= $estado ?></span>
                        </p>
                    </fieldset>
                    <fieldset><legend>Contato</legend>
                        <p>
                            <label>Telefone</label><span><?= $telefone ?></span>
                            <label>Celular</label><span><?= $celular ?></span>
                            <label>Email</label><span><?= $email ?></span>
                        </p>
                    </fieldset>
                    <fieldset><legend>Informações Bancárias</legend>
                        <p>
                            <label>Banco</label><span><?= $banco ?></span>
                            <label>Agência</label><span><?= $agencia ?></span>
                            <label>Conta</label><span><?= $conta ?></span>
                        </p>
                    </fieldset>
                </div>
                <?php
                $read->ExeRead("pe_empenho", "WHERE pessoa_id = :pessoa_id", "pessoa_id={$pessoa_id}");
                if ($read->getResult()):
                    echo "<div class='lista_empenhos'><table>";
                    echo "<tr class='barra_titulo'>";
                    echo "<td>NE/OP</td>";
                    echo "<td>Nº DOC</td>";
                    echo "<td>DESCRIÇÃO</td>";
                    echo "<td>BRUTO</td>";
                    echo "<td>LÍQUIDO</td>";
                    echo "<td>BANCO</td>";
                    echo "<td>CONTA</td>";
                    echo "<td>CHEQUE</td>";
                    echo "<td>SECRETARIA</td>";
                    echo "<td>PAGAMENTO</td>";
                    echo "<td>OBSERVAÇÃO</td>";
                    echo "</tr>";
                    $empenhos = $read->getResult();
                    foreach ($empenhos as $em):
                        extract($em, EXTR_OVERWRITE);
                        $read->ExeRead("pe_banco", "WHERE id = :banco_id", "banco_id={$banco_id}");
                        $banco = $read->getResult()[0]['sigla'];
                        $read->ExeRead("pe_secretaria", "WHERE id = :secretaria_id", "secretaria_id={$secretaria_id}");
                        $secretaria = $read->getResult()[0]['codigo'];
                        echo "<tr class='linhas'>";
                        echo "<td>{$id}</td>";
                        echo "<td>{$numero_doc}</td>";
                        echo "<td>{$descricao}</td>";
                        echo "<td>{$valor_bruto}</td>";
                        echo "<td>{$valor_liquido}</td>";
                        echo "<td>{$banco}</td>";
                        echo "<td>{$conta}</td>";
                        echo "<td>{$cheque}</td>";
                        echo "<td>{$secretaria}</td>";
                        echo "<td>".echoDate($data_pag)."</td>";
                        echo "<td>{$obs}</td>";
                        echo "</tr>";
                    endforeach;
                    echo "</div></table>";
                else:
                    WSErro("Não há empenhos para esta pessoa", WS_ALERT);
                endif;
            else:
                WSErro("Pessoa não encontrada", WS_ERROR);
            endif;
        else:
            WSErro("Pessoa não informada", WS_ERROR);
        endif;
        ?>
    </body>
</html>