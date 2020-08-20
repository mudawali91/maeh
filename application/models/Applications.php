<?php
class Applications extends CI_Model 
{
	public $table = 'application';
	public $primary_key = 'application_id';
	
	public function __construct()
	{
		
	}
	
	function field($id,$field)
	{
		$db = $this->db;
		$db->select($field);
		$db->where($this->primary_key,$id);
		$db->limit(1);
		$q = $db->get($this->table)->row()->$field;
		return $q;
	}

	function field_array($id)
	{
		$db = $this->db;
		$db->select('*');
		$db->where($this->primary_key,$id);
		$db->limit(1);
		$q = $db->get($this->table)->row();
		return $q;
	}

	function field_check_exist_value($id,$field_column,$field_value)
	{
		$db = $this->db;
		$db->select('COUNT('.$field_column.') as total_exist');
		$db->where($field_column, $field_value);
		$db->limit(1);
		$q = $db->get($this->table)->row();
		// echo $this->db->last_query();
		return $q;
	}
	
	function listing_all()
	{
		$db = $this->db;
		$db->select('*');
		$db->where('active','1');
		$db->order_by($this->primary_key,'ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function listing()
	{
		$db = $this->db;
		$db->select($this->primary_key);
		$db->where('active','1');
		$db->order_by($this->primary_key,'ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}
	
	public function insert_new($data)
	{	
		$this->db->insert($this->table, $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}
	
	public function update_selected($id, $data)
	{	
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table, $data);
		$rst = $this->db->affected_rows();
		
		return $rst;
	}
	
	public function update_selected_open($id, $data)
	{	
		$this->db->where($this->primary_key, $id);
		$this->db->where('application_open', 0);
		$this->db->update($this->table, $data);
		$rst = $this->db->affected_rows();
		
		return $rst;
	}
	
	function delete_selected()
	{
		$data = array(
			"updated"=>getDateTime(),
			"active"=>0,
		);

		$q = $this->db->where($this->primary_key, $this->u_id)->update($this->table,$data);

		//reset variable
		$this->reset();

		return $q;
	}
}
?>