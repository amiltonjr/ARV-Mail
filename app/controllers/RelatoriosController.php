<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class RelatoriosController extends Controller {
    // Controller responsável pelo processamento e exibição de cada relatório do sistema

    /**
     * Realiza a exibição da página de relatório de emails por domínio
     */

    public function relatorioEmails() {
        $list_consulta_dominio = Email::make()->select('Distinct domain')->find();

        view('relatorioemail', $list_consulta_dominio);
    }


    /**
     * Realiza a exibição da página de relatório de emails por domínio
     */
    public function relatorioMensagens() {
        $post = filterPost(); // Obtém os dados vindos por POST, já filtrados

        $datainicio = $post["data_inicio"] . ' 00:00:00';
        $datafim = $post["data_fim"] . ' 23:59:59';

        $listamensagens = Sent::make()->select(); // Inicia o processo de busca no BD

        // Realiza a busca conforme os filtros recebidos
        if($post['data_inicio'] != '' && $post['data_fim'] == '') { // Obteve apenas data de inicio
            $listamensagens->where('sendTime >= ?', $datainicio);

        } else if($post['data_inicio'] == '' && $post['data_fim'] != '') { // Obteve apenas data de fim
            $listamensagens->where('sendTime <= ?', $datafim);

        } else if($post['data_inicio'] != '' && $post['data_fim'] != '') { // Obteve as duas datas
            $listamensagens->where('sendTime between ? and ?', [$datainicio, $datafim]);

        }

        // Executa a consulta SQL
        $listamensagens = $listamensagens->find();

        // Cria um vetor que contenha tanto os dados da mensagem quanto do email destinatário
        $arrDados = array();
        foreach($listamensagens as $k => $item) {
            $email = Email::make()->get($item->getEmailId());
            $arrDados[] = array($item, $email);
        }

        // Chama a view e passa os dados para ela
        view('relatoriomensagens', $arrDados);
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
