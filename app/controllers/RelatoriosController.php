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
    public function pesquisamensagens(){
        if(isset($_GET["pesquisar"])){
            $datainicio = $_GET["data_inicio"].' 00:00:00';
            $datafim = $_GET["data_fim"].' 23:59:59';
            $listamensagens = Sent::make()->select()->where('sendTime between ? and ?', [$datainicio, $datafim])->find();
            view("relatoriomensagens", [$listamensagens]);
        }else
            redirect("/relatoriomensagens");
    }
}
