<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function current($field = NULL)
    {
        if(empty($field))
        {
            return $this->session->userdata('USER_DATA');
        }
        else
        {
            return $this->session->userdata('USER_DATA')->$field;
        }
    }
    
    public function login()
    {
		$email = $this->input->post("email");
		$pass = $this->input->post("pass");
        $query = $this->db->get_where('customer', array('email' => $email, 'pass' => md5($pass)));
        if ($query->num_rows() > 0)
        {
            $this->session->set_userdata('USER_DATA', $query->row());
            $this->session->set_userdata('IS_LOGGED_IN', TRUE);
            return TRUE;
        }
		else
        {
            return FALSE;
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('USER_DATA');
        $this->session->set_userdata('IS_LOGGED_IN', FALSE);
    }
    
    public function register($user_info)
    {
		$pass = $user_info["pass"];
		$fullname = $user_info["name"];
		$addr = $user_info["addr"];
		$tel = $user_info["tel"];
		$email = $user_info["email"];
        
        if(!$this->email_exists($email))
        {
            $data = array(
                'fullname' => $fullname,
                'addr' => $addr,
                'tel' => $tel,
                'email' => $email,
                'registered_date' => date('Y-m-d'),
                'pass' => md5($pass),
             );
            $this->db->insert('customer', $data); 
            $this->session->set_userdata('IS_LOGGED_IN', FALSE);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }
    
    public function record_customer($user_info)
    {
        $fullname = $user_info["name"];
		$addr = $user_info["addr"];
		$tel = $user_info["tel"];
		$email = $user_info["email"];
        
        $data = array(
            'fullname' => $fullname,
            'addr' => $addr,
            'tel' => $tel,
            'email' => $email,
            'registered_date' => date('Y-m-d')
         );
        $this->db->insert('customer', $data); 
        $this->session->set_userdata('IS_LOGGED_IN', FALSE);
        return $this->db->insert_id();
    }
    
    public function email_exists($email)
    {
        $query = $this->db->get_where('customer', array('email' => $email));
        return $query->num_rows() > 0;
    }
    
    public function is_logged_in()
    {
		return $this->session->userdata('IS_LOGGED_IN') === TRUE;
    }
    
    public function is_admin()
    {
        if($this->is_logged_in() && $this->current('email') == ___config('admin_email'))
        {
            return true;
        }
        return false;
    }
    
    public function get_coupon($cid = NULL, $only_valid_coupon = TRUE)
    {
        if($cid == NULL)
        {
            $cid = $this->current('customer_id');
        }
        
        $query = $this->db->get_where('_customer_coupon_display', array('customer_id' => $cid));
        
		$coupon = $query->result_array();
		$count = count($coupon);
		for($i=0;$i<$count;$i++)
		{
			if($only_valid_coupon && 
					($coupon[$i]['remain'] == 0 || is_expired($coupon[$i]['expired_date'])))
			{
				unset($coupon[$i]);
				continue;
			}
			else
			{
				$coupon[$i]['icon'] = base_url().'images/discount_icons/'.$coupon[$i]['amount'].'.png';
			}
		}
		$coupon = array_values($coupon);
        
        return $coupon;
    }
    
    public function edit_info($user_info)
    {
        $this->db->where('customer_id', $this->current('customer_id'));
        $this->db->update('customer', $user_info); 
        if($this->db->affected_rows() == 1)
        {
            $user_data = $this->db->get_where('customer', array('customer_id' => $this->current('customer_id')))->row();
            $this->session->set_userdata('USER_DATA', $user_data);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }
    
    public function change_pass($old, $new)
    {
        $this->db->where('customer_id', $this->current('customer_id'));
        $this->db->where('pass', md5($old));
        $this->db->update('customer', array('pass' => md5($new)));
        if($this->db->affected_rows() == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
