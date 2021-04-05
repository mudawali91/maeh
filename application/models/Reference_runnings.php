<?php
class Reference_runnings extends CI_Model 
{
	public $table = 'reference_runnings';
	public $primary_key = 'id';
	
	public function __construct()
	{
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

	function read_data($id)
	{
		$db = $this->db;
		$db->select('*');
		$db->where($this->primary_key,$id);
		$db->limit(1);
		$q = $db->get($this->table)->row();
		return $q;
	}

	function list_data($filters=array())
	{
		$db = $this->db;
		$db->select('*');
		$db->where('active','1');

		if ( count($filters) > 0 )
		{
			foreach ( $filters as $key => $val )
			{
				$db->where($key,$val);
			}
		}

		$q = $db->get($this->table)->result();
		return $q;
	}
	
	function check_data($find_opt=array())
	{
		$db = $this->db;
		$db->select('id, module, year, running_no');
		$db->where('active','1');

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
		$db->where_in($this->primary_key, $id);
		$db->update($this->table, $data);
		$q = $db->affected_rows();

		return $q;
	}

	function get_running_no($module, $year)
	{	
		$module = strtoupper($module);

		// get data based on module and current year
		$filter_data = array(
								'module' 	=> $module,
								'year' 	 	=> $year
							);

		$check_data = $this->check_data($filter_data);

		$selected_id = '';
		$curr_running_no = 0;

		if ( is_object($check_data) && !empty($check_data) )
		{
			$selected_id = $check_data->id;
			$curr_running_no = $check_data->running_no;
		}

		//  if not exist create data based on module and current year
		if ( empty($selected_id) || $selected_id == 0 )
        {
        	$data_create = array(
        						'module' 	=> $module,
								'year' 	 	=> $year,
								'running_no'=> 0,
								'created'	=> getDateTime(),
								'updated'	=> getDateTime(),
								'active'	=> 1,
        						);

            $selected_id = $this->create_data($data_create);
        }

	    $next_running_no = (int)$curr_running_no + 1;
	    $rst_update = 0;

	    // update latest running no
        if ( $selected_id > 0 )
        {
	        $data_update =  array(
									'running_no'=> $next_running_no,
									'updated'=> getDateTime(),
        						);

            $rst_update = $this->update_data($selected_id, $data_update);
        }

        if ( $rst_update > 0 )
        {
        	// prefix 3 digits
        	$next_running_no = str_pad($next_running_no, 3, '0', STR_PAD_LEFT);
        	return $next_running_no;
        }
        else
        {
        	// if fail to generate running no recursive function will repear this function
        	$this->get_current_runnings($module, $year);
        }
	}

	function generate_reference_no($module, $year)
	{
		$reference_no = '';

        if ( $module == 'REGISTRATION' )
        {
	        // year 4 digits
	        $reference_no .= $year;
        	$reference_no .= '1';
        }

        // get current running no
        $running_no = $this->get_running_no($module, $year);

        if ( $module == 'MEMBERSHIP' )
        {
        	$reference_no .= 'MAEH';
        	$reference_no .= str_pad($running_no, 7, '0', STR_PAD_LEFT);
        }
        else
        {
        	$reference_no .= str_pad($running_no, 5, '0', STR_PAD_LEFT);
        }

        return $reference_no;
	}
}
?>