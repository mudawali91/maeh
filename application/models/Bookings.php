<?php
class Bookings extends CI_Model 
{
	public $table = 'booking';
	public $primary_key = 'booking_id';
	
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
	
	function field_array_join_customer($id)
	{
		$db = $this->db;
		$db->select('a.*, IF( a.game_date = "0000-00-00", "", DATE_FORMAT(a.game_date, "%d/%m/%Y") ) as match_date, DATE_FORMAT(a.created, "%d/%m/%Y") as booking_date, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, tc.ticket_category_code');
		$db->from($this->table.' a');
		$db->where('a.booking_id',$id);
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('ticket_category tc', 'tc.ticket_category_id = a.ticket_category_id', 'left');
		$db->limit(1);
		$q = $db->get()->row();
		// echo $this->db->last_query();
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
		$db->select('booking_id');
		$db->where('active','1');
		$db->order_by($this->primary_key,'ASC');
		$q = $db->get($this->table)->result();
		return $q;
	}
	
	function listing_join_customer()
	{
		$db = $this->db;
		$db->select('a.*, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, c.status_id, c.status, c.status_bootstrap_class, c.status_color_code');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		$db->order_by('a.created','DESC');
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('status c', 'c.status_id = a.status_id', 'left');
		$q = $db->get()->result();
		// echo $this->db->last_query();
		return $q;
	}
	
	function listing_join_customer_filter($ftr_date_start='', $ftr_date_end='', $ftr_date_start_match='', $ftr_date_end_match='', $ftr_status='', $ftr_booking_no='', $ftr_major='', $ftr_tc='')
	{
		$db = $this->db;
		$db->select('a.*, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, c.status_id, c.status, c.status_bootstrap_class, c.status_color_code');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		
		if ( !empty($ftr_date_start) ) {
			$ftr_date_start = str_replace('/', '-', $ftr_date_start);
			$ftr_date_start = date( "Y-m-d", strtotime($ftr_date_start) );
			
			$db->where('DATE(a.created) >= ',$ftr_date_start);
		}
		
		if ( !empty($ftr_date_end) ) {
			$ftr_date_end = str_replace('/', '-', $ftr_date_end);
			$ftr_date_end = date( "Y-m-d", strtotime($ftr_date_end) );
			
			$db->where('DATE(a.created) <= ',$ftr_date_end);
		}
		
		if ( !empty($ftr_date_start_match) ) {
			$ftr_date_start_match = str_replace('/', '-', $ftr_date_start_match);
			$ftr_date_start_match = date( "Y-m-d", strtotime($ftr_date_start_match) );
			
			$db->where('a.game_date >= ',$ftr_date_start_match);
		}
		
		if ( !empty($ftr_date_end_match) ) {
			$ftr_date_end_match = str_replace('/', '-', $ftr_date_end_match);
			$ftr_date_end_match = date( "Y-m-d", strtotime($ftr_date_end_match) );
			
			$db->where('a.game_date <= ',$ftr_date_end_match);
		}

		if ( $ftr_status > 0 ) {
			$db->where('a.status_id',$ftr_status);
		}

		if ( !empty($ftr_booking_no) ) {
			$db->where("a.`booking_no` LIKE '".$ftr_booking_no."'", NULL, FALSE);
		}
		
		if ( !empty($ftr_major) ) {
			$db->where("(b.`customer_fullname` LIKE '%".$ftr_major."%' OR b.`customer_email` LIKE '%".$ftr_major."%')", NULL, FALSE);
		}
		
		if ( !empty($ftr_tc) ) {
			$db->where('a.ticket_category_id', $ftr_tc);
		}
		
		$db->order_by('a.created','DESC');
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('status c', 'c.status_id = a.status_id', 'left');
		$q = $db->get()->result();
		// echo "<br /><br /><br /><br />------------".$this->db->last_query();
		return $q;
	}
	
	function listing_join_customer_filter_voucher($company_id, $tc_id=array(3), $ftr_date_start='', $ftr_date_end='', $ftr_booking_no='', $ftr_major='')
	{
		$db = $this->db;
		$db->select('a.*, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		$db->where_in('a.ticket_category_id', $tc_id);
		$db->where('b.company_id',$company_id);
		
		if ( !empty($ftr_date_start) ) {
			$ftr_date_start = str_replace('/', '-', $ftr_date_start);
			$ftr_date_start = date( "Y-m-d", strtotime($ftr_date_start) );
			
			$db->where('DATE(a.created) >= ',$ftr_date_start);
		}
		
		if ( !empty($ftr_date_end) ) {
			$ftr_date_end = str_replace('/', '-', $ftr_date_end);
			$ftr_date_end = date( "Y-m-d", strtotime($ftr_date_end) );
			
			$db->where('DATE(a.created) <= ',$ftr_date_end);
		}

		if ( !empty($ftr_booking_no) ) {
			$db->where("a.`booking_no` LIKE '".$ftr_booking_no."'", NULL, FALSE);
		}
		
		if ( !empty($ftr_major) ) {
			$db->where("(b.`customer_fullname` LIKE '%".$ftr_major."%' OR b.`customer_email` LIKE '%".$ftr_major."%')", NULL, FALSE);
		}
		
		$db->order_by('a.created','DESC');
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$q = $db->get()->result();
		// echo "<br /><br /><br /><br />------------".$this->db->last_query();
		return $q;
	}
	
	function listing_join_customer_filter_voucher_report($company_id, $tc_id=array(3), $ftr_date_start='', $ftr_date_end='', $ftr_redeemdate_start='', $ftr_redeemdate_end='', $ftr_booking_no='', $ftr_major='')
	{
		$db = $this->db;
		$db->select('a.*, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, c.company_name, IF ( SUM(tr.qty_redeem) IS NULL, 0, SUM(tr.qty_redeem) ) AS total_redeem');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		$db->where_in('a.ticket_category_id', $tc_id);
		if ( !empty($company_id) )
		{
			$db->where('b.company_id',$company_id);
		}
		else
		{
			$db->where('b.company_id > ',0);
		}
		
		if ( !empty($ftr_date_start) ) {
			$ftr_date_start = str_replace('/', '-', $ftr_date_start);
			$ftr_date_start = date( "Y-m-d", strtotime($ftr_date_start) );
			
			$db->where('DATE(a.created) >= ',$ftr_date_start);
		}
		
		if ( !empty($ftr_date_end) ) {
			$ftr_date_end = str_replace('/', '-', $ftr_date_end);
			$ftr_date_end = date( "Y-m-d", strtotime($ftr_date_end) );
			
			$db->where('DATE(a.created) <= ',$ftr_date_end);
		}

		if ( !empty($ftr_booking_no) ) {
			$db->where("a.`booking_no` LIKE '".$ftr_booking_no."'", NULL, FALSE);
		}
		
		if ( !empty($ftr_major) ) {
			$db->where("(b.`customer_fullname` LIKE '%".$ftr_major."%' OR b.`customer_email` LIKE '%".$ftr_major."%')", NULL, FALSE);
		}

		$ftr_redeemdate = '';

		if ( !empty($ftr_redeemdate_start) ) {
			$ftr_redeemdate_start = str_replace('/', '-', $ftr_redeemdate_start);
			$ftr_redeemdate_start = date( "Y-m-d", strtotime($ftr_redeemdate_start) );
			
			$ftr_redeemdate .= " AND DATE(tr.updated) >= '".$ftr_redeemdate_start."'";
		}
		
		if ( !empty($ftr_redeemdate_end) ) {
			$ftr_redeemdate_end = str_replace('/', '-', $ftr_redeemdate_end);
			$ftr_redeemdate_end = date( "Y-m-d", strtotime($ftr_redeemdate_end) );
			
			$ftr_redeemdate .= " AND DATE(tr.updated) <= '".$ftr_redeemdate_end."'";
		}
		
		$db->order_by('a.created','DESC');
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('company c', 'c.company_id = b.company_id', 'left');
		$db->join('ticket_redemption tr', '(tr.booking_id = a.booking_id '.$ftr_redeemdate.')', 'left');
		$db->group_by('a.booking_id'); 
		$q = $db->get()->result();
		// echo "<br /><br /><br /><br />------------".$this->db->last_query();
		return $q;
	}

	function listing_join_customer_filter_voucher_report_redeem_log($company_id, $tc_id=array(3), $ftr_date_start='', $ftr_date_end='', $ftr_redeemdate_start='', $ftr_redeemdate_end='', $ftr_booking_no='', $ftr_major='')
	{
		$db = $this->db;
		$db->select('a.booking_id, a.booking_no, a.created, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, c.company_name, IF ( tr.qty_redeem IS NULL, 0, tr.qty_redeem ) AS total_redeem, tr.updated AS redeem_date');
		$db->from('ticket_redemption tr');
		$db->where('a.active','1');
		$db->where_in('a.ticket_category_id', $tc_id);
		if ( !empty($company_id) )
		{
			$db->where('b.company_id',$company_id);
		}
		else
		{
			$db->where('b.company_id > ',0);
		}
		
		if ( !empty($ftr_date_start) ) {
			$ftr_date_start = str_replace('/', '-', $ftr_date_start);
			$ftr_date_start = date( "Y-m-d", strtotime($ftr_date_start) );
			
			$db->where('DATE(a.created) >= ',$ftr_date_start);
		}
		
		if ( !empty($ftr_date_end) ) {
			$ftr_date_end = str_replace('/', '-', $ftr_date_end);
			$ftr_date_end = date( "Y-m-d", strtotime($ftr_date_end) );
			
			$db->where('DATE(a.created) <= ',$ftr_date_end);
		}

		if ( !empty($ftr_redeemdate_start) ) {
			$ftr_redeemdate_start = str_replace('/', '-', $ftr_redeemdate_start);
			$ftr_redeemdate_start = date( "Y-m-d", strtotime($ftr_redeemdate_start) );

			$db->where('DATE(tr.updated) >= ',$ftr_redeemdate_start);
		}
		
		if ( !empty($ftr_redeemdate_end) ) {
			$ftr_redeemdate_end = str_replace('/', '-', $ftr_redeemdate_end);
			$ftr_redeemdate_end = date( "Y-m-d", strtotime($ftr_redeemdate_end) );

			$db->where('DATE(tr.updated) <= ',$ftr_redeemdate_end);
		}

		if ( !empty($ftr_booking_no) ) {
			$db->where("a.`booking_no` LIKE '".$ftr_booking_no."'", NULL, FALSE);
		}
		
		if ( !empty($ftr_major) ) {
			$db->where("(b.`customer_fullname` LIKE '%".$ftr_major."%' OR b.`customer_email` LIKE '%".$ftr_major."%')", NULL, FALSE);
		}
		
		$db->order_by('a.created','DESC');
		
		$db->join($this->table.' a', 'a.booking_id = tr.booking_id', 'left');
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('company c', 'c.company_id = b.company_id', 'left');
		$q = $db->get()->result();
		// echo "<br /><br /><br /><br />------------".$this->db->last_query();
		return $q;
	}

	//#count total quantity redeem from table ticket
	function listing_join_customer_filter2($ftr_date_start='', $ftr_date_end='', $ftr_date_start_match='', $ftr_date_end_match='', $ftr_status='', $ftr_booking_no='', $ftr_major='', $ftr_tc='')
	{
		$db = $this->db;
		$db->select('a.*, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, c.status_id, c.status, c.status_bootstrap_class, c.status_color_code, 
		(SELECT COUNT(tra.ticket_id) FROM ticket tra WHERE tra.booking_id = a.booking_id AND tra.customer_category_id = 1 AND tra.availability = 3 AND tra.active = 1 LIMIT 1) as qty_adult_redeem,
		(SELECT COUNT(trc.ticket_id) FROM ticket trc WHERE trc.booking_id = a.booking_id AND trc.customer_category_id = 2 AND trc.availability = 3 AND trc.active = 1 LIMIT 1) as qty_child_redeem');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		
		if ( !empty($ftr_date_start) ) {
			$ftr_date_start = str_replace('/', '-', $ftr_date_start);
			$ftr_date_start = date( "Y-m-d", strtotime($ftr_date_start) );
			
			$db->where('DATE(a.created) >= ',$ftr_date_start);
		}
		
		if ( !empty($ftr_date_end) ) {
			$ftr_date_end = str_replace('/', '-', $ftr_date_end);
			$ftr_date_end = date( "Y-m-d", strtotime($ftr_date_end) );
			
			$db->where('DATE(a.created) <= ',$ftr_date_end);
		}
		
		if ( !empty($ftr_date_start_match) ) {
			$ftr_date_start_match = str_replace('/', '-', $ftr_date_start_match);
			$ftr_date_start_match = date( "Y-m-d", strtotime($ftr_date_start_match) );
			
			$db->where('a.game_date >= ',$ftr_date_start_match);
		}
		
		if ( !empty($ftr_date_end_match) ) {
			$ftr_date_end_match = str_replace('/', '-', $ftr_date_end_match);
			$ftr_date_end_match = date( "Y-m-d", strtotime($ftr_date_end_match) );
			
			$db->where('a.game_date <= ',$ftr_date_end_match);
		}

		if ( $ftr_status > 0 ) {
			$db->where('a.status_id',$ftr_status);
		}

		if ( !empty($ftr_booking_no) ) {
			$db->where("a.`booking_no` LIKE '".$ftr_booking_no."'", NULL, FALSE);
		}
		
		if ( !empty($ftr_major) ) {
			$db->where("(b.`customer_fullname` LIKE '%".$ftr_major."%' OR b.`customer_email` LIKE '%".$ftr_major."%')", NULL, FALSE);
		}
		
		if ( !empty($ftr_tc) ) {
			$db->where('a.ticket_category_id', $ftr_tc);
		}
		
		$db->order_by('a.created','DESC');
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('status c', 'c.status_id = a.status_id', 'left');
		$q = $db->get()->result();
		// echo "<br /><br /><br /><br />------------".$this->db->last_query();
		return $q;
	}
	
	function count_availability_by_game_date($category_id, $game_date, $status_id=2)
	{
		$db = $this->db;
		$db->select('IF ( SUM(qty_adult + qty_child) IS NULL, 0, SUM(qty_adult + qty_child) ) as total_redeem');
		$db->where('category_id', $category_id);
		$db->where('game_date', $game_date);
		$db->where('status_id', $status_id); // for status = 2:paid
		$db->where('active','1');
		$db->limit(1);
		$q = $db->get($this->table)->row();
		// echo $this->db->last_query();
		return $q;
	}
	
	function count_ticket_by_company($company_id, $status_id='')
	{
		$db = $this->db;
		$db->select('IF( c.total_ticket_sponsored IS NULL, 0, c.total_ticket_sponsored) as total_ticket, IF( SUM(a.qty_adult) IS NULL, 0, SUM(a.qty_adult) ) AS total_issued, IF( SUM(a.qty_adult_redeem) IS NULL, 0, SUM(a.qty_adult_redeem) ) AS total_redeem, IF( SUM(a.qty_adult_available) IS NULL, 0, SUM(a.qty_adult_available) ) AS total_available');
		$db->from('company c');
		$db->where('c.company_id', $company_id);
		$db->where('a.active','1');
		if( !empty($status_id) )
		{
			$db->where('a.status_id', $status_id);
		}
		
		$db->join('customer b', 'b.company_id = c.company_id', 'left');
		$db->join($this->table.' a', 'a.customer_id = b.customer_id', 'left');
		$db->limit(1);
		$q = $db->get()->row();
		// echo $this->db->last_query();
		return $q;
	}
	
	function listing_ticket_by_company($ftr_company_name='', $status_id='')
	{
		$db = $this->db;
		$db->select('c.company_id, c.company_name, IF( c.total_ticket_sponsored IS NULL, 0, c.total_ticket_sponsored) as total_ticket, IF( SUM(a.qty_adult) IS NULL, 0, SUM(a.qty_adult) ) AS total_issued, IF( SUM(a.qty_adult_redeem) IS NULL, 0, SUM(a.qty_adult_redeem) ) AS total_redeem, IF( SUM(a.qty_adult_available) IS NULL, 0, SUM(a.qty_adult_available) ) AS total_available');
		$db->from('company c');
		if ( !empty($ftr_company_name) ) {
			$db->where("`company_name` LIKE '%".$ftr_company_name."%'", NULL, FALSE);
		}
		if( !empty($status_id) )
		{
			$db->where('a.status_id', $status_id);
		}
		$db->where('c.active', '1');
		$db->join('customer b', 'b.company_id = c.company_id', 'left');
		$db->join($this->table.' a', 'a.customer_id = b.customer_id AND a.active = 1', 'left');
		$db->group_by('c.company_id'); 
		$db->order_by('c.company_name','ASC');
		$q = $db->get()->result();
		// echo $this->db->last_query();
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
	
	// ====================================== API Part ===================================
	
	function API_listing_join_customer_filter($ftr_date_start='', $ftr_date_end='', $ftr_date_start_match='', $ftr_date_end_match='', $ftr_status='', $ftr_booking_no='', $ftr_major='', $ftr_tc='')
	{
		$db = $this->db;
		$db->select('a.*, DATE_FORMAT(a.created, "%d/%m/%Y") as booking_date, IF( a.game_date = "0000-00-00", "", DATE_FORMAT(a.game_date, "%d/%m/%Y") ) as match_date, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, c.status_id, c.status, c.status_bootstrap_class, c.status_color_code');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		$db->where_in('a.status_id', array(2,5)); //Status = 2:paid,5:free can proceed redeem
		
		if ( !empty($ftr_date_start) ) {
			$ftr_date_start = str_replace('/', '-', $ftr_date_start);
			$ftr_date_start = date( "Y-m-d", strtotime($ftr_date_start) );
			
			$db->where('DATE(a.created) >= ',$ftr_date_start);
		}
		
		if ( !empty($ftr_date_end) ) {
			$ftr_date_end = str_replace('/', '-', $ftr_date_end);
			$ftr_date_end = date( "Y-m-d", strtotime($ftr_date_end) );
			
			$db->where('DATE(a.created) <= ',$ftr_date_end);
		}
		
		if ( !empty($ftr_date_start_match) ) {
			$ftr_date_start_match = str_replace('/', '-', $ftr_date_start_match);
			$ftr_date_start_match = date( "Y-m-d", strtotime($ftr_date_start_match) );
			
			$db->where('a.game_date >= ',$ftr_date_start_match);
		}
		
		if ( !empty($ftr_date_end_match) ) {
			$ftr_date_end_match = str_replace('/', '-', $ftr_date_end_match);
			$ftr_date_end_match = date( "Y-m-d", strtotime($ftr_date_end_match) );
			
			$db->where('a.game_date <= ',$ftr_date_end_match);
		}

		if ( $ftr_status > 0 ) {
			$db->where('a.status_id',$ftr_status);
		}

		if ( !empty($ftr_booking_no) ) {
			$db->where("a.`booking_no` LIKE '".$ftr_booking_no."'", NULL, FALSE);
		}
		
		if ( !empty($ftr_major) ) {
			$db->where("(b.`customer_fullname` LIKE '%".$ftr_major."%' OR b.`customer_email` LIKE '%".$ftr_major."%')", NULL, FALSE);
		}
		
		if ( !empty($ftr_tc) ) {
			$db->where('a.ticket_category_id', $ftr_tc);
		}
		
		$db->order_by('a.created','DESC');
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('status c', 'c.status_id = a.status_id', 'left');
		$db->limit(10);
		$q = $db->get()->result();
		// echo "<br /><br /><br /><br />------------".$this->db->last_query();
		return $q;
	}
	
	function API_field_array_join_customer($bno)
	{
		$db = $this->db;
		$db->select('a.*, IF( a.game_date = "0000-00-00", "", DATE_FORMAT(a.game_date, "%d/%m/%Y") ) as match_date, DATE_FORMAT(a.created, "%d/%m/%Y") as booking_date, b.customer_fullname, b.customer_nric, b.customer_email, b.customer_mobile_telno, b.company_id, b.customer_agree, tc.ticket_category_code');
		$db->from($this->table.' a');
		$db->where('a.active','1');
		$db->where('a.booking_no',$bno);
		$db->where_in('a.status_id', array(2,5)); //Status = 2:paid,5:free can proceed redeem
		
		$db->join('customer b', 'b.customer_id = a.customer_id', 'left');
		$db->join('ticket_category tc', 'tc.ticket_category_id = a.ticket_category_id', 'left');
		$db->limit(1);
		$q = $db->get()->row();
		// echo $this->db->last_query();
		return $q;
	}
}
?>