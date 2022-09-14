<?php

/**
 * home - Controller de exemplo
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class DashboardController extends MainController
{

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['user'])){
			header("Location:".URL_BASE."users/dashboard");
		}
	}
	/**
	 * Carrega a página "/views/dashboard/index.php"
	 */
    public function index() {
		# Título da página
		$this->title = 'Dashboard';
		
		# Carrega os arquivos do view		
		$this->view->show('dashboard/index', null);
	
		
    } // index

	


} // class HomeController