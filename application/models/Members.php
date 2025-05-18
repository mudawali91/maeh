<?php
class Members extends CI_Model 
{
	public $table = 'members';
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
		$db->select('a.id, a.registration_id, a.name, a.icno, a.membership_type_id, b.membership_no, b.membership_status, b.date_from, b.date_to, c.created AS registration_date');
		$db->from($this->table.' a');
    	$db->join('memberships b', 'b.member_id = a.id AND b.membership_status = 1', 'LEFT');
    	$db->join('registrations c', 'c.member_id = a.id AND c.id = a.registration_id', 'INNER');
		$db->where('a.'.$this->primary_key,$id);
		$db->where('a.active',1);
		$db->where('c.registration_status',2);
		$db->limit(1);
		$q = $db->get()->row();
		return $q;
	}

	function list_data()
	{
		$db = $this->db;
		$db->select('id, name, icno, contactno_mobile, email, dob');
		$db->where('active','1');
		$db->order_by('name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function list_all()
	{
		$db = $this->db;
		$db->select('*');
		$db->where('active','1');
		$db->order_by('name','ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}

	// list for dropdown/select 
	function list_dd()
	{
		$db = $this->db;
		$db->select('id, name');
		$db->where('active','1');
		$db->order_by('name','ASC');
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