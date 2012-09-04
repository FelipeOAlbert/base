<?php
/**
 * Helper de paginação
 * @author Felipe <felipe@wadtecnologia.com.br>
 */

//Monta o array de configuração de paginação
function pagination($url, $total, $perpage=10)
{
	$config['num_links']		= 5;
	$config['uri_segment']		= 2;
	$config['base_url']			= site_url() . $url;
	$config['total_rows']		= $total;
	$config['per_page']			= $perpage;
	$config['full_tag_open']	= '<div class="pagination">';
	$config['full_tag_close']	= '</div>';
	$config['first_link']		= 'Primeira';
	$config['last_link']		= 'Última';
	$config['first_tag_open']	= '<a>';
	$config['first_tag_close']	= '</a>';
	$config['cur_tag_open']		= '<a><b>';
	$config['cur_tag_close']	= '</a></b>';

	return $config;
}

//Retorna o total de registros
function get_start($start=0, $total=0)
{
	if($start==0){
		return 10;
	} else {
		return ($start+10);
	}
}
