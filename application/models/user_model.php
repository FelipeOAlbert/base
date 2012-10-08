<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model de Usuários
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class User_model extends CI_Model{
	
	private $tablename;
	private $per_page;
	
	function __construct()
	{
		parent::__construct();
		
		$this->tablename	= 'sys_user';
		$this->per_page		= $this->parameter_model->get('rows_per_page');
	}
	
	public final function by($by, $value)
	{
		$query = $this->db->get_where(
			$this->tablename,
			array(
				'status_id' => 1,
				$by => $value
			)
		);
		
		if($query->num_rows() > 0){
			return $query->result();
		}
		
		return false;
	}
	
	public final function create($data)
	{
		//Array de dados do usuário
		$data1 = array(
			'hash_id'		=> getHash(),
			'group_id'		=> $_POST["group_id"],
			'name'			=> $_POST["name"],
			'email'			=> $_POST["email"],
			'password'		=> md5($_POST["password"]),
			'status_id'		=> $_POST["status_id"]
		);
		
		//Criação do usuário
		if($this->db->insert($this->tablename, $data1)){
			return true;
		}
		
		return false;
	}
	
	public final function total($start=0)
	{
		$this->db->where(array('status_id' => 1));
		
		return $this->db->count_all_results($this->tablename);
	}
	
	public final function read($start=0)
	{
		$this->db->select('
			sys_user.id,
			sys_user.hash_id,
			sys_user.name,
			sys_user.email,
			sys_group.name as group_name,
			sys_user.created_in,
			sys_user.status_id
		');
		
		$this->db->from($this->tablename);
		$this->db->join('sys_group', 'sys_group.id = sys_user.group_id');
		$this->db->where(array('sys_user.status_id >' => 0));
		$this->db->order_by('sys_user.name');
		$this->db->limit($this->per_page, $start);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return array($query->result(), $query->num_rows());
		}
		
		return false;
	}
	
	public final function read_pag($limit = 0, $page_now = 0, $search = null)
	{
		$result = array(
                'count' => 0,
                'rows' => array()
            );
		 
		$this->db->select('
			sys_user.id,
			sys_user.hash_id,
			sys_user.name,
			sys_user.email,
			sys_group.name as group_name,
			sys_user.created_in,
			sys_user.status_id
		');
		
		$this->db->from($this->tablename);
		$this->db->join('sys_group', 'sys_group.id = sys_user.group_id');
		$this->db->where(array('sys_user.status_id >' => 0));
		$this->db->order_by('sys_user.name');
		if(isset($limit))
		{
			 $this->db->limit($limit, $page_now);
		}
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){			
					$result['rows'] = $query->result();
				    $result['count'] = $query->num_rows();
				   return $result;
		}
		
		return false;
	}
	
	public final function all()
	{
		$query = $this->db->get($this->tablename);
		
		if($query->num_rows() > 0){
			return $query->result();
		}
		
		return false;
	}
	
	public final function update($id, $hash_id, $data)
	{
		//Array de dados do usuário
		$data1 = array(
			'group_id'		=> $data["group_id"],
			'name'			=> $data["name"],
			'email'			=> $data["email"],
			'password'		=> md5($data["password"]),
			'status_id'		=> $data["status_id"]
		);
		
		//Condição para não dar merda
		$this->db->where(array('id' => $id, 'hash_id' => $hash_id));
		
		//Update do usuário
		if($this->db->update($this->tablename, $data1)){
			return true;
		}
		
		return false;
	}
	
	public final function delete($id, $hash_id)
	{
		$this->db->where(array('id' => $id, 'hash_id' => $hash_id));
		
		if($this->db->update($this->tablename, array('status_id' => 0))){
			return true;
		}
		
		return false;
	}
	
	public final function is_logged()
	{
		if($this->session->userdata('user_logged')){
			return true;
		}
		
		redirect('/admin');
	}
	
	public final function login($email, $password)
	{
		
		$this->db->select('*');
		$this->db->from($this->tablename);
		$this->db->where(array(
			'email'			=> $email,
			'password'		=> md5($password),
			'status_id'		=> 1
		));
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$user_data = $query->result();
			
			$this->session->set_userdata('user_logged',	true);
			$this->session->set_userdata('user_id',	$user_data[0]->id);
			$this->session->set_userdata('user_name', $user_data[0]->name);
			$this->session->set_userdata('user_email', $user_data[0]->email);
			
			return true;
		}
		
		return false;
	}
	
	public final function id_or_create($data)
	{
		$query = $this->db->get_where($this->tablename, array('name' => $data['name']));
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->id;
		} else {
			if($this->db->insert($this->tablename, $data)){
				return $this->db->insert_id();
			}
		}
		
		return false;
	}
}
