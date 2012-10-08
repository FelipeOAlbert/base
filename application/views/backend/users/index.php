<h1><?=$scr_title?></h1>

<h3>Exibindo <?=$users['count']?> registro(s) de <?=$total_rows?> Encontrado(s)</h3>

<?php if($users['count']){ ?>
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<thead>
			<th nowrap>Nome do Usuário</th>
			<th nowrap>Grupo / Cargo</th>
			<th nowrap>Email / Login de Acesso</th>
			<th nowrap>Data de Criação</th>
			<th nowrap>Status</th>
			<th nowrap class="actions">Ações</th>
		</thead>
	
		<tbody>
			<?php foreach($users['rows'] as $row){?>
				<tr>
					<td nowrap><?=$row->name?></td>
					<td nowrap><?=$row->group_name?></td>
					<td nowrap><?=$row->email?></td>
					<td nowrap><?=format_date($row->created_in)?></td>
					<td nowrap><?=status($row->status_id)?></td>
					<td nowrap>
						<?=anchor($url.'editar/'.$row->id.'/'.$row->hash_id, $this->lang->line('button_update'), 'class="button"');?>
						<?=anchor($url.'remover/'.$row->id.'/'.$row->hash_id, $this->lang->line('button_delete'), 'class="button" rel="delete"');?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php echo $pag; ?>
	<br />
	
<?php } else { ?>
	<div class="message">
		<strong>Nenhum registro encontrado!</strong>
		<p>Desculpe, sua consulta não retornou nenhum resultado! Tente recarregar a página e caso este erro ocorra novamente, entre em contato com o suporte técnico.</p>
	</div>
<?php } ?>

<?=anchor($url.'adicionar/', 'Adicionar Novo', 'class="button"', 'rel="delete"');?>
