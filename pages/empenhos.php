<div class="formulario">
<?php

$pessoa_id = filter_input(INPUT_GET, "pessoa_id");
if (!empty($pessoa_id)):
    $read = new Read();
    $read->ExeRead("pe_pessoa", "WHERE id = :id", "id={$pessoa_id}");
    if($read->getRowCount() > 0): 
        $pessoa = $read->getResult()[0];
        echo "<h2>Empenhos para <a href='home.php?page=pessoa&id={$pessoa['id']}'>{$pessoa['nome']}<a></h2>";
        echo "<div class='operacoes'>";
        echo "<a title='Adicionar' href='home.php?page=novoempenho&pessoa_id={$pessoa_id}'><img src='resources/img/acoes/add.png'/></a>";
        echo "<a title='Imprimir' target='_blank' href='imprimir_empenhos.php?pessoa_id={$pessoa_id}'><img src='resources/img/acoes/print.png'/></a>";
        echo "</div>";
        $read->ExeRead("pe_empenho", "WHERE pessoa_id = :pessoa_id", "pessoa_id={$pessoa_id}");
        if($read->getRowCount() > 0):
            $empenhos = $read->getResult();
            include 'pages/lista_empenhos.php';
            else: 
                WSErro("Não há empenhos", WS_ALERT);
        endif;
    else: 
        WSErro("Pessoa não encontrada", WS_ERROR);
    endif;
else:
    WSErro("Pessoa não informada", WS_ERROR);
endif;
?>
</div>