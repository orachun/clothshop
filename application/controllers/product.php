<?php

class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
	}
    
    public function category_options()
    {
        $cats = $this->Product_model->get_cat();
        foreach($cats as $c)
        {
            echo '<option value="'.$c->product_cat_id.'">'.$c->name.'</option>';
        }
    }
	
    public function search($keyword = 'none')
    {
        $this->index('-1', 'added_date','desc',$keyword,1);
    }
    
	public function index($cat = '-1',$sort = 'product_id', $sort_order = 'desc', $keyword = 'none', $page = 1)
	{
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/product/index/'.$cat.'/'.$sort.'/'.$sort_order.'/'.$keyword;
        $config['uri_segment'] = 7;
        $config['total_rows'] = $this->Product_model->total_product($cat, $keyword);
        $config['per_page'] = ___config('items_per_page'); 
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'หน้าแรก';
        $config['last_link'] = 'หน้าสุดท้าย';
        $this->pagination->initialize($config); 
        
        $data['args'] = array(
            'cat' => $cat,
            'sort' => $sort,
            'sort_order' => $sort_order,
            'keyword' => $keyword,
            'page' => $page
        );
        $data['pager'] = '<div class="pager">'.$this->pagination->create_links().'</div>';
		$data['title'] = 'Product list';
		$data['best_seller'] = $this->Product_model->best_seller_products();
		$data['random_products'] = $this->Product_model->random_products();
		$data['most_viewed'] = $this->Product_model->most_viewed_products();
		
		$products = $this->Product_model->list_product($cat, $sort, $sort_order, $keyword, $page);
        $data['products'] = array();
        //for($i=0;$i<10;$i++)
		foreach($products as $p)
		{
			$data['products'][] = $this->_product_grid_item($p);
		}
        
        $data['_css'] = array(
            'product',
            'product_detail'
        );
        
		$data['contents'] = $this->_main_slide_show() . $this->load->view('/product/product_grid', $data, TRUE);
//        $data['footer'] = '<div class="product-showcase-tabs product-grid">
//                                <ul>
//                                    <li><a href="#random-tab"><span class="tab-eng-title">*SEE ALSO</span> สินค้าอื่นๆที่น่าสนใจ</a></li>
//                                </ul>
//                                <div id="random-tab">'.$data['random'].'</div>
//                            </div>
//                            ';
		$this->load->view('template', $data);
	}
	
//	public function best_seller($limit = 20)
//	{
//		$data = array();
//        $this->db->order_by("bought", "desc"); 
//        $data['product_info'] = $this->db->get('_sold_product', $limit, 0)->result_array();
//		foreach($data['product_info'] as $i=>$p)
//		{
//            $p['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
//			$data['products'][] = $this->_product_grid_item($p);
//		}
//        $data['name'] = 'best-seller';
//		return $this->load->view('product/product_showcase', $data, TRUE);
//	}
//    public function random($limit = 20)
//    {
//		$data = array(); 
//        $this->db->order_by("RAND()", "desc"); 
//        $data['product_info'] = $this->db->get('product', $limit, 0)->result_array();
//		foreach($data['product_info'] as $i=>$p)
//		{
//            $p['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
//			$data['products'][] = $this->_product_grid_item($p);
//		}
//        $data['name'] = 'random'.  random_string();
//		return $this->load->view('product/product_showcase', $data, TRUE);
//    }
//    public function most_viewed($limit = 20)
//    {
//        $data = array(); 
//        $this->db->order_by("views", "desc"); 
//        $data['product_info'] = $this->db->get('product', $limit, 0)->result_array();
//		foreach($data['product_info'] as $i=>$p)
//		{
//            $p['img'] = base_url().'images/products/'.$p['product_id'].'/thumb.jpg';
//			$data['products'][] = $this->_product_grid_item($p);
//		}
//        $data['name'] = 'most-viewed';
//		return $this->load->view('product/product_showcase', $data, TRUE);
//    }
	
	private function _product_grid_item($product)
	{
		$data = $product;
		return $this->load->view('product/product_grid_item', $data, TRUE);
	}
	
	public function detail($pid, $ajax = 'false')
	{
		$data = $this->Product_model->get_product($pid);
        $data['ajax'] = $ajax;

		if(strcmp($ajax,'false')==0)
		{
			$data['title'] = 'Product Detail';
		    $data['_css'] = array(
		        'product',
		        'product_detail'
		    );
			$data['footer'] = $this->Product_model->random_products();
			$data['contents'] = $this->load->view('product/product_detail', $data, TRUE);
			$this->load->view('template', $data);
		}
		else
		{
            $this->load->view('product/product_detail', $data);
		}
        $this->Product_model->increase_view($pid);
	}
	
	private function _main_slide_show()
	{
		$data['slides'] = $this->db->get('slideshow')->result_array();
		return $this->load->view('/slide_show', $data, TRUE);
	}
}
