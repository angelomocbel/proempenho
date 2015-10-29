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
            echo "<ul class='lista'>";
            foreach ($search->getResult() as $linha) {
                extract($linha);
                if ($dados['entidade'] == 'pessoa') {
                    echo "<li class='clearfix' ><div class='icone'></div>
                            <div class='dados'>
                                <p><label>Nome:<a class='info' href='home.php?page=pessoa&id={$id}'> </label>{$nome}</a></p>
                                <p><label>CPF/CNPJ: </label>{$cadastro}</p>
                                <p><label>Contatos: </label>{$email} {$celular} {$telefone}</p>
                            </div>
                        </li>";
                }
                if ($dados['entidade'] == 'empenho') {
                    echo "<li class='clearfix'>
                            <div class='dados'>
                                <p><label>NE/OP: </label><a class='info' href=''>{$id}</a></p>
                                <p><label>Nº Doc.: </label>{$numero_doc}</p>
                                <p><label>Descrição: </label>{$descricao}</p>
                            </div>
                        </li>";
                }
            }
            echo "</ul>";
        }
    }
    ?>
</div>
