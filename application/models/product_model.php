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
            $data['images'] = list_product_img('images/products/'.$pid.'/imgs/');
            $data['thumbs'] = list_product_img('images/products/'.$pid.'/thumbs/'); 
            $data['thumb'] = base_url().'images/products/'.$pid.'/thumb.jpg';
            $colors = $this->_get_product_prop($pid, 'color');
            $data['avail_colors'] = array();
            foreach($colors as $c)
            {
                $data['avail_colors'][$c['value']] = $c['value2'];
            }
            
            $sizes = $this->_get_product_prop($pid, 'size');
            $data['avail_sizes'] = array();
            foreach($sizes as $c)
            {
                $data['avail_sizes'][] = $c['value'];
            }
            
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
		$this->load->helper('image');
		
		//Save product data
        $this->db->insert('product', array(
            'name' => $p['name'],
            'desc' => $p['desc'],
            'cost' => $p['cost'],
            'cat_id' => $p['cat_id'],
            'unit_price' => $p['unit_price'],
            'price_before_sale' => -1,
            'added_date' => date('Y-m-d'),
            'supplier_id' => $p['supplier_id'],
            'supplier_product_url' => $p['supplier_product_url'],
            'views' => 0,
        ));
        $pid = $this->db->insert_id();
        
        $this->db->where('product_id', $pid);
        $this->db->update('product', array('display_id' => 'P'.date('md').'-'.$pid)); 
        
		//Save product available sizes and colors
        foreach($p['size'] as $s)
        {
            if(empty($s)) continue;
            $this->_add_product_prop($pid, 'size', $s);
        }
        foreach($p['color'] as $c)
        {
            if(empty($c)) continue;
            $this->_add_product_prop($pid, 'color', explode(':',$c));
        }
        
		//Save product images
        $img_dir = ___config('base_path').'images/products/'.$pid.'/';
        $old = umask(0); 
        mkdir($img_dir.'imgs', 0777, TRUE);
        mkdir($img_dir.'thumbs', 0777, TRUE);
        umask($old);
        $img_urls = preg_split("/\r\n|\n|\r/", $p['imgs']);
		try{
        foreach($img_urls as $i=>$u)
        {
            if(empty($u)) continue;
            $u = trim($u);
			
			image_download($u, $img_dir.'imgs/'.$i.'.jpg', $img_dir.'thumbs/'.$i.'.jpg');
        }
		image_grid_item_prepare($img_urls[0], $img_dir.'thumb.jpg');
		}catch(Exception $e){echo $e->getMessage();}
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
    
    private function _add_product_prop($pid, $key, $values = array())
    {
        if(!is_array($values))
        {
            $values = array($values);
        }
        $record = array('product_id' => $pid, 'key' => $key, 'value' => $values[0]);
        if(count($values)>1)
        {
            $record['value2'] = $values[1];
        }
        if(count($values)>2)
        {
            $record['value3'] = $values[2];
        }
        $this->db->insert('product_property', $record);
    }
    
    private function _get_product_prop($pid, $key)
    {
        $result = $this->db->get_where('product_property', 
                array('product_id' => $pid, 'key' => $key))->result_array();
        if(count($result) == 1)
        {
            $result = $result[0];
        }
        return $result;
    }
	
	public function best_seller_products($limit = 20)
	{
		$data = array();
        $this->db->order_by("bought", "desc"); 
        $data['product_info'] = $this->db->get('_sold_product', $limit, 0)->result_array();
		foreach($data['product_info'] as $i=>$p)
		{
            $p['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
			$data['products'][] = $this->load->view('product/product_grid_item', $p, TRUE);
		}
        $data['name'] = 'best-seller';
		$data['title_en'] = '*BEST SELLERS';
		$data['title_th'] = 'สินค้าขายดี';
		return $this->load->view('product/product_showcase', $data, TRUE);
	}
	public function random_products($limit = 20)
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
		$data['title_en'] = '*OTHERS';
		$data['title_th'] = 'สินค้าอื่นๆที่น่าสนใจ';
		return $this->load->view('product/product_showcase', $data, TRUE);
	}
	public function most_viewed_products($limit = 20)
    {
        $data = array(); 
        $this->db->order_by("views", "desc"); 
        $data['product_info'] = $this->db->get('product', $limit, 0)->result_array();
		foreach($data['product_info'] as $i=>$p)
		{
            $p['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
			$data['products'][] = $this->load->view('product/product_grid_item', $p, TRUE);
		}
        $data['name'] = 'most-viewed';
		$data['title_en'] = '*MOST VIEWED';
		$data['title_th'] = 'สินค้าที่คนดูมากที่สุด';
		return $this->load->view('product/product_showcase', $data, TRUE);
	}
}