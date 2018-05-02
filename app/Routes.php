<?php defined('INITIALIZED') OR exit('You cannot access this file directly');
/*
 * Padrão para a escrita de rotas:
 * Router::define('URL', 'Controller/Method');
 *
 * // Use '{var_name}' to indicate that the method needs a parameter identified by 'var_name' in the array
 * Router::define('URL/{id}', 'Controller/Method');
 * Router::define('URL/{name}/show', 'Controller/Method');
 *
 * OBS: A primeira rota válida será sempre a rota utilizada, portanto se forem definidas mais de uma rota para a mesma
 * URL, as que vierem após a primeira não serão utilizadas.
 *
 */
Router::define("/","MainController/chamaview");
Router::define("/cadastra","MainController/cadastraemail");
Router::define("/cadastragrupo","MainController/cadastragrupo");
Router::define("/envia","MainController/enviaemail");
Router::define("/exclui/{id}","MainController/excluiemail");



// Rota que exibe a tela de relatório de emails
Router::define('relatorioemails', 'RelatoriosController/relatorioEmails');

// Rota que exibe a tela de relatório de mensagens
Router::define('relatoriomensagens', 'RelatoriosController/relatorioMensagens');

// Rota para salvar arquiv txt do relatório de emails
Router::define('relatorioemails/exportar', 'RelatoriosController/relatorioEmailsTxt');

// Rota para salvar arquiv txt do relatório de mensagens
Router::define('relatoriomensagens/exportar/{inicio}/{fim}', 'RelatoriosController/relatorioMensagensTxt');
