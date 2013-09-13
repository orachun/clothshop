<?php

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function increase_view($pid)
    {
        $this->db->query('update product set views = views+1 where product_id="'.$pid.'"');
    }
    
    public function get_product($pid)
    {
        $query = $this->db->get_where('product', array('product_id'=>$pid));
        if ($query->num_rows() > 0)
        {
            $data = $query->row_array();
            $data['images'] = list_product_img('images/products/'.$pid.'/'); 
            $data['thumb'] = base_url().'images/products/'.$pid.'/thumb.jpg';
            $this->db->select('color');
            $this->db->where('product_id', $pid); 
            $data['avail_colors'] = to_flat_array($this->db->get('product_color')->result_array(), 'color');

            $this->db->select('size');
            $this->db->where('product_id', $pid); 
            $data['avail_sizes'] = to_flat_array($this->db->get('product_size')->result_array(), 'size');
            return $data;
        }
        else
        {
            return NULL;
        }
    }
    
    public function list_product($cat = '-1',$sort = 'added_date', $sort_order = 'desc', $keyword = 'none', $page = 1)
    {
        $start = ($page-1)*___config('items_per_page');
        $sql = 'select * 
            from _product_info where 1 ';
        if($cat > 0)
        {
            $sql .= 'and cat_id ="'.$cat.'" ';
        }
        if($keyword != 'none')
        {
            $keyword = rawurldecode($keyword);
            $sql .= 'and (product_id like \'%'.$keyword.'%\' ';
            $sql .= 'or display_id like \'%'.$keyword.'%\' ';
            $sql .= 'or name like \'%'.$keyword.'%\' ';
            $sql .= 'or `desc` like \'%'.$keyword.'%\' ';
            $sql .= 'or category like \'%'.$keyword.'%\' )';
        }
        $sql .= 'order by '.$sort.' '.$sort_order.'
            limit '.$start.','.___config('items_per_page');
        $query = $this->db->query($sql);
        $products = $query->result_array();
        foreach($products as $i=>$p)
        {
            $products[$i]['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
        }
//        $data = array();
//		for($i=1;$i<=10;$i++)
//		{
//			$data[] = array(
//				'pid' => 1,
//				'name' => 'แม๊กซี่เดรส ผ้าชีฟองพิมพ์ลาย',
//				'img' => base_url().'images/products/'.'1'.'/thumb.jpg',
//				'price' => '480.-'
//			);
//            
//		}
        return $products;
    }
    public function total_product($cat = '-1', $keyword = 'none')
    {
        $sql = 'select count(*) as count from _product_info where 1 ';
        if($cat > 0)
        {
            $sql .= 'and cat_id ="'.$cat.'" ';
        }
        if($keyword != 'none')
        {
            $keyword = rawurldecode($keyword);
            $sql .= 'and (product_id like \'%'.$keyword.'%\' ';
            $sql .= 'or display_id like \'%'.$keyword.'%\' ';
            $sql .= 'or name like \'%'.$keyword.'%\' ';
            $sql .= 'or `desc` like \'%'.$keyword.'%\' ';
            $sql .= 'or category like \'%'.$keyword.'%\' )';
        }
        $query = $this->db->query($sql);
        return $query->row()->count;
    }
    
    public function get_cat()
    {
        return $this->db->get('category')->result();
    }
    
    public function add_cat($name)
    {
        $this->db->insert('category', array('name' => $name));
    }
    public function del_cat($name)
    {
        $this->db->delete('category', array('name' => $name)); 
    }
    public function get_supplier()
    {
        return $this->db->get('supplier')->result();
    }
    
    public function add_supplier($name, $url)
    {
        $this->db->insert('supplier', array('name' => $name, 'url' => $url));
    }
    public function del_supplier($sid)
    {
        $this->db->delete('supplier', array('supplier_id' => $sid)); 
    }
    public function add_product($p)
    {
        $this->db->insert('product', array(
            'name' => $p['name'],
            'desc' => $p['desc'],
            'cost' => $p['cost'],
            'cat_id' => $p['cat_id'],
            'unit_price' => $p['unit_price'],
            'price_before_sale' => -1,
            'added_date' => date('Y-m-d'),
            'supplier_id' => $p['supplier_id'],
            'supplier_product_code' => $p['supplier_product_code'],
            'views' => 0,
        ));
        $pid = $this->db->insert_id();
        
        $this->db->where('product_id', $pid);
        $this->db->update('product', array('display_id' => 'P'.date('ymd').'-'.sprintf('%04d',$pid))); 
        
        foreach($p['size'] as $s)
        {
            if(empty($s)) continue;
            $this->db->insert('product_size', array(
                'product_id' => $pid,
                'size' => $s,
            ));
        }
        foreach($p['color'] as $c)
        {
            if(empty($c)) continue;
            $this->db->insert('product_color', array(
                'product_id' => $pid,
                'color' => $c,
            ));
        }
        
        $img_dir = ___config('base_path').'images/products/'.$pid.'/';
        $old = umask(0); 
        mkdir($img_dir, 0777, TRUE);
        umask($old);
        $img_urls = preg_split("/\r\n|\n|\r/", $p['imgs']);
        foreach($img_urls as $u)
        {
            if(empty($u)) continue;
            $u = trim($u);
            download($u, $img_dir.basename($u));
        }
        create_thumb($img_urls[0], 178, 234, $img_dir.'thumb.jpg');
    }
    
    
    public function random($limit = 20)
    {
		$data = array(); 
        $this->db->order_by("RAND()", "desc"); 
        $data['product_info'] = $this->db->get('product', $limit, 0)->result_array();
		foreach($data['product_info'] as $i=>$p)
		{
            $p['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
			$data['products'][] = $this->load->view('product/product_grid_item', $p, TRUE);
		}
        $data['name'] = 'random'.  random_string();
		return $this->load->view('product/product_showcase', $data, TRUE);
    }
}