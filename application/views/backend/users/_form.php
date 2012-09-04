<form method="post" accept-charset="utf-8">
	<fieldset>
		<legend>Dados do Usuário</legend>
		
		<div class="field_row <?php if(form_error('group_id')){print('validation_error');}?>">
			<div class="field_label">Grupo / Cargo:</div>
			<div>
			<select name="group_id" id="group_id" class="form_input">
				<option>Selecione...</option>
				<?data_select(@$row[0]->group_id, $groups)?>
			</select>
			</div>
		</div>
		
		<div class="field_row <?php if(form_error('name')){print('validation_error');}?>">
			<div class="field_label">Nome do Usuário:</div>
			<div><input type="text" name="name" id="name" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->name."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('email')){print('validation_error');}?>">
			<div class="field_label">Email / Login:</div>
			<div><input type="text" name="email" id="email" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->email."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('password')){print('validation_error');}?>">
			<div class="field_label">Senha:</div>
			<div><input type="password" name="password" id="password" class="form_input" /></div>
		</div>
		
		<div class="field_row <?php if(form_error('status_id')){print('validation_error');}?>">
			<div class="field_label">Status:</div>
			<div>
			<select name="status_id" id="status_id" class="form_input">
				<option>Selecione...</option>
				<?status_select(@$row[0]->status_id)?>
			</select>
			</div>
		</div>
		<?php if($this->router->method == 'update'){ ?>
		<div>
			<input type="hidden" name="hash_id" value="<?php echo @$row[0]->hash_id;?>" />
		</div>
		<?php } ?>
	</fieldset>
	
	<br />
	
	<input type="submit" class="button" value="<?=$this->lang->line('button_save');?>" />
	<input type="reset" class="button" value="<?=$this->lang->line('button_clear');?>" />
	<input type="button" class="button" value="<?=$this->lang->line('button_back');?>" onclick="javascript:history.back();" />
</form>
