<?php
echo "<ul class='lista'>";

foreach ($empenhos as $empenho):
    echo "<li class='clearfix'>";
        echo "<div class='dados'>";
            echo "<p><label>NE/OP:</label><a class='info'>{$empenho['id']}</a></p>";
            echo "<p><label>Nº Doc.:    </label>{$empenho['numero_doc']}</p>";
            echo "<p><label>Descrição: </label>{$empenho['descricao']}</p>";
        echo "</div>";
        echo "<nav class='acoes'>";
            echo "<ul>";
                echo "<li><a href='home.php?page=empenho&id={$empenho['id']}&editar=1'><img width='24' src='resources/img/acoes/edit.png'/></a></li>";
                echo "<li><a onclick='return confirmaDelete()' href='home.php?page=empenho&id={$empenho['id']}&excluir=1'><img width='24' src='resources/img/acoes/remove.png'/></a></li>";
            echo "</ul>";
        echo "</nav>";
    echo "</li>";
endforeach;
echo "</ul>";