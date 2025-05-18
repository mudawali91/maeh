<?php
class Memberships extends CI_Model 
{
	public $table = 'memberships';
	public $primary_key = 'id';

	public $membership_type = [
		1 => 'Normal',
		2 => 'Student',
		3 => 'Corporate',
		4 => 'Kehormat',
		5 => 'Bersekutu',
		6 => 'Lifetime'
	];

	public $membership_fee = [
		'registration' => [
			1 => 60.00, // Normal & others
			2 => 10.00, // Student
		],
		'renewal_yearly' => [
			1 => 5.00, // Normal & others
			2 => 5.00, // Student
		],
		'total_registration' => [
			1 => 65.00, // Normal & others
			2 => 15.00, // Student
		],
	];

	public $status_list = array( 1 => 'Active', 'Inactive' );
	public $status_color = array( 1 => 'success', 'danger' );
	
	public function __construct()
	{
		$this->membership_type = [
			1 => 'Normal',
			2 => 'Student',
			3 => 'Corporate',
			4 => 'Kehormat',
			5 => 'Bersekutu',
			6 => 'Lifetime'
		];

		$this->membership_fee = [
			'registration' => [
				1 => 60.00, // Normal & others
				2 => 10.00, // Student
			],
			'renewal_yearly' => [
				1 => 5.00, // Normal & others
				2 => 5.00, // Student
			],
			'total_registration' => [
				1 => 65.00, // Normal & others
				2 => 15.00, // Student
			],
		];

		$this->status_list = array( 1 => 'Active', 'Inactive' );
		$this->status_color = array( 1 => 'success', 'danger' );
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