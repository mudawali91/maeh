<?php
class Users extends CI_Model 
{
	public $table = 'users';
	public $primary_key = 'id';

	public $user_type = array( 1 => 'Superadmin', 'Admin' );

	public $status_list = array( 1 => 'Active', 'Inactive' );
	public $status_color = array( 1 => 'success', 'danger' );

	public function __construct()
	{
		$this->user_type = array( 1 => 'Superadmin', 'Admin' );

		$this->status_list = array( 1 => 'Active', 'Inactive' );
		$this->status_color = array( 1 => 'success', 'danger' );
	}
	
	function read_data_specific($id, $field)
	{
		$db = $this->db;
		$db->select($field);
		$db->where($this->primary_key,$id);
		$db->limit(1);
		$q = $db->get($this->table)->row()->$field;
		return $q;
	}

	function read_data_by_column_value($field, $value)
	{
		$db = $this->db;
		$db->select('*');
		$db->where($field,$value);
		$db->where('active','1');
		$db->limit(1);
		$q = $db->get($this->table)->row();
		return $q;
	}

	// join with login
	function read_data_join($id)
	{
		$db = $this->db;
		$db->select('a.*, b.user_name');
		$db->from($this->table.' a');
    	$db->join('logins b', '(b.user_id = a.id AND b.login_type_id = 1)', 'LEFT');
		$db->where('a.'.$this->primary_key,$id);
		$db->limit(1);
		$q = $db->get()->row();
		return $q;
	}

	function read_data($id)
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
		$db->select('*');
		$db->where('active','1');
		$q = $db->get($this->table)->result();
		return $q;
	}

	function create_data($data)
	{
		$db = $this->db;
		$q = $db->insert($this->table, $data);
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
						"updated"=>getDateTime(),
						"active"=>'0',
					);

		$db = $this->db;
		$q = $db->where_in($this->primary_key, $id);
		$q = $db->update($this->table, $data);

		return $q;
	}

	// ======================= DATATABLE SERVER SIDE PROCESSING =========================

    var $column_order = array(null, null, null, 'a.user_type_id', 'a.full_name', 'a.email', 'a.mobile_no', 'b.last_login', 'a.status'); //field yang ada di table
    var $column_search = array('a.user_type_id', 'a.full_name', 'a.email', 'a.mobile_no', 'b.last_login', 'a.status'); //field yang diizin untuk pencarian 
    var $order = array('UPPER(a.full_name)' => 'ASC'); // default order 

    private function _get_datatables_query()
    {
    	$curr_user_id = $this->session->userdata('curr_user_id');
    	$filter_name = $this->input->post('filter_name');
    	$filter_user_type = $this->input->post('filter_user_type');
    	$filter_status = $this->input->post('filter_status');

    	$get_login =   '(SELECT `user_id`, MAX(`last_login`) AS last_login
						FROM `logins`
						GROUP BY `user_id`)';

    	$db = $this->db;
    	$db->select('a.id, a.user_type_id, a.full_name, a.email, a.mobile_no, a.status, b.last_login');
    	$db->from($this->table.' a');
    	$db->join($get_login.' b', 'b.user_id = a.id', 'INNER');
    	$db->where('a.active', '1');
    	$db->where('a.user_type_id != ', '1'); // not output super admin
    	$db->where('a.id != ', $curr_user_id); // not output current login user

		if ( !empty($filter_name) ) 
		{
    		$db->like('a.full_name', $filter_name, 'both');
		}

		if ( !empty($filter_user_type) ) 
		{
    		$db->where('a.user_type_id', $filter_user_type);
		}

		if ( !empty($filter_status) ) 
		{
    		$db->where('a.status', $filter_status);
		}

		$i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value'] ) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if ( $i===0 ) // looping awal
                {
                    $db->group_start(); 
                    $db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $db->or_like($item, $_POST['search']['value']);
                }
 
                if ( count($this->column_search) - 1 == $i ) 
                    $db->group_end(); 
            }
            $i++;
        }
         
        if ( isset($_POST['order']) ) 
        {
            $db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if ( isset($this->order) )
        {
            $order = $this->order;
            $db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
    	$db = $this->db;
        $this->_get_datatables_query();
        if ( $_POST['length'] != -1 )
        $db->limit($_POST['length'], $_POST['start']);
        $query = $db->get();
        // echo $db->last_query();
        return $query->result();
    }
 
    function count_filtered()
    {
    	$db = $this->db;
        $this->_get_datatables_query();
        $query = $db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
    	$curr_user_id = $this->session->userdata('curr_user_id');
    	$get_login =   '(SELECT `user_id`, MAX(`last_login`) AS last_login
						FROM `logins`
						GROUP BY `user_id`)';

    	$db = $this->db;
        $db->from($this->table.' a');
    	$db->join($get_login.' b', 'b.user_id = a.id', 'INNER');
        $db->where('a.active', '1');
    	$db->where('a.user_type_id != ', '1'); // not output super admin
    	$db->where('a.id != ', $curr_user_id); // not output current login user
        $c = $db->count_all_results();
        // echo $db->last_query();
        return $c;
    }
}
?>