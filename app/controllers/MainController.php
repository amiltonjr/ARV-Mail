<?php defined('INITIALIZED') OR exit('You cannot access this file directly');

class MainController extends Controller {

	public function index () {
		view('Default');
	}
	public function teste(){
	    view("cadastroemail");
    }
    public function cadastraemail(){
	    //dump($_POST);
	    //var_dump($_POST);
	    print_r($_POST);
    }
}
