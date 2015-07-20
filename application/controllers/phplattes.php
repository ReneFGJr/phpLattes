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
		
		$this -> load -> helper('simpleweb');
		/* $this -> lang -> load("app", "portuguese"); */
		$this -> load -> library('session');
		date_default_timezone_set('America/Sao_Paulo');
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
	public function cab() {
		$data = array();
		$this -> load -> view('header/header');
		$this -> load -> view('phplattes/cab_sub');
	}	 
	 
	public function index() {
		$data = array();
		$this -> load -> view('header/header');
		$data['logo'] = 'logo_phpanalyser.png';
		$this -> load -> view('welcome_message', $data);
	}
	
	function link_cv($id)
		{
			$this->load->view('researchers/view_cnpq_form');
		}
	
	function lattes_coleta($id)
		{
		/* Load Models */
		$this -> load -> model('researchers');
		$this -> load -> model('phplattes_cv');		
				
		$this -> cab();
		
		$data = $this->researchers->le($id);
		$this -> load -> view('researchers/view', $data);
		
		$link = $data['rs_lattes'];
		$this->phplattes_cv->coleta_lattes($link);
		
		}

	public function references($id = 0) {
		$this -> load -> view('phplattes/cab_sub');
	}

	public function inport01($id = 0) {
		$this -> load -> view('header/header');
		$this -> load -> view('phplattes/cab_sub');
		$this -> load -> model('inports');
		$txt = $this -> inports -> inport_01();
		//$txt = utf8_decode($txt);
		$txt = troca($txt, chr(13), '#');
		$txt = troca($txt, chr(10), '');
		$txt = troca($txt, chr(15), '');
		$ln = splitx('#', $txt);

		echo '===>' . count($ln);
		$sx = 'Resultado';
		$xdoc = '';
		for ($r = 1; $r < count($ln); $r++) {
			$l = $ln[$r];
			$la = splitx(';', $l);
			if (isset($la[1]) > 0) {
				$nome = ($la[1]);

				if (!isset($la[2])) {

				} else {
					$texto = troca(trim($la[2]), "'", "´");
				}

				if ($nome != $xdoc) {
					$xdoc = $nome;
					$inst = $la[0];
					$nome = nbr_autor($nome, 7);
					echo '<BR>=>' . $nome;
					echo ' (' . $inst . ')';
					$id = $this -> inports -> insere_pesquisador($nome, $inst);
					echo '====[' . $id . ']';
				}
				if (isset($la[2]) > 0) {
					$sql = "insert into reference 
									( r_text , r_status, r_own_type, r_researcher)
									values 
									('$texto','@','A','$id')";
					$rlt = $this -> db -> query($sql);
				} else {
					echo '<HR>OPS ' . $l;
				}
			}

		}

		$data = array();
		$data['content'] = $sx;
		$this -> load -> view('content', $data);
	}
	public function inport02($id = 0) {
		$this -> load -> view('header/header');
		$this -> load -> view('phplattes/cab_sub');
		$this -> load -> model('inports');
		$txt = $this -> inports -> inport_02();
		//$txt = utf8_decode($txt);
		$txt = troca($txt, chr(13), '#');
		$txt = troca($txt, chr(10), '');
		$txt = troca($txt, chr(15), '');
		$txt = troca($txt, "'", '´');
		$ln = splitx('#', $txt);

		echo '===>' . count($ln);
		$sx = 'Resultado';
		$xdoc = '';
		for ($r = 1; $r < count($ln); $r++) {
			$l = $ln[$r];
			$la = splitx(';', $l);

			$s1 = $la[0];
			$s2 = $la[1];
			$s3 = $la[2];
			$s4 = $la[3];
			$s5 = $la[4];
			$s6 = $la[5];
			
				if (isset($la[2]) > 0) {
					$sql = "insert into works 
									( w1, w2, wa1, wa2, wa3, wr)
									values 
									('$s1','$s2','$s3','$s4','$s5','$s6')";
					$rlt = $this -> db -> query($sql);
				} else {
					echo '<HR>OPS ' . $l;
				}

		}

		$data = array();
		$data['content'] = $sx;
		$this -> load -> view('content', $data);
	}

	public function dgp($id = 0) {
		$this -> load -> view('phplattes/cab_sub');
	}

	public function dgp_import($id = 0) {
		echo 'Importando<BR>';
		$link = 'http://dgp.cnpq.br/dgp/espelhogrupo/3505756419229716';
		//$link = 'http://dgp.cnpq.br/dgp/espelhogrupo/2033332726841608';

		$data = $this -> phplattess -> dgp_import($link);

		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	public function lattes_view($id = 0) {
		/* Load Models */
		$this -> load -> model('researchers');		
				
		$this -> cab();
		
		$data = $this->researchers->le($id);
		$name_cited = $data['rs_name_find'];
		$data['works'] = $this->researchers->view_works($id);
		
		$data['cited'] = $this->researchers->view_cited($name_cited);
		
		$this -> load -> view('researchers/view', $data);	
		
	}
	
	public function lattes_edit($id=0)
		{
		/* Load Models */
		$this -> load -> model('researchers');			
		$cp = $this->researchers->cp();
		$data = array();

		$this -> cab();
		
		$form = new form;
		$form->id = $id;
		
		$tela = $form->editar($cp,$this->researchers->tabela);
		$data['title'] = msg('researchers_title');
		$data['tela'] = $tela;
		$this -> load -> view('form/form',$data);
		
		/* Salva */
		if ($form->saved > 0)
			{
				redirect(base_url('index.php/phplattes/lattes'));
			}			
		}
	
	public function lattes($id = 0) {
		/* Load Models */
		$this -> load -> model('researchers');		
		
		$this -> cab();
		
		$form = new form;
		$form -> tabela = $this -> researchers -> tabela;
		$form -> see = true;
		$form -> edit = true;
		$form -> novo = true;
		$form = $this -> researchers -> row($form);

		$form -> row_edit = base_url('index.php/phplattes/lattes_edit');
		$form -> row_view = base_url('index.php/phplattes/lattes_view');
		$form -> row = base_url('index.php/phplattes/lattes/');

		$tela['tela'] = row($form, $id);

		$tela['title'] = $this -> lang -> line('title_equipamento');
		
		$this -> load -> view('form/form', $tela);		
	}

}
?>
