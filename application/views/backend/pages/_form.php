<form method="post" accept-charset="utf-8">
	<fieldset>
		<legend>Dados da Página</legend>
		
		<div class="field_row <?php if(form_error('url')){print('validation_error');}?>">
			<div class="field_label">URL da Rota:</div>
			<div><input type="text" name="url" id="url" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->url."'");}?> /></div>
		</div>
		
		<div class="field_row <?php if(form_error('title')){print('validation_error');}?>">
			<div class="field_label">Título:</div>
			<div><input type="text" name="title" id="title" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->title."'");}?> /></div>
		</div>
		
		
		<div class="field_row <?php if(form_error('description')){print('validation_error');}?>">
			<div class="field_label">Descrição:</div>
			<!--<div><input type="text" name="description" id="description" class="form_input" <?php if($this->router->method == 'update'){print(" value='".@$row[0]->description."'");}?> /></div>-->
			<textarea name="description" id="description" class="form_input"><?php if($this->router->method == 'update'){print(@$row[0]->description);}?></textarea>
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
