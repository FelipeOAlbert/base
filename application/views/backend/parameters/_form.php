<form method="post" accept-charset="utf-8">
	<fieldset>
		<legend>Dados do Parâmetro</legend>
		
		<div class="field_row <?php if(form_error('name')){print('validation_error');}?>">
			<div class="field_label">Nome:</div>
			<div><input type="text" name="name" id="name" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->name."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('value')){print('validation_error');}?>">
			<div class="field_label">Valor:</div>
			<div><input type="text" name="value" id="value" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->value."'");}?> /></div>
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
	</fieldset>
	
	<br />
	
	<input type="submit" class="button" value="<?=$this->lang->line('button_save');?>" />
	<input type="reset" class="button" value="<?=$this->lang->line('button_clear');?>" />
	<input type="button" class="button" value="<?=$this->lang->line('button_back');?>" onclick="javascript:history.back();" />
</form>
