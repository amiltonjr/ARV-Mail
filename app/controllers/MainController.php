<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class MainController extends Controller {
    //função que dá o caminho para a view principal com as variáveis necessárias
	public function chamaview(){
        //consulta de emails para a view
        $lista = Email::make()->all();
        //consulta de grupos para a view
        $grupos = Group::make()->all();

        view("principal", [$lista, $grupos]);

    }
    //verifica se o email é válido
    public function isValidEmail($email='') {
        return ($email = filter_var($email, FILTER_VALIDATE_EMAIL)) !== false;
    }
    //extrai o domínio de um email passado como parãmetro
    public function getEmailDomain($email='') {
        return substr(strrchr($email, "@"), 1);
    }
    //cadastra um novo email com base no formulário de email da view principal
    public function cadastraemail() {
	// Se o endereço de e-mail é válido
        if (isset($_POST['novo_email']) && $this->isValidEmail($_POST['novo_email'])) {
            $email = new Email();
	    $email->setName($_POST['novo_nome']);
	    $email->setEmail($_POST['novo_email']);
            $email->SetDomain($this->getEmailDomain($email->getEmail()));
            $email->setRegistrationDate('CURRENT_TIMESTAMP');
            $email->setGroupId($_POST['group_id']);
	    $email->save();
        }
	    redirect("/");
    }
    //cadastra um novo grupo com base no formulário de grupo na view principal
    public function cadastragrupo(){
        if (isset($_POST['novo_grupo'])) {
            $grupo = new Group();
            $grupo->setName($_POST["nome_grupo"]);
            $grupo->setDescription($_POST["descricao_grupo"]);
            $grupo->save();
        }

        redirect("/");
    }
    //envia email com base no formulário de enviar email da view principal
    public function enviaemail()
    {
        //verifica se o post foi enviado por completo
        if(isset($_POST["email_id"])) {
            foreach ($_POST["email_id"] as $id) {

                $email = Email::make()->get($id);

                $mensagem = new Mail();
                $Sent = new Sent();
                $mensagem->setFrom("testadorwilson@gmail.com");
                $mensagem->setTo($email->getEmail());
                $Sent->setEmailId($email->getId());
                $mensagem->setSubject($_POST["assunto"]);
                $Sent->setSubject($_POST["assunto"]);
                $Sent->setSendTime(date("Y-m-d H:i:s"));
                $mensagem->setContent($_POST["corpo_email"]);
                $Sent->setMessage($_POST["corpo_email"]);
                $mensagem->setFromName("Wilson");
                $Sent->save();
                dump($Sent);
                $mensagem->send();
                //redirect("/");
            }
        } else {
            echo "<script>alert('Selecione ao menos um email ')</script>";
            echo "<meta http-equiv='Refresh' content='0;url=".SYSROOT."'>";
        }
    }
    //exclui email com base no link da tabela de emails da view principal
    public function excluiemail($data){
        $email = Email::make()->get($data["id"]);
        $email->delete();
        redirect("/");
    }


}
