<?php
ob_start();
session_start();
require_once './_app/Config.inc.php';
$adminUsuario = new AdminUsuario;
if ($adminUsuario->checkLogin()) {
    header("Location: home.php");
}
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados['entrar'])) {
    unset($dados['entrar']);
    $adminUsuario->ExeLogin($dados);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="resources/css/estilo.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="favicon.ico">
        <meta charset="UTF-8">
        <title>Login - PROEmpenho</title>
    </head>
    <body>
        <div class="formulario login">
            <form method="post" action="">
                <h2>Login - PROEmpenho</h2>
                <?php
                if ($adminUsuario->getResult()) {
                    WSErro($adminUsuario->getError()[0], $adminUsuario->getError()[1]);
                }
                if (is_array($adminUsuario->getResult())) {
                    header("Location: home.php");
                }
                ?>
                <p>
                    <input class = "entrada_form w100" type = "email" name = "email" id = "campo_email" placeholder = "Email" required/>
                </p>
                <p>
                    <input class = "entrada_form w100" type = "password" name = "senha" id = "campo_senha" placeholder = "Senha" required/>
                </p>
                <p>
                    <input class = "botao_form" type = "submit" name = "entrar" value = "Entrar"/>
                    <input class = "botao_form" type = "reset" name = "limpar" value = "Limpar"/>
                    <a href = "#">Recuperar Senha</a>
                </p>
            </form>
        </div>
    </body>
</html>
<?php ob_end_flush(); ?>
