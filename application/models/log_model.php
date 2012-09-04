<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model de LOG do Sistema
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class Log_model extends CI_Model{
	
	private $tablename;
	
	/**
	 * Class Constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->tablename = 'sys_log';
	}
	
	/**
	 * System Log Method
	 */
	public final function log($model, $action)
	{
		$data = array(
			'user_id'	=> $this->session->userdata('user_id'),
			'model'		=> $model,
			'action'	=> $action
		);
		
		if($this->db->insert($this->tablename, $data)){
			return true;
		}
		
		return false;
	}
}
