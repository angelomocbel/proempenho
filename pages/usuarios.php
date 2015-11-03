<?php
$admin = new AdminUsuario();
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['salvar'])):
    unset($dados['salvar']);
    unset($dados['confirme']);
    $admin->ExeCreate($dados);
endif;
if (!empty($dados['editar'])):

endif;
if (!empty($dados['deletar'])):
    $usuario_id = $dados['usuario_id'];
    $admin->ExeDelete($usuario_id);
endif;
?>
<div class="clearfix">
    <h2>Novo Usuário</h2>
    <form method="post" action="">
        <?php
        if ($admin->getResult()):
            WSErro($admin->getError()[0], $admin->getError()[1]);
        endif;
        ?>
        <fieldset>
            <p class = "p100">
                <label for="campo_nome">Nome do usuário</label>
                <input class="w95" type="text" name="nome" id="campo_nome"/>
            </p>
            <p class = "p100">
                <label for="campo_email">Email de acesso</label>
                <input class="w95" type="email" name="email" id="campo_email"/>
            </p>
            <p class = "p50">
                <label for="campo_senha">Senha</label>
                <input type="password" name="senha" id="campo_senha"/>
            </p>
            <p class = "p50">
                <label for="campo_confirme">Confirme</label>
                <input type="password" name="confirme" id="campo_confirme"/>
            </p>
        </fieldset>
        <p class = "p100">
            <input type="reset" name="limpar" value="Limpar"/>
            <input type="submit" name="salvar" value="Salvar"/>
        </p>

    </form>
</div>
<div>
    <h2>Usuários Registrados</h2>
<?php
$admin->ExeSelect();
$usuarios = $admin->getResult();

if ($usuarios != null):
    echo "<ul class='lista usuario'>";
    foreach ($usuarios as $usuario):
        echo "<li class='clearfix'>";
            echo "<div class='dados'>";
            echo "<p><label>Nome: </label> {$usuario['nome']}</p>";
            echo "<p><label>Email: </label> {$usuario['email']}</p>";
            echo "</div>";
        echo "</li>";
    endforeach;
    echo "</ul>";
else:
    
endif;
?>
</div>