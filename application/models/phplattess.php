<?php
class phpLattess extends CI_Model {

	function dgp_import($link) {
		$data = $this -> inport_data($link);
		$data = $this -> removeSCRIPT($data);
		$data = $this -> removeCLASS($data);
		$data = $this -> removeSPACE($data);
		$data = $this -> removeTAG($data);

		/* Dados da instituicao */
		$datar = array();
		$datar['grupo'] = $this -> phplattess -> recupera_nomegrupo($data);
		$datar['instituicao'] = $this -> phplattess -> recupera_identificacao($data);
		$datar['endereco'] = $this -> phplattess -> recupera_endereco($data);
		$datar['repercusao'] = $this -> phplattess -> recupera_repercussao($data);
		$datar['linhas'] = $this -> phplattess -> recupera_linha_pesquisa($data);
		$datar['equipe'] = $this -> phplattess -> recupera_recursosHumanos($data);
		$datar['parceiras'] = $this -> phplattess -> recupera_instituicoesparceiras($data);
		$datar['equipamentos'] = $this -> phplattess -> recupera_equipamentos_softwares($data);
		
		return($datar);
	}

	function recupera_nomegrupo($text) {
		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');
		$data = array();
		$data['nome_grupo'] = $this -> recupera_method_5($text, '<h1 >', '<div >');
		return ($data);
	}

	function recupera_identificacao($text) {
		$sc = 'id="identificacao"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');
		$data = array();
		$data['situacao_grupo'] = $this -> recupera_method_1($text, 'Situação do grupo:');
		$data['ano_formacao'] = $this -> recupera_method_1($text, 'Ano de formação:');
		$data['data_situacao'] = $this -> recupera_method_1($text, 'Data da Situação:');
		$data['ultimo_envio'] = $this -> recupera_method_1($text, 'Data do último envio:');
		$data['lideres'] = $this -> recupera_method_2($text, 'Líder(es) do grupo:');
		$data['area_predominante'] = $this -> recupera_method_2($text, 'Área predominante:');
		$data['instituicao'] = $this -> recupera_method_1($text, 'Instituição do grupo:');
		$data['unidade'] = $this -> recupera_method_1($text, 'Unidade:');

		return ($data);
	}

	/* Endereco e contato do grupo */
	function recupera_endereco($text) {
		$sc = 'id="endereco"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');

		/* */
		$data = array();
		$data['logradouro'] = $this -> recupera_method_1($text, 'Logradouro:');
		$data['numero'] = $this -> recupera_method_1($text, 'Número:');
		$data['complemento'] = $this -> recupera_method_1($text, 'Complemento:');
		$data['bairro'] = $this -> recupera_method_1($text, 'Bairro:');
		$data['estado'] = $this -> recupera_method_1($text, 'UF:');
		$data['localidade'] = $this -> recupera_method_1($text, 'Localidade:');
		$data['cep'] = $this -> recupera_method_1($text, 'CEP:');
		$data['caixa_postal'] = $this -> recupera_method_1($text, 'Caixa Postal:');
		$data['latitude'] = $this -> recupera_method_1($text, 'Latitude:');
		$data['longitude'] = $this -> recupera_method_1($text, 'Longitude:');
		$data['telefone'] = $this -> recupera_method_1($text, 'Telefone:');
		$data['fax'] = $this -> recupera_method_1($text, 'Fax:');
		$data['contato_email'] = $this -> recupera_method_1($text, 'Contato do grupo:');
		$data['website'] = $this -> recupera_method_1($text, 'Website:');

		return ($data);
	}

	/* Repercursao */
	function recupera_repercussao($text) {
		$sc = 'id="repercussao"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');

		/* */
		$data = array();
		$data['repercussao'] = $this -> recupera_method_3($text, '<h4>Repercussões dos trabalhos do grupo</h4>', '</p>');
		$data['rede_pesquisa'] = $this -> recupera_method_3($text, '<h4>Participação em redes de pesquisa</h4>', '</table>');

		return ($data);
	}

	/* Recursos Humanos */
	function recupera_recursosHumanos($text) {
		$sc = 'id="recursosHumanos"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');

		/* */
		$data = array();
		$data['pesquisadores'] = $this -> recupera_method_4($text, '<span>Pesquisadores', '</table>');
		$data['estudantes'] = $this -> recupera_method_4($text, '<span>Estudantes', '</table>');
		$data['tecnicos'] = $this -> recupera_method_4($text, '<span>Técnicos', '</table>');
		$data['estrangeiros'] = $this -> recupera_method_4($text, '<span>Colaboradores estrangeiros', '</table>');

		/* Egresso */
		$sc = '<h4>Egressos</h4>
';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));

		$data['egresso_pesquisadores'] = $this -> recupera_method_4($text, '<span>Pesquisadores', '</table>');
		$data['egresso_estudantes'] = $this -> recupera_method_4($text, '<span>Estudantes', '</table>');

		return ($data);
	}

	/* Equipamentos e Softwares */
	function recupera_equipamentos_softwares($text) {
		$sc = 'id="equipamentos_softwares"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');

		/* */
		$data = array();
		$data['hardware'] = $this -> recupera_method_4($text, '<span>Equipamentos', '</table>');
		$data['software'] = $this -> recupera_method_4($text, '<span>Softwares', '</table>');

		return ($data);
	}

	/* Parceiras */
	function recupera_instituicoesparceiras($text) {
		$sc = 'id="instituicoesParceiras"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');

		/* */
		$data = array();
		$data['parceiras'] = $this -> recupera_method_4($text, 'Nome da Instituição Parceira', '</table>');

		return ($data);
	}

	/* Linhas de Pesquisa */
	function recupera_linha_pesquisa($text) {
		$sc = 'id="linhaPesquisa"';
		$text = substr($text, strpos($text, $sc) + strlen($sc) + 1, strlen($text));
		$text = substr($text, 0, strpos($text, '</fieldset>') + 1);

		/* */
		$text = troca($text, '<span >ui-button</span>', '');
		$text = troca($text, '<span >', '');
		$text = troca($text, '</span>', '');
		$text = troca($text, chr(13) . chr(10) . chr(13) . chr(10), chr(13) . chr(10));
		$text = troca($text, chr(13) . chr(10) . ' ', '');

		/* */
		$data = array();
		$data['linhas'] = $this -> recupera_method_4($text, '<legend>Linhas de pesquisa', '</table>');

		return ($data);
	}

	function recupera_method_1($text, $tag) {
		$tag = '<label >' . $tag . '</label>';
		$pos = strpos($text, $tag) + strlen($tag);
		$s1 = substr($text, $pos, strlen($text));
		$s1 = trim(substr($s1, 0, strpos($s1, '</div')));
		$s1 = trim(troca($s1, '<div >', ''));
		$s1 = trim(troca($s1, '</label>', ''));
		$s1 = strip_tags($s1);
		$s1 = troca($s1, chr(13) . chr(10), '');
		$s1 = trim($s1);
		return ($s1);
	}

	function recupera_method_2($text, $tag) {
		$tag = '<label >' . $tag . '</label>';
		$pos = strpos($text, $tag) + strlen($tag);
		$s1 = substr($text, $pos, strlen($text));
		$s1 = trim(substr($s1, 0, strpos($s1, '</div')));
		$s1 = trim(troca($s1, '<div >', ''));
		$s1 = troca($s1, chr(13) . chr(10), ';') . ';';
		$sa = splitx(';', $s1);
		return ($sa);
	}

	function recupera_method_3($text, $tag, $tagoff) {
		$pos = strpos($text, $tag) + strlen($tag);
		$s1 = substr($text, $pos, strlen($text));
		$s1 = trim(substr($s1, 0, strpos($s1, $tagoff)));
		$s1 = trim(troca($s1, '<div >', ''));
		$s1 = trim(troca($s1, '</label>', ''));
		$s1 = strip_tags($s1);
		$s1 = troca($s1, chr(13) . chr(10), '');
		$s1 = trim($s1);
		return ($s1);
	}

	/* Linhas de Pesquisa */
	function recupera_method_4($text, $tag, $tagoff) {
		$pos = strpos($text, $tag) + strlen($tag);
		$s1 = substr($text, $pos, strlen($text));
		$s1 = trim(substr($s1, 0, strpos($s1, $tagoff)));
		$s1 = troca($s1, '<tr', '#<TR');
		$s1 = troca($s1, '<td', ';<TD');
		$s1 = strip_tags($s1);
		$s1 = troca($s1, chr(13) . chr(10), '');
		$s1 = trim($s1);
		$s1 = splitx('#', $s1);
		$sr = array();
		for ($r = 1; $r < count($s1); $r++) {
			$s1[$r] = splitx(';', $s1[$r]);
			/* ID do grupo */
			if (isset($s1[$r][3])) {
				$ss = $s1[$r][3];
				$ss = trim(substr($ss, strpos($ss, 'id="') + 4, strlen($ss)));
				$ss = trim(substr($ss, 0, strpos($ss, '"')));
				$s1[$r][3] = $ss;
			} else {
				$s1[$r][3] = '';
			}
			$s1[$r][0] = trim(troca($s1[$r][0], $r . '.', ''));
			array_push($sr, $s1[$r]);
		}
		return ($sr);
	}

	function recupera_method_5($text, $tag, $tagoff) {
		$pos = strpos($text, $tag) + strlen($tag);
		$s1 = substr($text, $pos, strlen($text));
		$s1 = trim(substr($s1, 0, strpos($s1, $tagoff)));
		$s1 = strip_tags($s1);
		$s1 = troca($s1, chr(13) . chr(10), '');
		$s1 = trim($s1);
		return ($s1);
	}

	/*
	 *
	 *
	 */

	function removeTAG($text) {
		$search = array('<button');

		for ($r = 0; $r < count($search); $r++) {
			$sc = $search[$r];
			$pos = strpos($text, $sc);
			while ($pos > 0) {
				$text1 = substr($text, 0, $pos);
				$text2 = substr($text, $pos + strlen($sc), strlen($text));

				$sb = '>';
				$pos2 = strpos($text2, $sb) + strlen($sb);

				$text = $text1 . substr($text2, $pos2, strlen($text2));
				$pos = strpos($text, $sc);
			}
		}
		return ($text);
	}

	function removeSPACE($text) {
		$text = troca($text, '<br />', '');
		$text = troca($text, '</button>', '');
		$text = troca($text, chr(13), ' ');
		$text = troca($text, chr(10), '');
		$text = troca($text, chr(10), '');
		$text = troca($text, '	', '');
		$text = troca($text, 'idFormVisualizarGrupoPesquisa:', '');

		while (strpos($text, '  ')) {
			$text = troca($text, '  ', ' ');
		}
		$text = troca($text, '> <', '><');
		$text = troca($text, '><', '>' . chr(13) . chr(10) . '<');
		return ($text);
	}

	function removeSCRIPT($text) {
		$sc = '<script';
		$pos = strpos($text, $sc);
		while ($pos > 0) {
			$text1 = substr($text, 0, $pos);
			$text2 = substr($text, $pos, strlen($text));

			$sb = '</script>';
			$pos2 = strpos($text2, $sb) + strlen($sb);

			$text2 = substr($text2, $pos2, strlen($text2));
			$text = $text1 . $text2;
			$pos = strpos($text, $sc);
		}
		return ($text);
	}

	function removeCLASS($text) {
		$search = array('class="', 'style="', 'role="', 'onclick="', 'name="', 'aria-live="', 'aria-live="');

		for ($r = 0; $r < count($search); $r++) {
			$sc = $search[$r];
			$pos = strpos($text, $sc);
			while ($pos > 0) {
				$text1 = substr($text, 0, $pos);
				$text2 = substr($text, $pos + strlen($sc), strlen($text));

				$sb = '"';
				$pos2 = strpos($text2, $sb) + strlen($sb);

				$text = $text1 . substr($text2, $pos2, strlen($text2));
				$pos = strpos($text, $sc);
			}
		}
		return ($text);
	}

	function inport_data($link) {
		$data = date("Y-m-d");
		$new = 1;
		/* Verifica se já foi coletado */
		$sql = "select * from dgp_cache where dgpc_link = '$link'";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$new = 0;
			$line = $rlt[0];
			$sta = $line['dgpc_status'];
			return ($line['dgpc_content']);
		}

		$content = '';

		if ($new == 0) {
			$sql = "update dgp_cache 
							set dgpc_status = '@'
							where id_dgpc = " . $line['id_dgpc'];
			$this -> db -> query($sql);
		} else {
			$sql = "insert into dgp_cache 
							(dgpc_link, dgpc_content, dgpc_data, dgpc_status)
							values
							('$link','$content','$data','@')
					";
			$this -> db -> query($sql);
		}

		/* Busca conteudo do link */
		$fl = load_page($link);

		$fl = $fl['content'];
		$fl = troca($fl, "'", "´");

		/* Atualiza o conteudo */
		$sql = "update dgp_cache set 
					dgpc_status = 'A',
					dgpc_content = '$fl',
					dgpc_data = $data
				where dgpc_link = '$link'";
		$this -> db -> query($sql);

		/* Retorna */
		return ($fl);
	}

	function dgp_nome_do_grupo($fl) {
		$sx = 'Nome do grupo: ';
		$pos = round(strpos($fl, $sx));

		if ($pos > 0) {
			$st = substr($fl, $pos + strlen($sx), 400);
			return ($st);
		} else {
			return ("# nome não localizado #");
		}
	}

}
?>