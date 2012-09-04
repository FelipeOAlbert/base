<?php
/**
 * Helper de Formatação
 * @author Felipe <felipe@wadtecnologia.com.br>
 */

function format_datetime($date)
{
	if($date){
		return date('d/m/Y H:i:s', strtotime($date));
	}
	
	return 'Não-Encontrado';
}

function format_date($date)
{
	if($date){
		return date('d/m/Y', strtotime($date));
	}
	
	return 'Não-Encontrado';
}

function format_time($date)
{
	if($date){
		return date('H:i:s', strtotime($date));
	}
	
	return 'Não-Encontrado';
}

function yesno($id)
{
	$yesno = array(
		0 => 'Não',
		1 => 'Sim'
	);
	
	return $yesno[$id];
}

function status($id)
{
	$status = array(
		0 => 'Inativo',
		1 => 'Ativo',
		2 => 'Pendente',
		3 => 'Aguardando Aprovação'
	);
	
	return $status[$id];
}

function status_select($selected)
{
	$status = array(
		0 => 'Inativo',
		1 => 'Ativo',
		2 => 'Pendente',
		3 => 'Aguardando Aprovação'
	);
	
	for($i=0; $i<count($status); $i++){
		if($i == $selected){
			print('<option value="'.$i.'" selected="selected">'.$status[$i].'</option>');
		} else {
			if($i == 1){
				print('<option value="'.$i.'" selected="selected">'.$status[$i].'</option>');
			} else {
				print('<option value="'.$i.'">'.$status[$i].'</option>');
			}
		}
	}
	
	return true;
}

function data_select($selected, $rows)
{
	foreach($rows as $row){
		if($row->id == $selected){
			print('<option value="'.$row->id.'" selected="selected">'.$row->name.'</option>');
		} else {
			print('<option value="'.$row->id.'">'.$row->name.'</option>');
		}
	}
	
	return true;
}

/**
* Função para pegar extensão do arquivo
* @access public static
* @param String $tUrl
* @return void
*/
function findExt($arquivo_nome = '') {
	if(!isset($arquivo_nome)) {
		return false;
	} else {
		$arquivo_sep = explode('.', $arquivo_nome);
	   
		if(is_array($arquivo_sep)) {
			$arquivo_ext = strtolower(end($arquivo_sep));
			return $arquivo_ext;
		} else {
			return false;
		}
	}
}

function getHash() {
	return md5(rand(0,1000).date('Y-m-d H:i:s').rand(0,1000));
}

function printr($data = array())
{
	print "<pre>";
	print_r($data);
	print "</pre>";
	die();
}