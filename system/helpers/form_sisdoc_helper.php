<?php
/**
 * CodeIgniter
 * sisDOC Labs
 *
 * @package	CodeIgniter
 * @author	Rene F. Gabriel Junior <renefgj@gmail.com>
 * @copyright Copyright (c) 2006 - 2015, sisDOC
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 2.1.0
 * @version 0.15.25a
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Rene F. Gabriel Junior <renefgj@gmail.com>
 * @link		http://www.sisdoc.com.br/CodIgniter
 */
$dd = array();

/* checa e cria diretorio */
if (!function_exists('dir')) {
	function dir($dir) {
		$ok = 0;
		if (is_dir($dir)) { $ok = 1;
		} else {
			mkdir($dir);
			$rlt = fopen($dir . '/index.php', 'w');
			fwrite($rlt, 'acesso restrito');
			fclose($rlt);
		}
		return ($ok);
	}
}

function mst($txt) {
	$txt = troca($txt, chr(13), '<br/>');
	return ($txt);
}

function sonumero($it) {
	$rlt = '';
	for ($ki = 0; $ki < strlen($it); $ki++) {
		$ord = ord(substr($it, $ki, 1));
		if (($ord >= 48) and ($ord <= 57)) { $rlt = $rlt . substr($it, $ki, 1);
		}
	}
	return $rlt;
}

function load_page($url) {
	$options = array(CURLOPT_RETURNTRANSFER => true, // return web page
	CURLOPT_HEADER => false, // don't return headers
	CURLOPT_FOLLOWLOCATION => true, // follow redirects
	CURLOPT_ENCODING => "", // handle all encodings
	CURLOPT_USERAGENT => "spider", // who am i
	CURLOPT_AUTOREFERER => true, // set referer on redirect
	CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
	CURLOPT_TIMEOUT => 120, // timeout on response
	CURLOPT_MAXREDIRS => 10,     // stop after 10 redirects
	);

	$ch = curl_init($url);
	curl_setopt_array($ch, $options);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$content = curl_exec($ch);
	$err = curl_errno($ch);
	$errmsg = curl_error($ch);
	$header = curl_getinfo($ch);
	curl_close($ch);

	$header['errno'] = $err;
	$header['errmsg'] = $errmsg;
	$header['content'] = $content;
	return $header;
}

if (!function_exists('msg')) {
	function msg($x) {
		return ($x);
	}

}

function brtos($data) {
	$data = sonumero($data);
	$data = substr($data, 4, 4) . substr($data, 2, 2) . substr($data, 0, 2);
	return ($data);
}

function brtod($data) {
	$data = sonumero($data);
	$data = substr($data, 4, 4) . '-' . substr($data, 2, 2) . '-' . substr($data, 0, 2);
	return ($data);
}

function strzero($ddx, $ttz) {
	$ddx = round($ddx);
	while (strlen($ddx) < $ttz) { $ddx = "0" . $ddx;
	}
	return ($ddx);
}

function UpperCase($d) {
	$d = strtoupper($d);

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '��', '�');
	$d = troca($d, '��', '�');
	$d = troca($d, '��', '�');
	$d = troca($d, '��', '�');
	$d = troca($d, '��', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '��', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	return $d;
}

function mask_cpf($cpf) {
	$cpf = sonumero($cpf);
	strzero($cpf, 12);
	$cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
	return ($cpf);
}

function db_query($sql) {
	global $dbn;
	$dbn = 0;
	$CI = &get_instance();
	$query = $CI -> db -> query($sql);
	return ($query -> result());
}

/*
 * http://www.kathirvel.com/php-convert-or-cast-array-to-object-object-to-array/
 */
function object_to_array($object) {
	return (array)$object;
}

function reload($tipo = 'J') {
	$sx = '
		<script>
			location.reload();
		</script>
		';
	echo $sx;
}

/* Recupera IP
 * @author Rene F. Gabriel Junior <renefgj@gmail.com>
 * @versao v0.15.23
 */
function ip() {
	$ip = trim($_SERVER['REMOTE_ADDR']);
	if ($ip == '::1') { $ip = '127.0.0.1';
	}
	return ($ip);
}

/*
 * http://www.kathirvel.com/php-convert-or-cast-array-to-object-object-to-array/
 */
function array_to_object($array) {
	return (object)$array;
}

/*
 * Rene
 */

function cr() {
	/* retorna um Nova linha e Retorno de Carro */
	return (chr(13) . chr(10));
}

function stosql($data = 0) {
	$data = sonumero($data);
	if ($data < 19100101) {
		return ('0000-00-00');
	} else {
		$dt = substr($data, 0, 4) . '-' . substr($data, 4, 2) . '-' . substr($data, 6, 2);
		return ($dt);
	}
}

function DateAdd($ddf, $ddi, $ddt) {
	$ddano = intval("0" . substr($ddt, 0, 4));
	$ddmes = intval("0" . substr($ddt, 4, 2));
	$dddia = intval("0" . substr($ddt, 6, 2));
	$ddr = mktime(0, 0, 0, 1, 1, 1900);
	if ($ddf == 'd') {
		$ddt = mktime(0, 0, 0, $ddmes, $dddia + $ddi, $ddano);
	}
	if ($ddf == 'w') {
		$ddt = mktime(0, 0, 0, $ddmes, $dddia + 7, $ddano);
	}
	if ($ddf == 'm') {
		$ddt = mktime(0, 0, 0, $ddmes + $ddi, $dddia, $ddano);
	}
	if ($ddf == 'y') {
		$ddt = mktime(0, 0, 0, $ddmes, $dddia, $ddano + $ddi);
	}
	return (date("Ymd", $ddt));
}

function stodbr($data = 0) {
	$data = sonumero($data);
	if ($data < 19100101) {
		return ('');
	} else {
		$dt = substr($data, 6, 2) . '/' . substr($data, 4, 2) . '/' . substr($data, 0, 4);
		return ($dt);
	}
}

function form_sisdoc_getpost() {
	global $dd, $acao;

	$CI = &get_instance();
	$post = $CI -> input -> post();
	$get = $CI -> input -> get();
	$vars = array_merge($get, $post);

	if (!isset($vars['acao'])) { $acao = '';
	} else { $acao = troca($vars['acao'], "'", '´');
	}

	for ($k = 0; $k < 100; $k++) {
		$varf = 'dd' . $k;
		if (isset($vars[$varf])) {

			$varf = $vars[$varf];
			$dd[$k] = post_security($varf);
		} else {
			$dd[$k] = '';
		}
	}
	return (true);
}

function post_security($s) {
	$s = troca($s, '<', '&lt;');
	$s = troca($s, '>', '&gt;');
	$s = troca($s, '"', '&quot;');
	//$s = troca($s,'/','&#x27;');
	$s = troca($s, "'", '&#x2F;');
	return ($s);
}

function nbr_autor($xa, $tp) {
	if (strpos($xa, ',') > 0) {
		$xb = trim(substr($xa, strpos($xa, ',') + 1, 100));
		$xa = trim(substr($xa, 0, strpos($xa, ',')));
		$xa = trim(trim($xb) . ' ' . $xa);
	}
	$xa = $xa . ' ';
	$xp = array();
	$xx = "";
	for ($qk = 0; $qk < strlen($xa); $qk++) {
		if (substr($xa, $qk, 1) == ' ') {
			if (strlen(trim($xx)) > 0) {
				array_push($xp, trim($xx));
				$xx = '';
			}
		} else {
			$xx = $xx . substr($xa, $qk, 1);
		}
	}

	$xa = "";

	/////////////////////////////
	$xp1 = "";
	$xp2 = "";
	$er1 = array("JUNIOR", "JښNIOR", "J�NIOR", "NETTO", "NETO", "SOBRINHO", "FILHO", "JR.");
	///////////////////////////// SEPARA NOMES
	{
		$xop = 0;
		for ($qk = count($xp) - 1; $qk >= 0; $qk--) {

			$xa = trim($xa . ' - ' . $xp[$qk]);
			if ($xop == 0) { $xp1 = trim($xp[$qk] . ' ' . $xp1);
				$xop = -1;
			} else { $xp2 = trim($xp[$qk] . ' ' . $xp2);
			}

			if ($xop == -1) {
				$xop = 1;
				for ($kr = 0; $kr < count($er1); $kr++) {
					if (trim(UpperCase($xp[$qk])) == trim($er1[$kr])) {
						$xop = 0;
					}
				}
			}
		}
	}

	////////// 1 e 2
	$xp2a = LowerCase($xp2);
	$xa = trim(trim($xp2) . ' ' . trim($xp1));
	if (($tp == 1) or ($tp == 2)) {
		if ($tp == 1) { $xp1 = UpperCase($xp1);
		}
		$xa = trim(trim($xp1) . ', ' . trim($xp2));
		if ($tp == 2) { $xa = UpperCase(trim(trim($xp1) . ', ' . trim($xp2)));
		}
	}
	if (($tp == 3) or ($tp == 4)) {
		if ($tp == 4) { $xa = UpperCase($xa);
		}
	}

	if (($tp >= 5) or ($tp <= 6)) {
		$xp2a = str_word_count(LowerCase($xp2), 1);
		$xp2 = '';
		for ($k = 0; $k < count($xp2a); $k++) {
			if ($xp2a[$k] == 'do') { $xp2a[$k] = '';
			}
			if ($xp2a[$k] == 'da') { $xp2a[$k] = '';
			}
			if ($xp2a[$k] == 'de') { $xp2a[$k] = '';
			}
			if (strlen($xp2a[$k]) > 0) { $xp2 = $xp2 . substr($xp2a[$k], 0, 1) . '. ';
			}
		}
		$xp2 = trim($xp2);
		if ($tp == 6) { $xa = UpperCase(trim(trim($xp2) . ' ' . trim($xp1)));
		}
		if ($tp == 5) { $xa = UpperCase(trim(trim($xp1) . ', ' . trim($xp2)));
		}
	}

	////////////////////////////////////////////////////////////////////////////////////
	if (($tp == 7) or ($tp == 8)) {
		$mai = 1;
		$xa = LowerCase($xa);
		for ($r = 0; $r < strlen($xa); $r++) {
			if ($mai == 1) { $xa = substr($xa, 0, $r) . UpperCase(substr($xa, $r, 1)) . substr($xa, $r + 1, strlen($xa));
				$mai = 0;
			} else {
				if (substr($xa, $r, 1) == ' ') { $mai = 1;
				}
			}
		}
		$xa = troca($xa, 'De ', 'de ');
		$xa = troca($xa, 'Da ', 'da ');
		$xa = troca($xa, 'Do ', 'do ');
		$xa = troca($xa, ' E ', ' e ');
	}
	return $xa;
}

function db_read($rlt) {
	global $dba, $dbn;
	if (!isset($dba)) { $dba = array();
	}

	/* */
	if (count($rlt) == 0) {
		return (FALSE);
	}

	/* */
	if (!isset($dbn)) { $dbn = 0;
	}

	$row = object_to_array($rlt[0]);

	$keys = array_keys($row);
	$key = $keys[0];

	if ((!isset($dba[$key])) or ($dbn == 0)) {
		$dba[$key] = 0;
	} else {
		$dba[$key] = $dba[$key] + 1;
	}
	$dbn = 1;
	$id = round($dba[$key]);

	if ($id >= count($rlt)) {
		return (FALSE);
	} else {
		$rslt = $row = object_to_array($rlt[$id]);
		return ($rslt);
	}

	exit ;
}

function page() {
	$page = base_url();

	return ($page);
}

function load_file_local($file) {
	$sx = '';
	$fld = fopen($file, 'r');
	while (!(feof($fld))) {
		$sx .= fread($fld, 1024);
	}
	fclose($fld);
	return ($sx);
}

/* Funcao */
function UpperCaseSQL($d) {
	$d = strtoupper($d);
	$d = troca($d, '�', 'C');
	$d = troca($d, '�', 'C');
	$d = troca($d, '�', 'N');
	$d = troca($d, '�', 'N');

	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');

	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');
	$d = troca($d, '�', 'A');

	$d = troca($d, '�', 'E');
	$d = troca($d, '�', 'E');
	$d = troca($d, '�', 'E');
	$d = troca($d, '�', 'E');

	$d = troca($d, '�', 'E');
	$d = troca($d, '�', 'E');
	$d = troca($d, '�', 'E');
	$d = troca($d, '�', 'E');

	$d = troca($d, '�', 'I');
	$d = troca($d, '�', 'I');
	$d = troca($d, 'Ή', 'I');
	$d = troca($d, '�', 'I');

	$d = troca($d, '�', 'I');
	$d = troca($d, '�', 'I');
	$d = troca($d, '�', 'I');
	$d = troca($d, '�', 'I');

	$d = troca($d, '�', 'O');
	$d = troca($d, '�', 'O');
	$d = troca($d, '�', 'O');
	$d = troca($d, '�', 'O');
	$d = troca($d, '�', 'O');

	$d = troca($d, '��', 'O');
	$d = troca($d, '��', 'O');
	$d = troca($d, '��', 'O');
	$d = troca($d, '��', 'O');
	$d = troca($d, '��', 'O');

	$d = troca($d, '�', 'U');
	$d = troca($d, '�', 'U');
	$d = troca($d, '�', 'U');
	$d = troca($d, '�', 'U');

	$d = troca($d, '�', 'U');
	$d = troca($d, '��', 'U');
	$d = troca($d, '�', 'U');
	$d = troca($d, '�', 'U');

	return $d;
}

function LowerCase($term) {
	$d = Strtolower($term);

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, 'Ή', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');
	$d = troca($d, '�', '�');

	return ($d);
}

function LowerCaseSQL($term) {
	$term = UpperCaseSql($term);
	$term = Strtolower($term);
	return ($term);
}

// ------------------------------------------------------------------------
/* FORM CLASS
 *
 *
 *
 *
 */
class form {
	var $id = 0;
	var $cp = array();
	var $data = array();
	var $post = array();
	var $tabela = '';
	var $saved = 0;

	/* row */
	var $fd = array();
	var $lb = array();
	var $mk = array();
	var $edit = false;
	var $see = false;
	var $novo = false;

	var $row_view = '';
	var $row_edit = '';
	var $row = '';
	var $offset = 30;

	function editar($cp, $tabela) {
		$ed = new form;
		$ed -> id = $this -> id;
		$ed -> tabela = $tabela;
		/* Valida botao */
		$bt = 0;
		for ($r = 0; $r < count($cp); $r++) {
			if (UpperCaseSQL(substr($cp[$r][0], 0, 2)) == '$B') { $bt = 1;
			}
		}
		if ($bt == 0) { array_push($cp, array('$B8', '', msg('submit'), False, False));
		}

		/* Monta forum�rio */
		$ed -> cp = $cp;
		$result = form_edit($ed);

		$t = $result['tela'];
		$this -> saved = $result['saved'];
		return ($t);
	}

	/***
	 * Format submit Ajax
	 */
	function ajax_submit($cp, $url = '', $div = '') {
		$vdata = "";
		$data = "";
		$saved = 0;
		$CI = &get_instance();
		$acao = $CI -> input -> post('acao');

		/* VALIDA POST */
		if (strlen($acao) > 0) {
			$saved = valida_post($cp);
			if ($saved > 0) {
				return ($saved);
			}
		}
		//valida_post
		for ($r = 0; $r < count($cp); $r++) {
			$tp = substr($cp[$r][0], 0, 2);

			if (($tp == '$O') or ($tp == '$Q')) {
				$vdata .= '$dd' . $r . ' = $("#dd' . $r . ' option:selected").val(); ' . cr();
			} else {
				$vdata .= '$dd' . $r . ' = $("#dd' . $r . '").val(); ' . cr();
			}
			if (strlen($data) > 0) { $data .= ', ' . cr();
			}
			$data .= 'dd' . $r . ': $dd' . $r;
		}
		$data .= ', acao: "save" ';
		$sx = '
		<script>
			$("#acao").click(function() {
				' . $vdata . '
				$.ajax({
					url : "' . $url . '",
					type : "post",
					data : { ' . $data . ' }, 
					success : function(data) {
						$("#' . $div . '").html(data);
				} });
			});
		</script>
		';
		return ($sx);
	}

}

/* Paginacao */
function npag($obj, $npage = 1, $tot = 10, $offset = 20) {
	$page = uri_string();
	$pagm = $tot;

	/* algoritimo */
	$page = substr($page, 0, strpos($page, '/'));
	$link = $obj -> row;

	$pagi = $npage;
	$pagf = $npage + 10;

	if ($pagi > 5) {
		$pagi = $pagi - 5;
		$pagf = $pagf - 5;
	} else {
		$pagi = 1;
	}

	$sx = '
<ul id="npag" class="npag">
	';
	if ($pagi > 1) {
		$linka = '<A HREF="' . $link . '/' . ($pagi - 1) . '">';
		$sx .= $linka . '
	<li>
		<<
	</li></A> ';
	}

	/* PAGINACAO */
	if ($pagf > $tot) { $pagf = $tot;
	}
	for ($r = $pagi; $r < ($pagf + 1); $r++) {
		$linka = '<A HREF="' . $link . '/' . $r . '">';
		$sx .= $linka . '
	<li>
		' . $r . '
	</li></a>' . chr(10) . chr(13);
	}
	/* */
	if ($pagf < $pagm) {
		$linka = '<A HREF="' . $link . '/' . $r . '">';
		$sx .= $linka . '
	<li>
		>>
	</li></A>';
	}
	/* */
	$sx .= '
	<li style="width: 100px; border: 0px solid #FFFFFF; background-color: #ffffff;">
		';
	$sx .= 'Page:';
	$linka = $link . '/';
	$sx .= '
		<select onChange="location=\'' . $linka . '\'+this.options[this.selectedIndex].value;">
			';
	for ($r = 1; $r <= $pagm; $r++) {
		$chk = '';
		if ($r == $npage) { $chk = "selected";
		}
		$sx .= '<option value="' . $r . '" ' . $chk . '>' . $r . '</option>';
	}
	$sx .= '
		</select>
		';
	$sx .= '
	</li>
	';

	/* Busca */
	$sx .= '
	<li style="width: 50px; border: 0px solid #FFFFFF; background-color: #ffffff;">
		<nobr>
			';
	$sx .= 'Filtro:';
	$sx .= '
	</li>
	';
	$sx .= '
	<li style="width: 220px; border: 0px solid #FFFFFF; background-color: #ffffff;">
		<nobr>
			';

	$vlr = '';
	$sx .= form_open();
	$data = array('name' => 'dd1', 'id' => 'dd1', 'value' => $vlr, 'maxlength' => '100', 'size' => '100', 'style' => 'width:150px', );
	$sx .= form_input($data);
	$sx .= form_hidden('dd2', 'search');

	$sx .= form_submit('acao', 'busca');
	$sx .= form_submit('acao', 'limpa filtro');
	if ($obj -> novo == true) {
		$sx .= form_submit('acao', 'novo');
	}
	$sx .= form_close();
	$sx .= '
	</li>
	';
	$sx .= '</ul>';
	return ($sx);
}

/* Funcao troca */
if (!function_exists('troca')) {
	function troca($qutf, $qc, $qt) {
		if (is_array($qutf)) {
			return ('erro');
		}
		return (str_replace(array($qc), array($qt), $qutf));
	}

}

if (!function_exists('splitx')) {
	function splitx($in, $string) {
		$string .= $in;
		$vr = array();
		while (strpos(' ' . $string, $in)) {
			$vp = strpos($string, $in);
			$v4 = trim(substr($string, 0, $vp));
			$string = trim(substr($string, $vp + 1, strlen($string)));
			if (strlen($v4) > 0) { array_push($vr, $v4);
			}
		}
		return ($vr);
	}

}

if (!function_exists('form_edit')) {
	/* Form Edit
	 * @parameter $cp - campos de edicao
	 * @parameter $tabela - nome da tabela que le/insere/atualiza registro
	 * @paramrter $id - chave primaria do registro
	 * @parameter $data - Dados do post inserir no controler: $data = $this->input->post();
	 */

	function row($obj, $pag = 1) {
		$start = round($pag);
		$offset = $obj -> offset;
		$start = $pag * $offset;
		$CI = &get_instance();

		/* POST */
		$post = $CI -> input -> post();
		$dd = $post;
		$acao = $CI -> input -> post("acao");

		if ($acao == 'novo') {
			redirect($obj -> row_edit . '/0/0');
			exit ;
		}
		if ($acao == 'limpa filtro') {
			$CI -> session -> userdata['row_termo'] = '';
		}
		$acao = '';
		$term = '';
		if (isset($post)) {
			if (isset($post['dd2'])) { $acao = $post['dd2'];
			}
			if (isset($post['dd1'])) { $term = $post['dd1'];
			}
			$term = troca($term, "'", "�");
		}

		$fd = $obj -> fd;
		$mk = $obj -> mk;
		$lb = $obj -> lb;
		/* parametros */
		$edit = $obj -> edit;
		$see = $obj -> see;
		$novo = $obj -> novo;

		/* campo ID */
		$fld = $fd[0];

		$sh = '<thead><tr>';
		for ($r = 1; $r < count($fd); $r++) {
			$label = $lb[$r];
			$sh .= '<th>' . $label . '</th>';
			/* campos da consulta */
			$fld .= ', ' . $fd[$r];
		}
		if ($obj -> edit == True) {
			$sh .= '<th>action</th>';
		}
		$sh .= '
	</tr>
</thead>
';

		/* Recupera dados */
		$tabela = $obj -> tabela;

		$CI = &get_instance();

		/* */
		if (strlen($acao) == 0) {
			if (isset($CI -> session -> userdata['row_termo'])) {
				$term = $CI -> session -> userdata['row_termo'];
			} else {
				$term = '';
			}
		}
		if (isset($post['dd9'])) {
			if ($post['dd9'] == 'clean') {
				$term = '';
				$CI -> session -> userdata['row_termo'] = '';
			}
		}

		/* Where */
		if (strlen($term) > 0) {
			$newdata = array('row_termo' => $term);
			$CI -> session -> set_userdata($newdata);

			$term = troca($term, ' ', ';');
			$term = splitx(';', $term);

			$wh = ' (' . $fd[1] . " like '%" . $term[0] . "%') ";
			$wh = ' where ' . $wh;
		} else {
			$wh = '';
		}
		if (strlen($acao) > 0) {
			$pag = 1;
		}

		/* total de registros */
		$sql = "select count(*) as total from " . $tabela . " $wh ";
		$query = $CI -> db -> query($sql);
		$row = $query -> row();
		$total = $row -> total;

		/* mostra */
		$start_c = ($start - $offset);
		if ($start_c < 1) { $start_c = 0;
		}

		$sql = "select $fld from " . $tabela . ' ' . $wh;
		$sql .= " order by " . $fd[1];
		$sql .= " limit " . $start_c . " , " . $offset;
		$query = $CI -> db -> query($sql);
		$data = '';

		/* Metodo de chamada */
		$url_pre = uri_string();
		$url_pre = substr($url_pre, 0, strpos($url_pre, '/')) . '/view';

		$url_pre = $obj -> row_view;

		foreach ($query->result_array() as $row) {
			/* recupera ID */
			$flds = trim($fd[0]);
			$id = $row[$flds];

			/* mostra resultado da query */
			$data .= '<tr>';
			for ($r = 1; $r < count($fd); $r++) {
				/* mascara */
				$flds = trim($fd[$r]);
				if (isset($mk[$r])) {
					$msk = trim($mk[$r]);
				} else {
					$msk = 'L';
				}
				$mskm = '';
				switch($msk) {
					case 'C' :
						$mskm = ' align="center" ';
						break;
					case 'L' :
						$mskm = ' align="left" ';
						break;
					case 'R' :
						$mskm = ' align-"right" ';
						break;
				}

				/* see */
				if ($see == TRUE) {
					$link = '<A HREF="' . $obj -> row_view . '/' . $id . '/' . checkpost_link($id) . '">';
					$linkf = '</A>';
				} else {
					$link = '';
					$linkf = '';
				}
				$data .= chr(15) . '<td ' . $mskm . '>' . $link . trim($row[$flds]) . $linkf . '</td>';
			}
			if ($obj -> edit == True) {
				$idr = trim($row[$fd[0]]);
				$data .= chr(15) . '<td ' . $mskm . '><A HREF="' . $obj -> row_edit . '/' . $idr . '/' . checkpost_link($idr) . '"><img src="' . base_url('/img/icon/icone_editar.png') . '" border=0 height="16"></td>';
			}
			$data .= '
</tr>
' . chr(13) . chr(10);
		}

		/* Tela completa */
		$tela = '
<table width="100%" id="row">
	';
		$tela .= $sh;
		$tela .= $data;
		$tela .= '
	<tr>
		<th colspan=10 align="left">Total ' . $total . ' de registros' . '</th>
	</tr>
	';
		$tela .= '
</table>
';

		$total_page = (int)($total / $offset) + 1;

		$pags = npag($obj, $pag, $total_page, $offset);

		return ($pags . $tela);
	}

	function form_save($obj) {
		/* recupera post */
		/* Retorna se nao existir tabela */
		if (strlen($obj -> tabela) == 0) {
			return ('');
		}
		$CI = &get_instance();
		$post = $CI -> input -> post();

		$tabela = $obj -> tabela;
		$cp = $obj -> cp;
		$id = $obj -> id;

		/* Modo de gravacao */
		if (round($id) > 0) {
			/* Update */
			$sql = "update " . $tabela . " set ";
			$sv = 0;
			for ($r = 1; $r < count($cp); $r++) {
				/* verifica se existe parametro */
				$vlr = $CI -> input -> post('dd' . $r);
				$cpt = $cp[$r][0];
				/* Checkbox */
				if (substr($cpt, 0, 3) == '$SW') {
					if (strlen($vlr) == 0) { $vlr = '0';
					}
				}
				/* Checkbox */
				if (substr($cpt, 0, 2) == '$N') {
					if (strlen($vlr) == 0) { $vlr = '0';
					}
					$vlr = troca($vlr, '.', '');
					$vlr = troca($vlr, ',', '.');
				}
				/* Data */
				if (substr($cpt, 0, 2) == '$D') {
					$vlr = strzero(sonumero($vlr), 8);
					$vlr = substr($vlr, 4, 4) . '-' . substr($vlr, 2, 2) . '-' . substr($vlr, 0, 2);
				}
				/* Excessoes */
				if (isset($vlr)) {
					/* verefica se o campo na gravavel */
					if (strlen($cp[$r][1]) > 0) {
						if ($sv > 0) { $sql .= ', ';
						}
						$sql .= $cp[$r][1] . " = '" . $vlr . "' ";
						$sv++;
					}
				}
			}
			$fld = $cp[0][1];
			$sql .= "where " . $fld . ' = ' . $id;
		} else {
			/* Insert */
			$sql = "insert into " . $tabela . " ";
			$sq1 = '';
			$sq2 = '';
			$sv = 0;
			for ($r = 1; $r < count($cp); $r++) {
				/* verifica se existe parametro */
				$vlr = $CI -> input -> post('dd' . $r);
				$cpt = $cp[$r][0];
				/* Checkbox */
				if (substr($cpt, 0, 3) == '$SW') {
					if (strlen($vlr) == 0) { $vlr = '0';
					}
				}
				/* Checkbox */
				if (substr($cpt, 0, 2) == '$N') {
					if (strlen($vlr) == 0) { $vlr = '0';
					}
					$vlr = troca($vlr, '.', '');
					$vlr = troca($vlr, ',', '.');
				}
				/* Data */
				if (substr($cpt, 0, 2) == '$D') {
					$vlr = strzero(sonumero($vlr), 8);
					$vlr = substr($vlr, 4, 4) . '-' . substr($vlr, 2, 2) . '-' . substr($vlr, 0, 2);
				}

				/* Salvar */
				if (isset($vlr)) {

					if ($sv > 0) { $sq1 .= ', ';
						$sq2 .= ', ';
					}
					$sq1 .= $cp[$r][1];
					$sq2 .= "'" . $vlr . "'";
					$sv++;
				}
			}
			$sql .= '(' . $sq1 . ') values (' . $sq2 . ')';
		}
		if ($sv == 0) { $sql = "";
		} else {
			$CI = &get_instance();
			$query = $CI -> db -> query($sql);
			return (1);
		}
		return (0);
	}

	function form_menu($id, $editar = FALSE, $excluir = FALSE) {
		$CI = &get_instance();
		$url_pre = uri_string();
		$url_edit = troca($url_pre, '/view', '/edit');
		$url_del = troca($url_pre, '/view', '/del');

		$link = '';

		if ($editar == TRUE) {
			$link_editar = base_url($url_edit);
			$link = '<A HREF="' . $link_editar . '" class="link lt0">' . $CI -> lang -> line('sisdocform_edit') . '</A>';
		}

		if ($excluir == TRUE) {
			$link_delete = base_url($url_del);
			$link .= ' | <A HREF="' . $link_delete . '" class="link lt0">' . $CI -> lang -> line('sisdocform_del') . '</A>';
		}
		return ($link);

	}

	function checkpost_link($id) {
		$chk = md5($id . date("Ymd"));
		return ($chk);
	}

	function checkpost($id, $chk1) {
		$chk2 = checkpost_link($id);
		if ($chk1 == $chk2) {
			return (0);
		} else {
			return (1);
		}
	}

	/*
	 *
	 * Le dados do banco
	 */
	function le_dados($obj) {
		$id = $obj -> id;
		$tabela = $obj -> tabela;
		$fld = $obj -> cp[0][1];

		if ($id == 0) {
			return ( array());
		}

		$sql = "select * from " . $tabela . " where $fld = $id";
		$CI = &get_instance();
		$query = $CI -> db -> query($sql);
		$row = $query -> row();

		$cp = $obj -> cp;

		for ($r = 0; $r < count($cp); $r++) {
			$tp = $cp[$r][0];
			$fld = $cp[$r][1];

			if (substr($tp, 0, 2) == '$D') {
				if (!isset($row -> $fld)) {
					$vlr = '';
				} else {
					$vlr = $row -> $fld;
				}

				$vlr = trim(sonumero($vlr));
				$vlr = substr($vlr, 6, 2) . '/' . substr($vlr, 4, 2) . '/' . substr($vlr, 0, 4);
				if ($vlr == '00/00/0000') { $vlr = '';
				}
				if ($vlr == '//') { $vlr = '';
				}
				if ($vlr == '') { $vlr = date("d/m/Y");
				}
				$row -> $fld = $vlr;
			}
			if (substr($tp, 0, 2) == '$N') {
				$fld = $cp[$r][1];
				if (strlen($fld) > 0) {
					$row -> $fld = number_format($row -> $fld, 2, ',', '.');
				}
			}
			if (substr($tp, 0, 2) == '$I') {
				$fld = $cp[$r][1];
				if (strlen($fld) > 0) {
					$row -> $fld = number_format($row -> $fld, 0, ',', '.');
				}
			}
		}
		return ($row);
	}

	function valida_post($cp) {
		/* recupera post */
		$CI = &get_instance();
		$post = $CI -> input -> post();
		/* define como default */
		$saved = 1;
		for ($r = 0; $r < count($cp); $r++) {
			$requer = $cp[$r][3];
			if ($requer == true) {
				$vlr = $CI -> input -> post('dd' . $r);
				if (strlen($vlr) == 0) { $saved = 0;
				}
			}
		}
		return ($saved);
	}

	function form_edit($obj) {
		$dd = array($obj -> id);
		$saved = 0;

		/* recupera post */
		$CI = &get_instance();
		$post = $CI -> input -> post();

		$cp = $obj -> cp;
		/* Recupera dados do banco */
		$recupera = 0;
		/* recupera ACAO do post */
		$acao = '';

		if (!isset($post['acao'])) { $recupera = 1;
		}

		/* Save in table */
		if ($recupera == 0) {
			/* Valida */
			$saved = valida_post($cp);
			if ($saved > 0) {
				form_save($obj);
			}
		}

		$tela = '';
		$tela .= '
<table class="tabela00" width="100%" border=0 >
	';
		$tela .= '
	<tr>
		<td>' . form_open() . '</td>
	</tr>
	';

		if ($recupera == 1) {
			/* recupera dados do banco */
			if (strlen($obj -> tabela) > 0) {
				$data = le_dados($obj);
			} else {
				$recupera = 0;
			}
		} else {
			$data = array();
		}
		//$tela .= 'Recupera = ' . $recupera;

		for ($r = 0; $r < count($cp); $r++) {
			/* Recupera dados */
			$vlr = '';
			if ($recupera == 1) {
				/* banco de dados */
				$fld = $cp[$r][1];
				if (isset($data -> $fld)) {
					$vlr = $data -> $fld;
				}
			} else {
				if (isset($post['dd' . $r])) {
					$vlr = $post['dd' . $r];
				}
			}
			$tela .= form_field($cp[$r], $vlr);
		}
		$tela .= '</table>';
		$tela .= "
		<script>
			$(document).ready(function(){
  				$('.date').mask('00/00/0000');
  				$('.money').mask('000.000.000.000.000,00', {reverse: true});
			});
		</script>
		";
		$tela .= form_close();

		$data = array('tela' => $tela, 'saved' => $saved);
		return ($data);
	}

	/* Botao novo */
	function form_botton_new($url, $txt = 'Novo registro') {
		$link = '<A HREF="' . $url . '/edit/0/' . checkpost_link('0') . '">';
		$sx = $link . '<span class="botton_new">' . $txt . '</span>' . '</A>';
		return ($sx);
	}

	/* Formulario */
	function form_field($cp, $vlr) {
		global $dd, $ddi;
		/* Zera tela */
		$tela = '';

		$table = 1;
		if (!(isset($dd))) { $dd = array();
			$ddi = 0;
		}

		$type = $cp[0];
		$label = $cp[2];
		$required = $cp[3];
		$placeholder = $label;
		$readonly = $cp[4];

		$tt = substr($type, 1, 1);

		/* exessoes */
		if (substr($type, 0, 4) == '$MES') { $tt = 'MES';
		}
		if (substr($type, 0, 3) == '$SW') { $tt = 'SW';
		}
		if (substr($type, 0, 3) == '$HV') { $tt = 'HV';
		}
		if (substr($type, 0, 5) == '$LINK') { $tt = 'LINK';
		}
		if (substr($type, 0, 3) == '$AA') { $tt = 'AA';
		}

		/* form */
		$max = 100;
		$size = 100;
		$dados = array();
		$dn = 'dd' . $ddi;

		if ($table == 1) {
			$td = '<td>';
			$tdl = '<td align="right">';
			$tdn = '</td>';

			$tr = '<tr valign="top">';
			$trn = '</tr>';
		} else {
			$td = '';
			$tdl = '';
			$tdn = '';
			$tr = '';
			$trn = '';
		}

		//$dados = array('name'=>'dd'.$ddi, 'id'=>'dd'.$ddi,'value='.$dd[$ddi],'maxlenght'=>$max,'size'=>$size,$class=>'');
		switch ($tt) {
			case '{' :
				$tela .= $tr;
				$tela .= '<td colspan=2>';
				$tela .= '<fieldset class="border1"><legend class="lt3 bold">' . $label . '</legend>';
				$tela .= '<table width="100%" class="tabela00">';
				$tela .= '<tr><th width="20%"></th><th wodth="80%"></tr>';
				break;
			case '}' :
				$tela .= '</table>';
				$tela .= '</fieldset>';
				$tela .= '</table>';
				break;
			/* Select Box */
			case '[' :
				$ntype = trim(substr($type, 2, strlen($type)));
				$n1 = substr($ntype, 0, strpos($ntype, '-'));
				$n2 = sonumero(substr($ntype, strpos($ntype, '-'), strlen($ntype)));
				$n3 = substr($ntype, strlen($ntype) - 1, 1);
				$options = array('' => '::select an option::');

				if ($n3 != 'D') {
					/* Crescente */
					for ($r = $n1; $r <= $n2; $r++) {
						$options[$r] = $r;
					}
				} else {
					/* Descrecente */
					for ($r = $n2; $r >= $n1; $r--) {
						$options[$r] = $r;
					}
				}

				/* recupera dados */
				$dados = array('name' => $dn, 'id' => $dn, 'size' => 1, 'class' => 'form_select');

				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}
				$tela .= '<TD>';
				$tela .= form_dropdown($dados, $options, $vlr);
				break;

			/* Select Box - Autocomplete*/
			case 'AA' :
				$ntype = trim(substr($type, 2, strlen($type)));
				$ntype = troca($ntype, ':', ';') . ';';
				$param = splitx(';', $ntype);

				/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}
				/* **/
				$dados = array('name' => $dn . 'a', 'id' => $dn . 'a', 'value' => $vlr, 'maxlenght' => $max, 'size' => $size, 'placeholder' => $label, 'class' => 'form_string', 'autocomplete' => 'on');
				$tela .= $td . form_input($dados);

				$dados = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'maxlenght' => $max, 'size' => 10, 'placeholder' => $label, 'class' => 'form_string', 'autocomplete' => 'on');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= form_input($dados);

				$tela .= $tdn . $trn;

				$tela .= '
				<script>
					$(function(){
						var $sfield = $("#' . $dn . 'a").autocomplete({
							source: function(request, response){
								var url = "' . base_url("index.php/instituicao/autocomplete?term=") . '" + $("#' . $dn . 'a").val();
								$.get(url, {}, 
									function(data)
									{
									response($.map(data, function(rlt) 
										{
											return { label: rlt.nome, value: rlt.id };
										}));
									}, "json");
								}, 
                        select: function( event, ui ) {
                            $( "#' . $dn . 'a" ).val( ui.item.label );
                            $( "#' . $dn . '" ).val( ui.item.value );
                            return false;
							} ,	minLength: 4, autofocus: true });
						});
				</script>
				';
				break;
			/* Button */
			case 'B' :
				$tela .= $tr . $tdl . $td;
				$dados = array('name' => 'acao', 'id' => 'acao', 'value' => $label);
				$tela .= form_submit($dados);
				$tela .= $tdn . $trn;
				break;
			case 'C' :
			/* TR da tabela */
				$tela .= $tr;

				$dados = array('name' => $dn, 'id' => $dn, 'value' => '1', 'class' => 'onoffswitch-checkbox');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= '<td align="right">' . form_checkbox($dados, 'accept', $vlr); ;

				/* label */
				if (strlen($label) > 0) {
					$tela .= '<td>' . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}

				$tela .= $tdn . $trn;
				break;

			/* Oculto */
			case 'H' :
				$dados = array($dn => $vlr);
				$tela .= form_hidden($dados);
				break;

			case 'HV' :
				$vlr = $cp[2];
				$dados = array($dn => $vlr);
				$tela .= '<input type="hidden" name="' . $dn . '" id="' . $dn . '" value="' . $vlr . '">' . cr();
				break;

			/* Select Box - Mes */
			case 'MES' :
				$options = array('' => '::select an option::');

				/* recupera dados */
				for ($r = (date("Y") + 4); $r > 1990; $r--) {
					$vlra = $r;
					$options[$vlra] = '===' . $r . '===';
					//array_push($options,array('2019'));
					$ar = array();
					for ($y = 12; $y > 0; $y--) {
						$vlrs = $r . strzero($y, 2) . '01';
						$cpt = $r . '/' . msg('mes_' . strzero($y, 2));
						$op = array($vlr => $cpt);
						$ar[$vlrs] = $cpt;
						//array_push($options,$op);
					}
					$options[$vlra] = $ar;
				}

				$dados = array('name' => $dn, 'id' => $dn, 'size' => 1, 'class' => 'form_select');
				$tela .= $tr;
				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}
				if (strlen($vlr) == 0) { $vlr = date("Ym") . '01';
				} else {
					$vlr = sonumero($vlr);
				}
				$tela .= '<TD>';
				$tela .= form_dropdown($dados, $options, $vlr);
				break;

			/* Select Box */
			case 'O' :
				$ntype = trim(substr($type, 2, strlen($type)));
				$ntype = troca($ntype, '&', ';') . ';';
				$param = splitx(';', $ntype);

				$options = array('' => '::select an option::');
				for ($r = 0; $r < count($param); $r++) {
					if (count(trim($param[$r])) > 0) {
						$nterm = splitx(':', $param[$r] . ':');
						$key = $nterm[0];
						$valor = $nterm[1];
						$options[$key] = $valor;
					}
				}

				/* recupera dados */
				$dados = array('name' => $dn, 'id' => $dn, 'size' => 1, 'class' => 'form_select');

				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}
				$tela .= '<TD>';
				$tela .= form_dropdown($dados, $options, $vlr);
				break;

			/* Select Box */
			case 'Q' :
				$ntype = trim(substr($type, 2, strlen($type)));
				$ntype = troca($ntype, ':', ';') . ';';
				$param = splitx(';', $ntype);
				$options = array('' => '::select an option::');

				/* recupera dados */
				$sql = "select * from (" . $param[2] . ") as tabela order by " . $param[1];
				$CI = &get_instance();
				$query = $CI -> db -> query($sql);
				foreach ($query->result_array() as $row) {
					/* recupera ID */
					$flds = trim($param[0]);
					$vlrs = trim($param[1]);
					$flds = $row[$flds];
					$vlrs = $row[$vlrs];
					$options[$flds] = $vlrs;
				}

				$dados = array('name' => $dn, 'id' => $dn, 'size' => 1, 'class' => 'form_select');

				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}
				$tela .= '<TD>';
				$tela .= form_dropdown($dados, $options, $vlr);
				break;

			/* String */
			case 'R' :
			/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}
				$dados = array('name' => $dn, 'id' => $dn, 'value' => '1', 'class' => 'onoffswitch-checkbox');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= $td . form_checkbox($dados, 'accept', $vlr); ;
				$tela .= $tdn . $trn;
				break;

			/* String */
			case 'D' :
			/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}

				$dados = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'maxlenght' => 12, 'size' => 12, 'placeholder' => $label, 'class' => 'form_string date');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= $td . form_input($dados) . ' (dd/mm/yyyy)';
				$tela .= $tdn . $trn;
				$tela .= '
				  <script>
				  $(function() {
				    $( "#' . $dn . '" ).datepicker();
				  });
				  </script>
				';
				break;

			/* String */
			case 'LINK' :
			/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}

				$dados = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'maxlenght' => $max, 'size' => $size, 'placeholder' => $label, 'class' => 'form_string');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= $td . form_input($dados);
				$tela .= $tdn . $trn;
				break;

			case 'M' :
			/* TR da tabela */
				$tela .= $tr;

				/* label */
				$tela .= '<td colspan=1>' . '<span class="lt1">' . $label . '</span>';
				$tela .= $tdn . $trn;
				break;

			/* form_number */
			case 'N' :
			/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}

				$dados = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'maxlenght' => 15, 'size' => 15, 'placeholder' => $label, 'class' => 'form_string money');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= $td . form_input($dados);
				$tela .= $tdn . $trn;
				break;

			/* String */
			case 'S' :
			/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}

				$dados = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'maxlenght' => $max, 'size' => $size, 'placeholder' => $label, 'class' => 'form_string');
				if ($readonly == false) { $dados['readonly'] = 'readonly';
				}
				$tela .= $td . form_input($dados);
				$tela .= $tdn . $trn;
				break;

			case 'SW' :
				{
					/* TR da tabela */
					$tela .= $tr;
					$checked = False;
					/* label */
					$tela .= ' <td class="lt4" colspan=2>
						<table>
							<tr>
								<td>
								<div class="onoffswitch">
									';
					/* cehcked */
					if (trim($vlr) == '1') { $checked = True;
					}

					/* Monta lista */
					$data = array('name' => $dn, 'checked' => $checked, 'class' => 'onoffswitch-checkbox', 'id' => $dn, 'value' => '1');
					$tela .= form_checkbox($data);
					$tela .= ' <label class="onoffswitch-label" for="' . $dn . '"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
								</div></td><td class="lt2"> ' . $label . ' </td>
							</tr>
						</table></td></tr>';
				}
				break;
			/* Update */
			case 'U' :
				if (round($vlr) == 0) { $vlr = date("Y-m-d");
				}
				$dados = array($dn => $vlr);
				$tela .= form_hidden($dados);
				break;

			/* Textarea */
			case 'T' :
				$ntype = trim(substr($type, 2, strlen($type)));
				$ntype = troca($ntype, ':', ';') . ';';
				$param = splitx(';', $ntype);

				/* TR da tabela */
				$tela .= $tr;

				/* label */
				if (strlen($label) > 0) {
					$tela .= $tdl . $label . ' ';
				}
				if ($required == 1) { $tela .= ' <font color="red">*</font> ';
				}

				$data = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'rows' => $param[1], 'cols' => $param[0], 'class' => 'form_textarea');
				$tela .= $td . form_textarea($data);
				$tela .= $tdn . $trn;
				break;
			/* Password */
			case 'P' :
				if (strlen($label) > 0) {
					$tela .= $label . ' ';
				}
				$dados = array('name' => $dn, 'id' => $dn, 'value' => $vlr, 'maxlenght' => $max, 'size' => $size);
				$tela .= form_password($dados);
				break;
		}
		$ddi++;
		return ($tela);
	}

	//Define a callback and pass the format of date
	function valid_date($date, $format = 'Y-m-d') {
		$d = DateTime::createFromFormat($format, $date);
		//Check for valid date in given format
		if ($d && $d -> format($format) == $date) {
			return true;
		} else {
			$this -> form_validation -> set_message('valid_date', 'The %s date is not valid it should match this (' . $format . ') format');
			return false;
		}
	}

}
?>