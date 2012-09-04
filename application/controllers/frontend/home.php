<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller de Front End Home
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Home extends CI_Controller{
	
	private $url;
	private $title;
	private $validation;
	
	public final function __construct()
	{
		parent::__construct();
		
		$this->url = "/";
		$this->title = 'index';
	}
	
	private final function log($method)
	{
		if($this->log_model->log($this->router->class, $method)){
			return true;
		}
		
		return false;
	}
	
	private final function render($method, $data=array())
	{
		
		//die('felipe');
		
		$this->log($method);
		
		$data['url']			= $this->url;
		$data['dir']			= $this->router->class.'/';
		$data['url_title']		= $this->parameter_model->get('system_title');
		$data['scr_title']		= $this->title[$method];
		
		$this->load->view('common/header_adm', $data);
		$this->load->view($this->router->class . '/' . $method, $data);
		$this->load->view('common/footer_adm', $data);
	}
	
	public final function index($start=0)
	{
		//$this->user_model->is_logged();
		//$rows = $this->user_model->read($start);
		//$data['rows']		= $rows[0];
		//$data['start']		= $rows[1];
		
		//$this->pagination->initialize(
		//	pagination(
		//		$this->url,
		//		$this->user_model->total(),
		//		$this->parameter_model->get('rows_per_page')
		//	)
		//);
		
		$this->render($this->router->method, $data);
	}
}
