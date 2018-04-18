<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class MainController extends Controller {
	public function index () {
		view('Default');
	}
	public function chamaview(){

        $lista = Email::make()->all();

        view("principal", $lista);

    }
    public function cadastraemail(){
	    $novo = new Email();
	    $novo->setNome($_POST["novo_nome"]);
	    $novo->setEmail($_POST["novo_email"]);
	    $novo->save();
	    redirect("/");
    }
    public function enviaemail()
    {
        if(isset($_POST["email_id"])) {
            foreach ($_POST["email_id"] as $id) {

                $email = Email::make()->get($id);

                $mensagem = new M
                ail();
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
