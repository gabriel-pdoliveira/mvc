<?php

/**
 * home - Controller de exemplo
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class HomeController extends MainController
{

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['user'])){
			header("Location:".URL_BASE."users/login");
		}
	}

	/**
	 * Carrega a página "/views/home/index.php"
	 */
    public function index() {
		# Título da página
		$this->title = 'Home';
		
		# Essa página não precisa de modelo (model)
		
		# Carrega os arquivos do view		
		$this->view->show('home/home', null);
	
		
    } // index

	public function list($dateStart=null, $dateEnd=null) {
		#Instanciar um objeto da classe MovimentModel 
		$model=$this->load_model("Moviments");
		//var_dump($model);
		# busca a lista de movimento para o periodo
		$listMoviments=$model->list($dateStart, $dateEnd);
		$data['moviments']=$listMoviments;
		$cash_balance=$model->cash_balance();
		$data['cash_balance']=$cash_balance;
		
		//print_r($data);
		/** Carrega os arquivos do view **/
		$this->view->show("home\home", $data);
		
	}
	
	public function grafico(){

	} // class HomeController