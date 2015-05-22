<?php

class phplattes extends CI_Controller {
	function __construct() {
		global $db_public;

		parent::__construct();
		//$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> helper('xml');
		/* $this -> lang -> load("app", "portuguese"); */
		$this -> load -> library('session');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$data = array();
		$data['logo'] = 'logo_phpanalyser.png';
		$this -> load -> view('welcome_message', $data);
	}

	public function dgp($id=0)
		{
			$this->load->view('phplattes/cab_sub');
		}
		
	public function dgp_import($id=0)
		{
			$this->load->model("phplattess");
			$link = 'http://dgp.cnpq.br/dgp/espelhogrupo/9734870278687868';
			$data = $this->phplattess->inport_data($link);
			echo $data;
		}

}
?>
