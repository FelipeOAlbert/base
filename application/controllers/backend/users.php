<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller de Usuários
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Users extends CI_Controller{
	
	private $url;
	private $title;
	private $validation;
	
	public final function __construct()
	{
		parent::__construct();
		
		$this->url = "/admin/usuarios/";
		
		$this->title = array(
			'index'		=> $this->lang->line($this->router->class . '_index'),
			'create'	=> $this->lang->line($this->router->class . '_create'),
			'update'	=> $this->lang->line($this->router->class . '_update'),
			'login'		=> $this->lang->line($this->router->class . '_login'),
			'profile'	=> $this->lang->line($this->router->class . '_profile')
		);
		
		$this->validation = array(
			array(
				'field'	=> 'group_id', 
				'label'	=> 'group', 
				'rules'	=> 'greater_than[0]'
			),
			array(
				'field'	=> 'name', 
				'label'	=> 'Nome', 
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'email', 
				'label'	=> 'Email', 
				'rules'	=> 'valid_email'
			),
			array(
				'field'	=> 'password', 
				'label'	=> 'Senha', 
				'rules'	=> 'alpha_numeric'
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
	
	private final function render($method, $data = array())
	{
		$this->log($method);
		
		$data['url']			= $this->url;
		$data['dir']			= 'backend/'.$this->router->class.'/';
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$method];
		$data['total_rows']		= $this->user_model->total();
		
		$this->load->view('backend/common/header', $data);
		$this->load->view('backend/'.$this->router->class . '/' . $method, $data);
		$this->load->view('backend/common/footer', $data);
	}
	
	public final function index($start = 0)
	{
		$this->user_model->is_logged();
		$rows = $this->user_model->read($start);
		$data['rows']		= $rows[0];
		$data['start']		= $rows[1];
		
		$this->pagination->initialize(
			pagination(
				$this->url,
				$this->user_model->total(),
				$this->parameter_model->get('rows_per_page')
			)
		);
		
		$this->render($this->router->method, $data);
	}
	
	public final function create()
	{
		$this->user_model->is_logged();
		$this->log($this->router->method);
		
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$this->router->method];
		$data['groups']			= $this->user_group_model->all();
		
		$this->form_validation->set_rules($this->validation);
		
		if($this->form_validation->run() == FALSE){
			$this->render($this->router->method, $data);
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_error') . '</p>');
		} else {
			if($this->user_model->create($_POST)){
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_insert_success') . '</p>');
				redirect($this->url);
			}
		}
	}
	
	public final function update($id, $hash_id)
	{
		$this->user_model->is_logged();
		$this->log($this->router->method);
		
		$data['id']				= $id;
		$data['hash_id']		= $hash_id;
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$this->router->method];
		$data['row']			= $this->user_model->by('id', $id);
		$data['groups']			= $this->user_group_model->all();
		
		$this->form_validation->set_rules($this->validation);
		
		if($this->form_validation->run() == FALSE){
			$this->render($this->router->method, $data);
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_error') . '</p>');
		} else {
			
			if($this->user_model->update($id, $hash_id, $_POST)){
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_update_success') . '</p>');
			} else {
				$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_update_fail') . '</p>');
			}
			
			redirect($this->url);
		}
	}
	
	public final function delete($id, $hash_id)
	{
		if($this->user_model->delete($id, $hash_id)){
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_delete_success') . '</p>');
		} else {
			$this->session->set_flashdata('message', '<p>' . $this->lang->line('crud_delete_fail') . '</p>');
		}
		
		redirect($this->url);
	}
	
	public final function login()
	{
		if(!$_POST){
			$this->log('login');

			$data['url']			= $this->url;
			$data['dir']			= 'backend/'.$this->router->class.'/';
			$data['url_title']		= $this->parameter_model->get('system_title');
			$data['scr_title']		= $this->title['login'];
			
			$this->load->view('/backend/users/login', $data);
		} else {
			if($this->user_model->login($_POST['email'], $_POST['password'])){
				redirect('/admin/usuarios');
			} else {
				redirect('/admin');
			}
		}
	}
	
	public final function logout()
	{
		$this->user_model->is_logged();
		$this->session->unset_userdata('user_logged');
		$this->session->sess_destroy();
		
		redirect('/admin');
	}
	
	public final function profile()
	{
		$this->user_model->is_logged();
		$this->log($this->router->method);
		
		$this->load->model('subsidiary_model');
		
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$this->router->method];
		$data['row']			= $this->user_model->by('id', $this->session->userdata('user_id'));
		$data['groups']			= $this->user_group_model->all();
		
		$this->render($this->router->method, $data);
	}
}
