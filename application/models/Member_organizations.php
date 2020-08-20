<?php
class Member_organizations extends CI_Model 
{
	public $table = 'member_organizations';
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

	function list_data()
	{
		$db = $this->db;
		$db->select('id, member_id, organization_name, organization_post');
		$db->where('active','1');
		$db->order_by('organization_name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function list_all()
	{
		$db = $this->db;
		$db->select('*');
		$db->where('active','1');
		$db->order_by('organization_name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	// list for dropdown/select 
	function list_dd()
	{
		$db = $this->db;
		$db->select('id, organization_name');
		$db->where('active','1');
		$db->order_by('organization_name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function check_data($id, $find_opt=array())
	{
		$db = $this->db;
		$db->select('id');

        if( !empty($id) || $id > 0 )
        {
            $db->where($this->primary_key.' != ', $id);
        }

        foreach ( $find_opt as $key => $val )
    	{
    		$db->where($key, $val);
    	}

        $db->limit(1);
        $q = $db->get($this->table)->row();
		return $q;
	}

	function create_data($data)
	{	
		$db = $this->db;
		$db->insert($this->table, $data);
		$q = $db->insert_id();

		return $q;
	}

	function create_data_multiple($data)
	{
		$db = $this->db;
		$q = $db->insert_batch($this->table, $data);
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

	function delete_data_by_column_value($field, $value)
	{
		$db = $this->db;
		$q = $db->where_in($field, $value);
		$q = $db->delete($this->table);

		return $q;
	}
}
?>