<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model de Envio de email do form de contato
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Contact_model extends CI_Model{
	
	public final function __construct()
	{
		parent::__construct();
	}
	
	public final function enviaEmail()
	{
		$data = array();
		
		$data['nome'] 		= $this->input->post('contactName', TRUE);
		$data['email']		= $this->input->post('email', TRUE);
		$data['mensagem'] 	= $this->input->post('comments', TRUE);
		
		if($data['nome'] != '' and $data['email'] != '' and $data['mensagem'] != ''){
			
			$this->email->set_mailtype('html');
			$this->email->from($data['email'], $data['nome']);
			$this->email->to($this->parameter_model->get('CONTACT_EMAIL'));
			$this->email->subject($this->parameter_model->get('SUBJECT_EMAIL'));		
			$msg = '<html><head></head><body>
				Nome:       ' . $data['nome'] . ' <br />
				E-mail:     ' . $data['email'] . ' <br />
				Mensagem:   ' . $data['mensagem'] . ' <br />
				</body></html>';
			$this->email->message($msg);
			
			if($this->email->send()){
				return true;
			}else{
				return false;
			}
			
		}
		
		return false;
	}
	
}