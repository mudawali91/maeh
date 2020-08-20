<?php
class Registrations extends CI_Model 
{
	public $table = 'registrations';
	public $primary_key = 'id';
	
	public function __construct()
	{
	}
	
	function read_data($id,$field)
	{
		$db = $this->db;
		$db->select($field);
		$db->where($this->primary_key,$id);
		$db->limit(1);
		$q = $db->get($this->table)->row()->$field;
		return $q;
	}

	function read_all($id)
	{
		$db = $this->db;
		$db->select('*');
		$db->where($this->primary_key,$id);
		$db->limit(1);
		$q = $db->get($this->table)->row();
		return $q;
	}

	function read_join($id)
	{
		$db = $this->db;
		$db->select('a.id as registration_id, a.registration_status, b.id AS member_id');
		$db->from($this->table.' a');
		$db->join('members b', 'b.registration_id = a.id AND b.id = a.member_id','INNER');
		$db->where('a.'.$this->primary_key,$id);
		$db->where('a.active',1);
		$db->where('b.active',1);
		$db->limit(1);
		$q = $db->get()->row();
		return $q;
	}

	function list_data()
	{
		$db = $this->db;
		$db->select('id, member_id, registration_status');
		$db->where('active','1');
		$db->order_by('registration_status','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function list_all()
	{
		$db = $this->db;
		$db->select('*');
		$db->where('active','1');
		$db->order_by('registration_status','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	// list for dropdown/select 
	function list_dd()
	{
		$db = $this->db;
		$db->select('id, member_id, registration_status');
		$db->where('active','1');
		$db->order_by('registration_status','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function create_data($data)
	{	
		$db = $this->db;
		$db->insert($this->table, $data);
		$q = $db->insert_id();

		return $q;
	}
	
	function update_data($id, $data)
	{	
		$db = $this->db;
		$db->where($this->primary_key, $id);
		$db->update($this->table, $data);
		$q = $db->affected_rows();
		
		return $q;
	}
	
	function delete_data($id)
	{
		$data = array(
						"updated"	=> getDateTime(),
						"active"	=> 0,
					);

		$q = $this->db;
		$db->where($this->primary_key, $id);
		$db->update($this->table, $data);
		$q = $db->affected_rows();

		return $q;
	}
}
?>