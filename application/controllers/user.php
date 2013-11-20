<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('User_model');
	}	
	
	public function login()
	{
		if($this->User_model->login() === TRUE)
        {
            echo 'ok';
        }
        else
        {
            echo 'กรุณาตรวจสอบอีเมล์และรหัสผ่านค่ะ';
        }
	}

	public function logout()
	{
		$this->User_model->logout();
	}

	public function register()
	{
        $user_info = array(
            'pass' => $this->input->post('pass'),
            'fullname' => $this->input->post('name'),
            'addr' => $this->input->post('addr'),
            'tel' => $this->input->post('tel'),
            'email' => $this->input->post('email'),
        );
		if($this->User_model->register($user_info) !== FALSE)
        {
            echo 'ok';
        }
        else
        {
            echo 'อีเมล์นี้ถูกผู้อื่นใช้แล้วค่ะ';
        }
	}

	public function tab_content()
	{
		if(!$this->User_model->is_logged_in())
		{
			$this->load->view('user/login');
		}
        else
        {
            $data['fullname'] = $this->User_model->current('fullname');
            
            $coupons = $this->User_model->get_coupon();
            $data['coupons'] = array();
            foreach($coupons as $c)
            {
                $data['coupons'][] = array(
                    'summary' => $c['name'].': '.$c['desc'].' (หมดอายุ '.thai_date($c['expired_date']).')',
                    'coupon_left' => $c['remain'],
                    'icon' => $c['icon'],
                );
            }
            $this->load->view('user/account_info', $data);
        }
	}
    public function user_area($tab = NULL)
    {
        if($tab == NULL || !$this->input->is_ajax_request())
        {
            $this->load->model('Product_model');
            $data = array();
            $data['tab'] = $tab;
            $data['contents'] = $this->load->view('user/user_area', $data, TRUE);
            $data['title'] = 'สมาชิก';
            $data['footer'] = '<div class="product-showcase-tabs product-grid">
                                <ul>
                                    <li><a href="#random-tab">สินค้าอื่นๆที่น่าสนใจ</a></li>
                                </ul>
                                <div id="random-tab">'.$this->Product_model->random().'</div>
                            </div>
                            ';
            
        $data['_css'] = array(
            'product',
            'product_detail'
        );
            $this->load->view('template', $data);
        }
        else if($tab == 'general_info')
        {
            $data = $this->User_model->current();
            $this->load->view('user/general_info', $data);
        }
        else if($tab == 'coupon')
        {
            $data['coupons'] = $this->User_model->get_coupon(NULL, FALSE);
            foreach($data['coupons'] as $i => $c)
            {
                $data['coupons'][$i]['usage'] = $this->db->get_where('customer_order', array(
                    'customer_id'=> $this->User_model->current('customer_id'),
                    'customer_coupon_id' => $c['customer_coupon_id'],
                ))->result_array();
            }
            
            $this->load->view('user/coupon', $data);
        }
        else if($tab == 'orders')
        {
            $data['orders'] = $this->db->get_where('_customer_order', array(
                    'customer_id'=> $this->User_model->current('customer_id'),
                ))->result_array();
            $this->load->view('user/orders', $data);
        }
    }
    
    public function edit_info()
	{
        $user_info = array(
            'fullname' => $this->input->post('fullname'),
            'addr' => $this->input->post('addr'),
            'tel' => $this->input->post('tel'),
        );
		if($this->User_model->edit_info($user_info))
        {
            echo 'ok';
        }
        else
        {
            echo 'ไม่สามารถแก้ไขข้อมูลส่วนตัวได้ กรุณาติดต่อทางร้าน หรือลองใหม่ภายหลังค่ะ';
        }
	}
    public function change_pass()
    {
        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        if($this->User_model->change_pass($old_pass, $new_pass))
        {
            echo 'ok';
        }
        else
        {
            echo 'ไม่สามารถแก้ไขรหัสผ่านได้ กรุณาตรวจสอบรหัสผ่านเดิม หรือติดต่อทางร้านค่ะ';
        }
    }
    
	
}

?>
