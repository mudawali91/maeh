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

	function read_join_2($id)
	{
		$db = $this->db;
		$db->select('a.id as registration_id, a.registration_agreement, a.registration_payment, a.payment_receipt, a.payment_status, a.registration_status, a.created AS registration_date, b.id AS member_id, b.*, s.status AS registration_status_label, s.bootstrap_class AS registration_status_color');
		$db->from($this->table.' a');
		$db->join('members b', 'b.registration_id = a.id AND b.id = a.member_id','INNER');
    	$db->join('status s', 's.id = a.registration_status', 'LEFT');
		$db->where('a.'.$this->primary_key,$id);
		$db->where('a.active',1);
		$db->where('b.active',1);
		$db->limit(1);
		$q = $db->get()->row();
		return $q;
	}

	function read_total()
	{
		$db = $this->db;
		$db->select('COUNT(a.id) AS total_all,
					COUNT(CASE WHEN a.registration_status = 1 THEN a.id ELSE NULL END) AS total_pending, 
					COUNT(CASE WHEN a.registration_status = 2 THEN a.id ELSE NULL END) AS total_approved, 
					COUNT(CASE WHEN a.registration_status = 3 THEN a.id ELSE NULL END) AS total_rejected
					');
		$db->from($this->table.' a');
		$db->join('members b', 'b.registration_id = a.id AND b.id = a.member_id','INNER');
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

	// ======================= DATATABLE SERVER SIDE PROCESSING =========================

    var $column_order = array(null, null, 'b.name', 'b.icno', 'b.contactno_mobile', 'b.home_address', 'registration_date', 'registration_status_label', null); // field display in table column
    var $column_search = array('b.name', 'b.icno', 'b.contactno_mobile', 'b.home_address', 'registration_status_label'); // field to search in datatable  
    var $order = array('UPPER(b.name)' => 'ASC'); // default order 

    private function _get_datatables_query()
    {
    	$filter_major = $this->input->post('filter_major');
    	$filter_status = $this->input->post('filter_status');

    	$db = $this->db;
    	$db->select('a.id as registration_id, a.registration_status, a.created AS registration_date, b.id AS member_id, b.name, b.icno, b.contactno_mobile, b.home_address, b.home_postcode, b.home_city, b.home_state, s.status AS registration_status_label, s.bootstrap_class AS registration_status_color');
    	$db->from($this->table.' a');
    	$db->join('members b', 'b.registration_id = a.id AND b.id = a.member_id', 'INNER');
    	$db->join('status s', 's.id = a.registration_status', 'LEFT');
    	$db->where('a.active',1);
    	$db->where('b.active',1);

    	if ( !empty($filter_major) ) 
		{
			$db->where("(b.name LIKE '%".$filter_major."%' OR b.icno LIKE '%".$filter_major."%')", NULL, FALSE);
		}

		if ( !empty($filter_status) ) 
		{
    		$db->where('a.registration_status', $filter_status);
		}

		$i = 0;
     
        foreach ($this->column_search as $item)
        {
            if ($_POST['search']['value'] )
            {
                 
                if ( $i===0 )
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
    	$db = $this->db;
        $db->from($this->table);
        $db->where($this->table.'.active', '1');
        $c = $db->count_all_results();
        //echo $db->last_query();
        return $c;
    }
}
?>