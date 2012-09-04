<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model de Tipos de Ações
 * @author Felipe <felipe@wadtecnologia.com.br>
 */
class User_group_model extends CI_Model{
	
	private $tablename;
	private $per_page;
	
	public final function __construct()
	{
		parent::__construct();
		
		$this->tablename	= 'sys_group';
		$this->per_page		= $this->parameter_model->get('rows_per_page');
	}
	
	public final function by($by, $value)
	{
		$query = $this->db->get_where($this->tablename, array('status_id >' => 0, $by => $value));
		
		if($query->num_rows() > 0){
			return $query->result();
		}
		
		return false;
	}
	
	public final function create($data)
	{
		if($this->db->insert($this->tablename, $data)){
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
		$query = $this->db->get_where($this->tablename, array('status_id' => 1), $this->per_page, $start);
		
		if($query->num_rows() > 0){
			return array($query->result(), $query->num_rows());
		}
		
		return false;
	}
	
	public final function all()
	{
		$query = $this->db->get_where($this->tablename, array('status_id' => 1));
		
		if($query->num_rows() > 0){
			return $query->result();
		}
		
		return false;
	}
	
	public final function update($id, $data)
	{
		$this->db->where('id', $id);
		
		if($this->db->update($this->tablename, $data)){
			return true;
		}
		
		return false;
	}
	
	public final function delete($id)
	{
		$this->db->where('id', $id);
		
		if($this->db->update($this->tablename, array('status_id' => 0))){
			return true;
		}
		
		return false;
	}
	
	public final function id_or_create($name)
	{
		$query = $this->db->get_where($this->tablename, array('name' => $name));
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->id;
		} else {
			if($this->db->insert($this->tablename, array('name' => $name))){
				return $this->db->insert_id();
			}
		}
		
		return false;
	}
}
