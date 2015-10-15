 <h2>Relatório de Empenhos</h2>
    <form method="get">
        <input type="hidden" name="page" value="relatorio" />
        <input type="hidden" name="entidade" value="empenho" />
        <p class="p50">
            <label for="campo_secretaria">Por Secretaria</label>
            <select name="secretaria_id" id="campo_secretaria">
                <?php
                $adminSec = new AdminSecretaria();
                $adminSec->ExeSelect();
                $secretarias = $adminSec->getResult();
                if ($secretarias != null):
                    echo "<option value='0'>Todas</option>";
                    foreach ($secretarias as $secretaria) :
                        echo "<option value='{$secretaria['id']}'>{$secretaria['nome']}</option>";
                    endforeach;
                endif;
                ?>
            </select>
        </p>
        <p class="p50">
            <label for="campo_ano">Por Ano</label>
            <input type="number" name="ano" value="2015" id="campo_ano"/>
        </p>
        <p>
            <input type="submit" name="listar" value="Listar"/>
        </p>
    </form>

<?php
$dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);
if (isset($dados['listar'])):
    $adminEmpenho = new AdminEmpenho();
    $sec_id = $dados['secretaria_id'];
    $ano = $dados['ano'];
    $adminEmpenho->getEmpenhosByFiltro($sec_id, $ano);
    $empenhos = $adminEmpenho->getResult();
    echo "<hr>";
    if ($empenhos):
        include 'pages/lista_empenhos.php';
    else:
        WSErro("Não há empenhos", WS_ALERT);
    endif;
endif;