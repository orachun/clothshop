<?php

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function display($order_id, $return = false)
    {
		$data['order_id'] = $order_id;
        $this->load->helper('color');
        $data = array();
        $this->load->library('table');
        $tmpl = array (
            'table_open'          => '<table class="item-list" border="0" cellpadding="4" cellspacing="0">',
            'heading_row_start'   => '<tr class="header-row">',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr class="odd">',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr class="even">',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
            );
        $this->table->set_template($tmpl);
        $head = array('รหัส', 'ชื่อสินค้า', 'ขนาด', 'สี', 'จำนวน', 'ราคาต่อชิ้น', 'รวม');
        $this->table->set_heading($head);
        
        $total_items = 0;
        
        ///load ordered items into this array
        $order_items = $this->db->get_where('_customer_ordered_item', 
                array('order_id' => $order_id))->result_array();
        
        $total_before_discount = 0;
        foreach ($order_items as $item)
        {
            $row = array(
                '<div class="id">'.$item['display_id'].'</div>',
                '<div class="name">'.$item['name'].'</div>', 
                '<div class="size">'.$item['size'].'</div>', 
                '<div class="color">'.th_color($item['color']).'</div>', 
                '<div class="qty">'.$item['amount'] . ' ชิ้น'.'</div>',
                '<div class="unit-price">'.number_format($item['unit_price'], 2).' บาท'.'</div>',
                '<div class="sub-total">'.number_format($item['amount']*$item['unit_price'], 2).' บาท'.'</div>'
            );
            $this->table->add_row($row);
            $total_items += $item['amount'];
            $total_before_discount += $item['amount']*$item['unit_price'];
        }
        $data['items'] = $this->table->generate();
        $data['item_count'] = $total_items;
        $data['total_before_discount'] = $total_before_discount;
        
        $data += $this->db->get_where('customer_order', array('order_id'=>$order_id))->row_array();
        
        $customer = $this->db->get_where('customer', array('customer_id'=>$data['customer_id']))->row_array();
        $data['tel'] = $customer['tel'];
        $data['email'] = $customer['email'];
        if($data['customer_coupon_id'] != -1)
        {
            $data['coupon'] = $this->db->get_where('_customer_coupon_display', 
                    array('customer_coupon_id' => $data['customer_coupon_id']))->row_array();
            if($data['coupon']['amount_threshold'] <= $total_before_discount)
            {
                if($data['coupon']['discount_type'] == 'P')
                {
                    $data['coupon']['discount'] = $data['coupon']['amount']*$total_before_discount;
                }
                else
                {
                    $data['coupon']['discount'] = $data['coupon']['amount'];
                }
                $data['coupon']['amount_remain'] = $total_before_discount - $data['coupon']['discount'];
            }
            else
            {
                $data['coupon']['discount'] = 0;
                $data['coupon']['amount_remain'] = $total_before_discount;
            }
        }
        else
        {
            $data['coupon'] = array(
                'name' => 'ไม่ใช้คูปอง',
                'desc' => '',
                'discount' => 0,
                'amount_remain' => $total_before_discount,
            );
        }
        
        $data['delivering'] = $this->db->get_where('delivery_type', 
                array('delivery_type_id'=>$data['delivery_type']))->row_array();
        if($data['delivering']['free_threshold'] <=$total_items)
        {
            $data['delivering']['cost'] = 0;
        }
        else
        {
            $data['delivering']['cost'] = $data['delivering']['unit_cost']*$total_items;
        }
        
        return $this->load->view('order_display', $data, $return);
    }
    
    
    public function payment_inform()
    {
        $time = mktime(
                $this->input->post('paid_hr'), 
                $this->input->post('paid_min'), 
                0, 
                $this->input->post('paid_month'), 
                $this->input->post('paid_day'), 
                $this->input->post('paid_year')-543
        );
        if($time > time())
        {
            echo 'กรุณาตรวจสอบวันที่ชำระเงินค่ะ';
            return;
        }
        $query = $this->db->get_where('customer_order', array('display_id' => $this->input->post('order-id')));
        if($query->num_rows() == 0)
        {
            echo 'ไม่พบหมายเลขคำสั่งซื้อสินค้า '.$this->input->post('order-id').' กรุณาตรวจสอบหมายเลขคำสั่งซื้อสินค้าค่ะ';
            return;
        }
        $order = $query->row();
        if($order->status != 'W' && $order->status != 'P')
        {
            echo 'คำสั่งซื้อสินค้านี้ ไม่ได้อยู่ในสถานะรอชำระเงินค่ะ';
            return;
        }
		
		$this->db->delete('payment_inform', array('order_id' => $order->order_id));
		
        $this->db->insert('payment_inform', array(
            'order_id' => $order->order_id,
            'amount' => $this->input->post('paid_amount'),
            'inform_date' => date('Y-m-d H:i:s'),
            'paid_date' => date('Y-m-d H:i:s', $time),
        ));
        
        if($order->status == 'W')
        {
            $this->db->where('order_id', $order->order_id);
            $this->db->update('customer_order', array('status' => 'P'));
        }
        $file = $this->input->post('file');
        if(!empty($file))
        {
            copy(___config('base_path').'uploads/temp/'.$file, ___config('base_path').'uploads/payment_slips/'.$order->order_id.'.jpg');
            unlink(___config('base_path').'uploads/temp/'.$file);
        }
        
        echo 'ok';
    }
}

