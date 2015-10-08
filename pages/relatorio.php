<div class="formulario">
    <div>
        <h2>Relatórios</h2>
        <nav class="menu_configura">
            <ul>
                <li><a href="home.php?page=relatorio&entidade=pessoa">Listar Pessoas por filtro</a></li>
                <li><a href="home.php?page=relatorio&entidade=empenho">Listar Empenhos por filtro</a></li>
            </ul>
        </nav>
    </div>
    <?php
    $entidade = filter_input(INPUT_GET, "entidade");
    if (!empty($entidade)):
        switch ($entidade) {
            case "pessoa":
                include 'pages/relatorios/pessoas.php';
                break;
            case "empenho":
                include 'pages/relatorios/empenhos.php';
                break;
            default:
                break;
        }
    endif;
    ?>
</div>