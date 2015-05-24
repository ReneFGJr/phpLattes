<?php

class phplattes extends CI_Controller {
	function __construct() {
		global $db_public;

		parent::__construct();
		$this -> load -> database();
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
			$link = 'http://dgp.cnpq.br/dgp/espelhogrupo/9641539233308057';
			$data = $this->phplattess->inport_data($link);
			
			
			$data = $this->phplattess->removeSCRIPT($data);
			$data = $this->phplattess->removeCLASS($data);
			$data = $this->phplattess->removeSPACE($data);
			$data = $this->phplattess->removeTAG($data);
			
			/* Dados da instituicao */
			$datar = array();
			$datar['grupo'] = $this->phplattess->recupera_nomegrupo($data);
			$datar['instituicao'] = $this->phplattess->recupera_identificacao($data);			
			$datar['endereco'] = $this->phplattess->recupera_endereco($data);
			$datar['repercusao'] = $this->phplattess->recupera_repercussao($data);
			$datar['linhas'] = $this->phplattess-> recupera_linha_pesquisa($data);
			$datar['equipe'] = $this->phplattess-> recupera_recursosHumanos($data);
			$datar['parceiras'] = $this->phplattess-> recupera_instituicoesparceiras($data);
			$datar['equipamentos'] = $this->phplattess -> recupera_equipamentos_softwares($data);	
			print_r($datar);		
		}

}
?>
