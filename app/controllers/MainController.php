<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class MainController extends Controller {
	public function chamaview(){

        $lista = Email::make()->all();

        view("principal", $lista);

    }

    public function isValidEmail($email='') {
        return ($email = filter_var($email, FILTER_VALIDATE_EMAIL)) !== false;
    }

    public function getEmailDomain($email='') {
        return substr(strrchr($email, "@"), 1);
    }

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
    public function cadastragrupo(){
        if (isset($_POST['novo_grupo'])) {
            $grupo = new Group();
            $grupo->setName($_POST["nome_grupo"]);
            $grupo->setDescription($_POST["descricao_grupo"]);
            $grupo->save();
        }

        redirect("/");
    }

    public function enviaemail()
    {
        if(isset($_POST["email_id"])) {
            foreach ($_POST["email_id"] as $id) {

                $email = Email::make()->get($id);

                $mensagem = new Mail();
                $mensagem->setFrom("testadorwilson@gmail.com");
                $mensagem->setTo($email->getEmail());
                $mensagem->setSubject($_POST["assunto"]);
                $mensagem->setContent($_POST["corpo_email"]);
                $mensagem->setFromName("Wilson");
                $mensagem->send();
                redirect("/");
            }
        } else {
            echo "<script>alert('Selecione ao menos um email ')</script>";
            echo "<meta http-equiv='Refresh' content='0;url=".SYSROOT."'>";
        }
    }
    public function excluiemail($data){
        $email = Email::make()->get($data["id"]);
        $email->delete();
        redirect("/");



    }

}
