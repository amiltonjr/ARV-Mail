<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class RelatoriosController extends Controller {
    // Controller responsável pelo processamento e exibição de cada relatório do sistema

    /**
     * Realiza a exibição da página de relatório de emails por domínio
     */
    public function relatorioEmails() {

//        $emails = Email::make()->all();
//        dump($emails);

        view('relatorioemail');
    }


    /**
     * Realiza a exibição da página de relatório de emails por domínio
     */
    public function relatorioMensagens() {
        view('relatoriomensagens');
    }
}
