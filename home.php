<?php
//ob_start();
session_start();
require_once './_app/Config.inc.php';
$adminUsuario = new AdminUsuario;

$page = filter_input(INPUT_GET, 'page', FILTER_DEFAULT);

if ($adminUsuario->checkLogin()):
    $usuario = $adminUsuario->getUsuario();
else:
    header("Location: login.php");
endif;
?>
<!DOCTYPE html>
<html>
    <head lang="pt-br">
        <meta charset="UTF-8">
        <title>PROEmpenho</title>
        <link rel="icon" href="favicon.ico">
        <link href="resources/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="resources/css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="resources/css/menus.css" rel="stylesheet" type="text/css"/>
        <link href="resources/css/listas.css" rel="stylesheet" type="text/css"/>
        <script src="resources/js/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="resources/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="resources/js/jquery.maskMoney.js" type="text/javascript"></script>
        <script src="resources/js/funcoes.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="container">
            <header id="cabecalho">
                <span style="padding: 10px 20px; position: absolute; float: left">
                    <a href="home.php"><img style="width: 45px; " src="resources/img/logo.png"/></a>
                </span>
                <!--   MENU USUÁRIO-->
                <nav id="menu_usuario">
                    <span>
                        <p><img width="25" src="resources/img/profile5.png"/></p>
                        <p><?= $usuario['nome'] ?></p>
                        <ul id="opcoes_usuario">
                            <li><a href="home.php?page=usuario&id=<?= $usuario['id'] ?>&edit=1">Meus dados</a></li>
                            <li><a href="home.php?page=logout" onclick="return confirmaLogout()">Sair</a></li>
                        </ul>
                    </span>
                </nav>
            </header>
            <section id="sidebar">
                <nav id="menu_opcoes">
                    <ul>
                        <li><a href="?page=novapessoa"><img src="resources/img/menu_lateral/add.png" />Cadastrar Pessoa</a></li>
                        <li><a href="?page=busca"><img src="resources/img/menu_lateral/search.png" />Buscar Registros</a></li>
                        <li><a href="?page=relatorio"><img src="resources/img/menu_lateral/list.png" />Relatórios</a></li>
                        <li><a href="?page=configura"><img src="resources/img/menu_lateral/config.png" />Configurações</a></li>
                    </ul>
                </nav>
            </section>
            <section id="content">
                <?php
                if (empty($page)):
                    $page = "default";
                endif;
                $includepath = __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . strip_tags(trim($page) . '.php');
                require_once ($includepath);
                ?>
            </section>
            <footer id="rodape">
                <p>PROEmpenho &COPY; DITEC</p>
            </footer>
        </div>
    </body>
</html>

