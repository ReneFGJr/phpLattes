<?php
$prj_titulo = 'Titulo do Projeto';
?>
<table width="100%" class="tabela01 lt0" border=1>
	<tr>
		<td colspan=2 class="lt4"><b><?php echo $prj_titulo;?></b></td>
	</tr>
	<tr valign="top">
		<td width="20%">Authors</td>
		<td width="80%">Graphs</td>
	</tr>

	<tr valign="top">
		<td class="lt1">
			<?php
			foreach ($prj_authors as $key => $value) {
				echo '<a href="#" onclick="marca(\''.$value.'\');">';
				echo $key;
				echo '</a>'.cr();
				
				echo '<br>';				
			} 			
			?>
		</td>
		<td>
			<div id="netword" style="min-height: 500px;"></div>
		</td>
	</tr>
</table>