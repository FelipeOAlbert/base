<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller de Módulos do Sistema
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Modules extends CI_Controller{
	
	private $url;
	private $title;
	private $validation;
	
	public final function __construct()
	{
		parent::__construct();
		
		$this->user_model->is_logged();
		$this->load->model('module_model', 'data_model');
		$this->url = '/modulos/';
		
		$this->title = array(
			'index'		=> $this->lang->line($this->router->class . '_index'),
			'create'	=> $this->lang->line($this->router->class . '_create'),
			'update'	=> $this->lang->line($this->router->class . '_update')
		);
		
		$this->validation = array(
			array(
				'field'	=> 'name', 
				'label'	=> 'Nome', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'route', 
				'label'	=> 'Controlador Padrão', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'url', 
				'label'	=> 'URL da Rota', 
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
		$data['dir']			= $this->router->class.'/';
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$method];
		$data['total_rows']		= $this->data_model->total();
		
		$this->load->view('common/header', $data);
		$this->load->view($this->router->class . '/' . $method, $data);
		$this->load->view('common/footer', $data);
	}
	
	public final function index($start=0)
	{
		$this->log($this->router->method);
		$rows = $this->data_model->read($start);
		
		$data['url_title']	= $this->parameter_model->get('system_title');
		$data['scr_title']	= $this->title[$this->router->method];
		$data['rows']		= $rows[0];
		$data['start']		= $rows[1];
		
		$this->pagination->initialize(
			pagination(
				$this->url,
				$this->data_model->total(),
				$this->parameter_model->get('rows_per_page')
			)
		);
		
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
