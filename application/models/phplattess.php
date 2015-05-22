<?php
class phpLattess extends CI_Model
	{
	function inport_data($link)
		{
			echo '--->'.$link;
			$fl = load_page($link);
			$fl = $fl['content'];
			echo $fl;
			exit;
			
			return($fl);
		}
	function dgp_nome_do_grupo($fl)
		{
			$sx = 'Nome do grupo: ';
			$pos = round(strpos($fl,$sx));
			echo '--->'.$pos;
			if ($pos > 0)
				{
					$st = substr($fl,$pos+strlen($sx),400);
					return($st);
				} else {
					return("# nome não localizado #");
				}
		}
	}
?>