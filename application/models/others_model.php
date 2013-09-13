<?php

class Others_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_current_store_order()
    {
        return $this->db->get_where('store_order', array('status' => 'O'))->row();
    }
    
    public function get_store_order()
    {
        return $this->db->get('store_order')->result();
    }
    public function add_store_order($close_date)
    {
        $this->db->insert('store_order', array('close_date' => $close_date, 'status' => 'F'));
    }
    public function del_store_order($id)
    {
        $this->db->delete('store_order', array('store_order_id' => $id)); 
    }
    public function set_store_order_status($id, $status)
    {
        $this->db->where('store_order_id', $id);
        $this->db->update('store_order', array('status'=> $status)); 
    }
}