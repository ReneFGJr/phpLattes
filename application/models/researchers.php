<?php
class researchers extends CI_Model
	{
	var $tabela = 'researcher';
	
	function row($obj) {
		$obj -> fd = array('id_rs', 'rs_name', 'rs_name_find','rs_lattes');
		$obj -> lb = array('ID', 'Nome','cited','Lattes');
		$obj -> mk = array('', 'L', 'L', 'L');
		return ($obj);
	}
	
	function le($id)
		{
			$sql = "select * from ".$this->tabela. " where id_rs = ".$id;
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			
			$line = $rlt[0];
			return($line);
		}
	
	function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_rs','',False,True));
			array_push($cp,array('$S200','rs_name',msg('pesquisador'),True,True));
			array_push($cp,array('$S200','rs_name_find',msg('nome_busca'),True,True));
			array_push($cp,array('$S7','rs_inst',msg('instituicao'),False,True));
			array_push($cp,array('$S100','rs_lattes',msg('link_lattes'),False,True));
			array_push($cp,array('$O 1:SIM&N:NÃO','rs_ativo',msg('ativo'),False,True));
			array_push($cp,array('$S40','rs_tipo',msg('eq_part_number'),False,True));
			array_push($cp,array('$H','rs_lastupdate','',False,True));
			
			array_push($cp,array('$B','',msg('salvar'),false,True));
			
			return($cp);
		}
	function view_cited($name)
		{
			$names = splitx(';',$name.';');
			$wh = '';
			for ($r=0;$r < count($names);$r++)
				{
					$name = $names[$r];
					if (strlen($wh) > 0) { $wh .= ' or '; }
					$wh .= "( wr like '%$name%' )";
				}
			$wh = '('.$wh.')';
			$sql = "select * from works where $wh";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			
			$sx = '<table class="tabela00 lt1" width="100%">';
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					$sx .= '<tr>';
					$sx .= '<td>';
					$sx .= ($r+1);
					$sx .= '</td>';
					$sx .= '<td>';
					$sx .= $line['wa1'];
					$sx .= '('.$line['w2'].')';
					$sx .= '</td>';
					$sx .= '<td>';
					$sx .= $line['wr'];
					$sx .= '</td>';
					$sx .= '</tr>';
				}
			$sx .= '</table>';
			return($sx);
		}	
		
	function view_works($id)
		{
			$sql = "select * from reference where r_researcher = $id order by id_r";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			
			$sx = '<table class="tabela00 lt1" width="100%">';
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					$sx .= '<tr>';
					$sx .= '<td>';
					$sx .= ($r+1);
					$sx .= '</td>';
					$sx .= '<td>';
					$sx .= $line['r_text'];
					$sx .= '</td>';
					$sx .= '</tr>';
				}
			$sx .= '</table>';
			return($sx);
			
		}
	}
?>
