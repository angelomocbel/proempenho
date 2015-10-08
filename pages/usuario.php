<?php

$id = filter_input(INPUT_GET, "id");
if (!empty($id)):
    $adminUsuario->ExeSelect($id);
    if ($adminUsuario):
        $usuario = $adminUsuario->getResult()[0];
        extract($usuario, EXTR_PREFIX_ALL, 'u');
        var_dump($usuario);
    else:
        WSErro("Usuário não encontrado", WS_ERROR);
    endif;
else:
    WSErro("Usuário não informado", WS_ERROR);
endif;