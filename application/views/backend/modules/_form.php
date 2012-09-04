<?php print(form_open());?>
	<fieldset>
		<legend>Dados do Módulo</legend>
		
		<div class="field_row <?php if(form_error('name')){print('validation_error');}?>">
			<div class="field_label">Nome:</div>
			<div><input type="text" name="name" id="name" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->name."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('route')){print('validation_error');}?>">
			<div class="field_label">Controlador Padrão:</div>
			<div><input type="text" name="route" id="route" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->route."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('url')){print('validation_error');}?>">
			<div class="field_label">URL da Rota:</div>
			<div><input type="text" name="url" id="url" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->url."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('status_id')){print('validation_error');}?>">
			<div class="field_label">Status:</div>
			<select name="status_id" id="status_id" class="form_input">
				<option>Selecione...</option>
				<?status_select(@$row[0]->status_id)?>
			</select>
		</div>
	</fieldset>
	
	<br />
	
	<input type="submit" class="button" value="<?=$this->lang->line('button_save');?>" />
	<input type="reset" class="button" value="<?=$this->lang->line('button_clear');?>" />
	<input type="button" class="button" value="<?=$this->lang->line('button_back');?>" onclick="javascript:history.back();" />
<?php print(form_close());?>
