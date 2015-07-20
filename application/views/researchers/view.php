<?php
$link_lattes = '<a href="' . $rs_lattes . '" target="_new">';
?>
<table class="tabela00" width="80%">
	<tr>
		<td class="lt0" align="right"><?php echo msg('rs_name'); ?></td>
		<td class="lt2"><b><?php echo $rs_name; ?></b></td>
	</tr>
	<tr>
		<td class="lt0" align="right"><?php echo msg('rs_inst'); ?></td>
		<td class="lt1"><b><?php echo $rs_inst; ?></b></td>
	</tr>
	
	<tr>
		<td class="lt0" align="right"><?php echo msg('rs_lattes'); ?></td>
		<td class="lt1"><b><?php echo $link_lattes . $rs_lattes . '</a>'; ?></b>
			<br>
			<a href="<?php echo base_url('index.php/phplattes/lattes_coleta/' . $id_rs); ?>">coletar</A>
		</td>
	</tr>	
	
	<tr>
		<td class="lt0" align="right"><?php echo msg('rs_name_find'); ?></td>
		<td class="lt1"><b><?php echo $rs_name_find; ?></b>
		</td>
	</tr>	
	
	<tr valign="top">
		<td class="lt0" align="right"><?php echo msg('rs_works'); ?></td>
		<td>
			<?php echo $works; ?>
		</td>
	</tr>
	
	<tr valign="top">
		<td class="lt0" align="right"><?php echo msg('rs_cited'); ?></td>
		<td>
			<?php echo $cited; ?>
		</td>
	</tr>	
</table>
