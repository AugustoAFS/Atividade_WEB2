$(document).ready(function () {
    // Função para abrir e fechar a barra lateral
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('open');
        $(this).toggleClass('d-none'); // Esconde o botão de hambúrguer
    });

    // Função para fechar a barra lateral quando o botão "×" é clicado
    $('.close-btn').on('click', function () {
        $('#sidebar').removeClass('open');
        $('#sidebarCollapse').removeClass('d-none'); // Mostra o botão de hambúrguer novamente
    });
});
