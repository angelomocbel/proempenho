<?php
    foreach ($empenhos as $empenho):
        echo "<div class='resultado'>";
        echo "<div class='icone'>";
        echo "<a target='_blank' href='home.php?page=empenho&id={$empenho['id']}'><img src='resources/img/inforesult.png'/></a>";
        echo "</div>";
        echo "<div class='info'>";
        echo "<p><label>NE/OP</label>{$empenho['id']}</p>";
        echo "<p><label>Nº Documento</label>{$empenho['numero_doc']}</p>";
        echo "<p><label>Descrição</label>{$empenho['descricao']}</p>";
        echo "</div>";
        echo "<div class='icones'>";
        echo "<a href='home.php?page=empenho&id={$empenho['id']}&editar=1'><img width='28' src='resources/img/edit.png'/></a>";
        echo "<a onclick='return confirmaDelete()' href='home.php?page=empenho&id={$empenho['id']}&excluir=1'><img width='28' src='resources/img/remove.png'/></a>";
        echo "</div>";
        echo "</div>";
    endforeach;