<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller de Parâmetros do Sistema
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Parameters extends CI_Controller{
	
	private $url;
	private $title;
	private $validation;
	
	public final function __construct()
	{
		parent::__construct();
		
		$this->user_model->is_logged();
		$this->load->model('parameter_model', 'data_model');
		$this->url = '/admin/parametros/';
		
		$this->limit = $this->parameter_model->get('rows_per_page');
		$this->pag_segment = 3;
		$this->total_rows	= $this->parameter_model->total();
		
		$this->title = array(
			'index'		=> $this->lang->line('backend/'.$this->router->class . '_index'),
			'create'	=> $this->lang->line('backend/'.$this->router->class . '_create'),
			'update'	=> $this->lang->line('backend/'.$this->router->class . '_update')
		);
		
		$this->validation = array(
			array(
				'field'	=> 'name', 
				'label'	=> 'Nome', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'value', 
				'label'	=> 'Valor', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'status_id', 
				'label'	=> 'Status', 
				'rules'	=> 'required'
			)
		);
	}
	
	private final function log($method)
	{
		if($this->log_model->log($this->router->class, $method)){
			return true;
		}
		
		return false;
	}
	
	private final function render($method, $data)
	{
		$this->log($method);
		
		$data['url']			= $this->url;
		$data['dir']			= 'backend/'.$this->router->class.'/';
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$method];
		$data['total_rows']		= $this->data_model->total();
		
		$this->load->view('backend/common/header', $data);
		$this->load->view('backend/'.$this->router->class . '/' . $method, $data);
		$this->load->view('backend/common/footer', $data);
	}
	
	public final function index($start=0)
	{
		$data['url_title']	= $this->parameter_model->get('system_title');
		$data['scr_title']	= $this->title[$this->router->method];
		
		$data['config']		= pagination_args($this->limit, $this->pag_segment, $this->uri->segment_array());
		$data['dados'] 		=  $this->parameter_model->read_pag($this->limit, @$data['config']['page_now'], @$data['config']['search_args']['search_field']);		
		$data['config']		= pagination_search($this->limit, $this->total_rows, $this->pag_segment, $this->uri->segment_array(),$this->url, $data['config']);
		
		$this->pagination->initialize($data['config']);        
        $data['pag'] 		= $this->pagination->create_links();
		
		$this->render($this->router->method, $data);
	}
	
	public final function create()
	{
		$this->log($this->router->method);
		
		$data['url_title']	= $this->parameter_model->get('system_title');
		$data['scr_title']	= $this->title[$this->router->method];
		
		$this->form_validation->set_rules($this->validation);
		
		if($this->form_validation->run() == FALSE){
			$this->render($this->router->method, $data);
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_error') . '</p>');
		} else {
			if($this->data_model->create($_POST)){
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_insert_success') . '</p>');
				redirect($this->url);
			}
		}
	}
	
	public final function update($id)
	{
		$this->log($this->router->method);
		
		$data['url_title']	= $this->parameter_model->get('system_title');
		$data['scr_title']	= $this->title[$this->router->method];
		$data['row']		= $this->data_model->by('id', $id);
		
		$this->form_validation->set_rules($this->validation);
		
		if($this->form_validation->run() == FALSE){
			$this->render($this->router->method, $data);
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_error') . '</p>');
		} else {
			if($this->data_model->update($id, $_POST)){
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_update_success') . '</p>');
			} else {
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_update_fail') . '</p>');
			}
			
			redirect($this->url);
		}
	}
	
	public final function delete($id)
	{
		if($this->data_model->delete($id)){
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_delete_success') . '</p>');
		} else {
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_delete_fail') . '</p>');
		}
		
		redirect($this->url);
	}
}
