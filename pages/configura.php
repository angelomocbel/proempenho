<div class="formulario">
    
    <div>
        <h2>Configurações</h2>
        <nav class="menu_configura">
            <ul>
                <li><a href="home.php?page=configura&entidade=secretaria">Secretarias</a></li>
                <li><a href="home.php?page=configura&entidade=banco">Bancos</a></li>
                <li><a href="home.php?page=configura&entidade=usuario">Usuários</a></li>
            </ul>
        </nav>
    </div>
    <?php
    $entidade = filter_input(INPUT_GET, "entidade");
    if (!empty($entidade)):
        switch ($entidade) {
            case "secretaria":
                include 'pages/secretarias.php';
                break;
            case "banco":
                include 'pages/bancos.php';
                break;
            case "usuario":
                include 'pages/usuarios.php';
                break;
            default:
                break;
        }
    endif;
    ?>
</div>