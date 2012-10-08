<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller de Páginas do Sistema
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Pages extends CI_Controller{
	
	private $url;
	private $title;
	private $validation;
	
	public final function __construct()
	{
		parent::__construct();	
		
		$this->user_model->is_logged();
		$this->load->model('page_model', 'data_model');
		$this->url = '/admin/paginas/';
		
		$this->title = array(
			'index'		=> $this->lang->line($this->router->class . '_index'),
			'create'	=> $this->lang->line($this->router->class . '_create'),
			'update'	=> $this->lang->line($this->router->class . '_update')
		);
		
		$this->validation = array(
			array(
				'field'	=> 'url', 
				'label'	=> 'URL da Rota', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'title', 
				'label'	=> 'Título', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'description', 
				'label'	=> 'Descrição', 
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
		redirect('/admin');
		
		//$this->log($this->router->method);
		//$rows = $this->data_model->read($start);
		//
		//$data['url_title']	= $this->parameter_model->get('system_title');
		//$data['scr_title']	= $this->title[$this->router->method];
		//$data['rows']		= $rows[0];
		//$data['start']		= $rows[1];
		//
		//$this->pagination->initialize(
		//	pagination(
		//		$this->url,
		//		$this->data_model->total(),
		//		$this->parameter_model->get('rows_per_page')
		//	)
		//);
		//
		//$this->render($this->router->method, $data);
	}
	
	public final function create()
	{
		redirect('/admin');
		
		//$this->log($this->router->method);
		//
		//$data['url_title']	= $this->parameter_model->get('system_title');
		//$data['scr_title']	= $this->title[$this->router->method];
		//
		//$this->form_validation->set_rules($this->validation);
		//
		//if($this->form_validation->run() == FALSE){
		//	$this->render($this->router->method, $data);
		//	$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_error') . '</p>');
		//} else {
		//	if($this->data_model->create($_POST)){
		//		$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_insert_success') . '</p>');
		//		redirect($this->url);
		//	}
		//}
	}
	
	public final function update()
	{
		$this->log($this->router->method);
		
		$data['url_title']	= $this->parameter_model->get('system_title');
		$data['scr_title']	= $this->title[$this->router->method];
		$data['row']		= $this->data_model->by(array('id' => $this->uri->segment(3), 'hash' => $this->uri->segment(4)));
		
		//printr($data);
		
		$this->form_validation->set_rules($this->validation);
		
		if($this->form_validation->run() == FALSE){
			$this->render($this->router->method, $data);
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_error') . '</p>');
		} else {
			if($this->data_model->update($this->uri->segment(3), $this->uri->segment(4))){
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_update_success') . '</p>');
			} else {
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_update_fail') . '</p>');
			}
			
			redirect($this->url.$this->uri->segment(3).'/'.$this->uri->segment(4));
		}
	}
	
	public final function delete($id)
	{
		redirect('/admin');
		
		//if($this->data_model->delete($id)){
		//	$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_delete_success') . '</p>');
		//} else {
		//	$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_delete_fail') . '</p>');
		//}
		//
		//redirect($this->url);
	}
}
