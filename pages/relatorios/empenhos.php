<h2>Relatório de Empenhos</h2>
<form method="get">
    <p class="p50">
        <label for="campo_secretaria">Por Secretaria</label>
        <select name="secretaria_id" id="campo_secretaria">
            <?php
            $adminSec = new AdminSecretaria();
            $adminSec->ExeSelect();
            $secretarias = $adminSec->getResult();
            if ($secretarias != null):
                echo "<option value='0'>Todas</option>";
                foreach ($secretarias as $secretaria) {
                    extract($secretaria, EXTR_PREFIX_ALL, "s");
                    echo "<option value='{$s_id}'>{$s_nome}</option>";
                }
            endif;
            ?>
        </select>
    </p>
    <p class="p50">
        <label for="campo_ano">Por Ano</label>
        <input type="number" name="ano" value="2015" id="campo_ano"/>
    </p>
</form>