<?php
class phplattes_cv extends CI_Model {
	var $link = '';
	function coleta_lattes($link) {
		if (!(strpos($link, 'visualizacv.do') > 0)) {
			$txt = load_page($link);
			$link_cnpq = $txt['url'];
			$link_cnpq = troca($link_cnpq, 'metodo=apresentar&', '');
		} else {
			$link_cnpq = $link;
		}
		$this -> link = $link_cnpq;

		echo '<h2>' . $link_cnpq . '</h2>';

		/************************************************************/
		$browser = new SimpleBrowser();
		$browser -> useCookies();
		//$browser -> setMaximumRedirects(50);
		$url = base_url('index.php/phplattes/link_cv') . '/1/e7d621c0c40cbbfb12e26873b89312e1';
		$url = troca($url, 'localhost', '127.0.0.1');
		echo '<h2>' . $url . '</h2>';
		$browser -> get($url);
		
		/* Captcha */
		$captcha = 'http://buscatextual.cnpq.br/buscatextual/servlet/captcha?metodo=getImagemCaptcha';
		$browser -> get($captcha);
		//echo '<img src="'.$browser->getContent().'">';
		
		
		$browser -> setFieldByName('metodo', 'visualizarCV');
		//$browser->clickSubmitByName('consultar');
		$browser -> submitFormById('formulario');

		$browser -> get($link_cnpq);
		$browser -> setFieldByName('metodo', 'visualizarCV');
		//$browser->clickSubmitByName('consultar');
		$browser -> submitFormById('formulario');

		echo '===>' . $browser -> getTitle();
//		echo '<BR>==>' . $browser -> getField('consultar');
//		echo '<BR>==>' . $browser -> getResponseCode();
//		echo '<BR>==>' . $browser -> getMimeType();
//		echo '<BR>==>' . $browser -> getAuthentication();
//		echo '<BR>==>' . $browser -> getBaseUrl();
//		echo '<BR>==>' . $browser -> getHeaders();
//		echo '<BR>==>' . $browser -> getTransportError();
//		echo '<BR>==>' . $browser -> getRequest();
//		echo '<BR>==>' . $browser -> getUrl();

		echo '<HR>';
		$page = $browser->getContent();
		print_r($page);
	}

}
?>

<form name="visualizacvForm" id="formulario" method="post" action="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4750592J8&metodo=visualizarCV" enctype="multipart/form-data">
	<input type="submit" name="consultar" value="sucesso-2" id="consultar">
</form>

http://lattes.cnpq.br/5748049583605835