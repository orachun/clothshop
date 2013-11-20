<?php

class Coupon_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
	public function get()
	{
		return $this->db->get('discount_coupon')->result_array();
	}
	
	public function add($name, $desc, $type, $amount, $threshold, $valid_days)
	{
		$this->db->insert('discount_coupon', array(
			'name' => $name,
			'desc' => $desc,
			'discount_type' => $type,
			'amount' => $amount,
			'amount_threshold', $threshold,
			'valid_day' => $valid_days,
			'status' => 'A'
		));
	}
	
	public function setStatus($coupon_id, $status)
	{
		$this->db->where('coupon_id', $coupon_id);
		$this->db->update('discount_coupon', array('status' => $status));
	}
}