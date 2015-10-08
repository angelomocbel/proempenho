jQuery(function ($) {
    $("#campo_telefone").mask("(99) 9999-9999?9").focusout(function () {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
    $("#campo_celular").mask("(99) 9999-9999?9").focusout(function () {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
    $("#campo_cep").mask("99999-999");
});
//FUNÇÃO PARA O MENU DO USUÁRIO
$(document).ready(function () {
    $("nav#menu_usuario").click(function () {
        $("ul#opcoes_usuario").slideToggle('fast');
    });
});
$(function () {
    $("#campo_valor_bruto").maskMoney({symbol: 'R$ ',
        showSymbol: true, thousands: '.', decimal: ',', symbolStay: true}),
    $("#campo_valor_liquido").maskMoney({symbol: 'R$ ',
        showSymbol: true, thousands: '.', decimal: ',', symbolStay: true});
});
function confirmaDelete() {
    return confirm("Deseja realmente remover esse registro?");
}
function confirmaLogout() {
    return confirm("Deseja sair do PROempenho?");
}
