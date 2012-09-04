<h1><?=$scr_title?></h1>

<p>Esta é a página do seu perfil no sistema onde você poderá editar suas informações e visualizar seu histórico completo de ações.</p>

<table class="profile">
	<thead>
		<tr>
			<th>Nome</th>
			<td><?=$row[0]->name?></td>
		</tr>
		
		<tr>
			<th>Grupo</th>
			<td><?=$row[0]->name?></td>
		</tr>
		
		<tr>
			<th>Filial</th>
			<td><?=$row[0]->name?></td>
		</tr>
		
		<tr>
			<th>Email</th>
			<td><?=$row[0]->email?></td>
		</tr>
		
		<tr>
			<th>Senha</th>
			<td><?=$row[0]->password?></td>
		</tr>
		
		<tr>
			<th>Nome</th>
			<td><?=$row[0]->name?></td>
		</tr>
		
		<tr>
			<th>Cargo</th>
			<td><?=$row[0]->role?></td>
		</tr>
		
		<tr>
			<th>Visualização</th>
			<td><?=$row[0]->view?></td>
		</tr>
		
		<tr>
			<th>Pode Registrar</th>
			<td><?=yesno($row[0]->can_register)?></td>
		</tr>
		
		<tr>
			<th>Administrador</th>
			<td><?=yesno($row[0]->is_admin)?></td>
		</tr>
		
		<tr>
			<th>Data de Cadastro</th>
			<td><?=format_date($row[0]->created_in)?></td>
		</tr>
		
		<tr>
			<th>Status</th>
			<td><?=status($row[0]->status_id)?></td>
		</tr>
	</thead>
</table>

<?=anchor($url.'editar/'.$this->session->userdata('user_id'), $this->lang->line('button_update'), 'class="button"');?>
