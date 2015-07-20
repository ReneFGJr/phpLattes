<?php
class inports extends CI_Model {
	function insere_pesquisador($nome, $inst) {
		$sql = "select * from researcher where rs_name = '$nome' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			return ($line['id_rs']);
		} else {
			$sqli = "insert into researcher 
							(rs_name, rs_inst, rs_lattes, rs_ativo)
							values
							('$nome','$inst','',1)
					";
			$rlt = $this->db->query($sqli);
			$sql = "select * from researcher where rs_name = '$nome' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt)) {
				return ($line['id_rs']);
			}
		}
	}

	function inport_01() {
		$txt = fopen('_process/AAA.CSV', 'r');
		$t = '';
		while (!feof($txt)) {
			$t .= fread($txt, 1024);
		}
		fclose($txt);
		return ($t);
	}
	function inport_02() {
		$txt = fopen('_process/bbb.csv', 'r');
		$t = '';
		while (!feof($txt)) {
			$t .= fread($txt, 1024);
		}
		fclose($txt);
		return ($t);
	}
}
?>
