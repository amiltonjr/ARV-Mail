<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class MainController extends Controller {
	public function index () {
		view('Default');
	}
	public function teste(){
	    if($this->getRequest()=="get") {
            $lista = Email::make()->all();

            view("cadastroemail", $lista);


        }else
            $this->cadastraemail();
    }
    public function cadastraemail(){
	    $novo = new Email();
	    $novo->setNome($_POST["novo_nome"]);
	    $novo->setEmail($_POST["novo_email"]);
	    dump($novo->save());
	    //dump($novo);
	    //redirect("/");
    }

}
