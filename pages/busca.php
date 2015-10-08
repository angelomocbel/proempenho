<div class="formulario">
    <h2>Buscar Registros</h2>
    <form method="get" action="">
        <input type="hidden" name="page" value="busca" />
        <p class="p100">
            <label for="campo_busca">Informe termos</label>
            <input type="search" name="busca" id="campo_busca" required/>
        </p>
        <p>
            <input type="radio" name="entidade" value="pessoa" id="opcao_pessoa" checked/>
            <label for="opcao_pessoa">Pessoa</label>
            <input type="radio" name="entidade" value="empenho" id="opcao_empenho"/>
            <label for="opcao_empenho">Empenho</label>
        </p>
        <p>
            <input type="submit" name="buscar" value="Buscar"/>
        </p>
    </form>

    <?php
    $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    if (!empty($dados['buscar'])) {
        unset($dados['buscar']);
        $search = new Busca;
        $search->ExeSearch($dados);
        echo '<hr>';
        echo "<h2>Resultados para '{$dados['busca']}'</h2>";
        if (is_array($search->getResult())) {
            foreach ($search->getResult() as $linha) {
                extract($linha);
                if ($dados['entidade'] == 'pessoa') {
                    echo "<div class=\"resultado\"><div class=\"icone\"><a target='_blank' href=\"?page=pessoa&id={$id}\"><img src=\"resources/img/inforesult.png\" /></a></div>
                            <div class=\"info\">
                                <p><label>Nome: </label>{$nome}</p>
                                <p><label>CPF/CNPJ: </label>{$cadastro}</p>
                                <p><label>Contatos: </label>{$email} {$celular} {$telefone}</p>
                            </div>
                        </div>";
                }
                if ($dados['entidade'] == 'empenho') {
                    echo "<div class='resultado'><div class='icone'><a href='?page=pessoa&id={$pessoa_id}'><img src='resources/img/inforesult.png'/></a></div>
                        <div class='info'>
                            <p><label>NE/OP: </label>{$id}</p>
                            <p><label>Nº Doc.: </label>{$numero_doc}</p>
                            <p><label>Descrição: </label>{$descricao}</p>
                        </div>
                    </div>";
                }
            }
        }
    }
    ?>
</div>
