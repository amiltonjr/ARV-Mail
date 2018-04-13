<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class MainController extends Controller {
	public function index () {
		view('Default');
	}
	public function teste(){
	    if($this->getRequest()=="get") {
            $lista = Email::make()->all();

            view("cadastroemail", $lista);


        }else if(isset($_POST["novo"])) {
            $this->cadastraemail();
        }else if(isset($_POST["enviar"])){
            $this->enviaemail();
        }

    }
    public function cadastraemail(){
	    $novo = new Email();
	    $novo->setNome($_POST["novo_nome"]);
	    $novo->setEmail($_POST["novo_email"]);
	    $novo->save();
	    redirect("/");
    }
    public function enviaemail(){
	    if(isset($_POST["email_id"])){
	        $email = new Email();
	        $email->setId($_POST["email_id"]);
	        $email = Email::make()->get($email->getId());
	        dump($email);
            $mensagem = new Mail();
            $mensagem->setFrom("testadorwilson@gmail.com");
            $mensagem->setTo($email->getEmail());
            $mensagem->setSubject($_POST["assunto"]);
            $mensagem->setContent($_POST["corpo_email"]);
            $mensagem->setFromName("Wilson");
            dump($mensagem);
            $mensagem->send();
        }
    }

}
