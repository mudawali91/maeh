<?php
class Attachments extends CI_Model 
{
	public $table = 'attachment';
	public $primary_key = 'attachment_id';
	
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
	
	function field_check_by_column($field_column,$field_value)
	{
		$db = $this->db;
		$db->select('attachment_id, attachment_type_id, attachment_type, file_name, application_id');
		$db->where($field_column, $field_value);
		$db->limit(1);
		$q = $db->get($this->table)->row();
		// echo $this->db->last_query();
		return $q;
	}
	
	function listing_all($attachment_type_id='')
	{
		$db = $this->db;
		$db->select('*');
		if ( !empty($attachment_type_id) ) 
		{	
			$db->where('attachment_type_id',$attachment_type_id);
		}
		$db->where('active','1');
		$db->order_by('file_name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function listing($attachment_type_id='')
	{
		$db = $this->db;
		$db->select('attachment_id, attachment_type_id, attachment_type, file_name, application_id');
		if ( !empty($attachment_type_id) ) 
		{	
			$db->where('attachment_type_id',$attachment_type_id);
		}
		$db->where('active','1');
		$db->order_by('file_name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}
	
	public function insert_new($data)
	{	
		$this->db->insert($this->table, $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}
	
	public function insert_new_multiple($data)
	{
		$this->db->insert_batch($this->table, $data);
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