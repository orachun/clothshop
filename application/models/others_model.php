<?php

class Others_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_current_store_order()
    {
		$this->db->order_by('close_date', 'asc');
		$this->db->where(array('close_date >' => date('Y-m-d')));
		$this->db->limit(1,0);
		$orders = $this->db->get('store_order')->result_array();
		if(count($orders) == 0)
		{
			$orders = array(array('close_date'=>'2099-12-31'));
		}
		$orders[0]['status'] = 'Open';
		return $orders[0];
    }
    
	private function get_store_order_status($close_date, $current = null)
	{
		$current = $current == null ? $this->get_current_store_order() : $current;
		if($current['close_date'] == $close_date)
		{
			return 'Open';
		}
		if(strtotime($current['close_date']) < strtotime($close_date))
		{
			return 'Future';
		}
		else
		{
			return 'Closed';
		}
	}
	
    public function get_store_order()
    {
        $this->db->from('store_order');
		$this->db->order_by('close_date', 'desc');
		$orders = $this->db->get()->result_array();
		$current = $this->get_current_store_order();
		foreach($orders as $i=>$o)
		{
			$orders[$i]['status'] = $this->get_store_order_status($o['close_date'], $current);
		}
		return $orders;
    }
    public function add_store_order($close_date)
    {
        $this->db->insert('store_order', array('close_date' => $close_date));
    }
    public function del_store_order($id)
    {
        $this->db->delete('store_order', array('store_order_id' => $id)); 
    }
    
    
    public function color($color_en = NULL)
    {
        static $colors = NULL;
        if(empty($colors))
        {
            $results = $this->db->get('color')->result_array();
            $colors = array();
            foreach($results as $r)
            {
                $colors[$r['color_en']] = $r['color_th'];
            }
        }
        if(empty($color_en))
        {
            return $colors;
        }
        return $colors[$color_en];
    }
    
}