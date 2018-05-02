<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class RelatoriosController extends Controller {
    // Controller responsável pelo processamento e exibição de cada relatório do sistema

    /**
     * Realiza a exibição da página de relatório de emails por domínio
     */

    public function relatorioEmails() {
        $list_consulta_dominio = Email::make()->select('Distinct domain')->find();

        $arrDominios = array();
        foreach($list_consulta_dominio as $k => $i) {
            $emails = Email::make()->where('domain = ?', $i->getDomain())->find();
            $arrDominios[] = array('dominio' => $i, 'emails' => $emails);
        }

        view('relatorioemail', $arrDominios);
    }


    /**
     * Realiza a exibição da página de relatório de emails por domínio
     */
    public function relatorioMensagens() {
        $post = filterPost(); // Obtém os dados vindos por POST, já filtrados

        $datainicio = isset($post['data_inicio']) && $post['data_inicio'] != '' ? $post["data_inicio"] . ' 00:00:00' : '';
        $datafim = isset($post["data_fim"]) && $post['data_fim'] != '' ? $post["data_fim"] . ' 23:59:59' : '';

        $listamensagens = Sent::make()->select(); // Inicia o processo de busca no BD

        // Realiza a busca conforme os filtros recebidos
        if($datainicio != '' && $datafim == '') { // Obteve apenas data de inicio
            $listamensagens->where('sendTime >= ?', $datainicio);

        } else if($datainicio == '' && $datafim != '') { // Obteve apenas data de fim
            $listamensagens->where('sendTime <= ?', $datafim);

        } else if($datainicio != '' && $datafim != '') { // Obteve as duas datas
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


    /**
     * Realiza a exibição e download de txt do relatório de emails
     */
    public function relatorioEmailsTxt() {
        $filename = 'relatorioEmails.txt';
        header('Content-disposition: attachment; filename='.$filename);
        header('Content-type: text/plain');

        $list_consulta_dominio = Email::make()->select('Distinct domain')->find();

        foreach($list_consulta_dominio as $k => $i) {
            $emails = Email::make()->where('domain = ?', $i->getDomain())->find();

            echo 'Domínio: '.$i->getDomain()."\r\n";
            foreach($emails as $e) {
                echo '- '.$e->getEmail()."\r\n";
            }
            echo "\r\n\r\n";
        }
    }

    /**
     * Realiza a exibição e download de txt do relatório de mensagens
     */
    public function relatorioMensagensTxt($get) {
        $filename = 'relatorioMensagnes.txt';
        header('Content-disposition: attachment; filename='.$filename);
        header('Content-type: text/plain');


        $datainicio = isset($get['inicio']) && $get['inicio'] != 'null' ? $get["inicio"] . ' 00:00:00' : '';
        $datafim = isset($get["fim"]) && $get['fim'] != 'null' ? $get["fim"] . ' 23:59:59' : '';

        $listamensagens = Sent::make()->select(); // Inicia o processo de busca no BD

        // Realiza a busca conforme os filtros recebidos
        if($datainicio != '' && $datafim == '') { // Obteve apenas data de inicio
            $listamensagens->where('sendTime >= ?', $datainicio);

        } else if($datainicio == '' && $datafim != '') { // Obteve apenas data de fim
            $listamensagens->where('sendTime <= ?', $datafim);

        } else if($datainicio != '' && $datafim != '') { // Obteve as duas datas
            $listamensagens->where('sendTime between ? and ?', [$datainicio, $datafim]);

        }

        // Executa a consulta SQL
        $listamensagens = $listamensagens->find();

        foreach($listamensagens as $k => $item) {
            $email = Email::make()->get($item->getEmailId());

            echo '- Email: '.$email->getEmail()."\r\n";
            echo '  Data/Hora: '.date('d/m/Y, H:i', strtotime($item->getSendTime()))."\r\n";
            echo '  Assunto: '.$item->getSubject()."\r\n";
            echo '  Mensagem: '.$item->getMessage()."\r\n";
            echo "\r\n\r\n";
        }
    }
}
