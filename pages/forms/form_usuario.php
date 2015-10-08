<?php
    $nome = (empty($u_nome) ? '' : $u_nome);
    $email = (empty($u_email) ? '' : $u_email);
?>
<form method="post" action="">
    <p>
        <label for='campo_nome'>Nome</label>
        <input type='text' name='nome' required id='campo_nome' value='<?= $nome ?>' />
    </p>
    <p>
        <label for='campo_email'>Email</label>
        <input type='email' name='email' required id='campo_email' value='<?= $email ?>' />
    </p>
    <p>
        <label for='campo_senha'>Senha</label>
        <input type='password' name='senha' required id='campo_senha' />
    </p>
    <p>
        <label for='campo_confirme'>Confirme</label>
        <input type='password' name='confirme' required id='campo_confirme' />
    </p>
</form>