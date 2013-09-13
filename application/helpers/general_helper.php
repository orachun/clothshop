<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function ___config($key = NULL)
{
    $___config = array(
        'base_path' => '/home/orachun/public_html/ci/',
        'items_per_page' => 50,
        'items_per_row' => 5,
        'admin_email' => 'orachun.chun@gmail.com',
        'upload_file_delim' => 'z(]9(s[1m'
    );
    if(empty($key))
    {
        return $___config;
    }
    return $___config[$key];
}


if ( ! function_exists('th_color'))
{
	function th_color($col)
    {
        switch($col)
        {
            case 'red': return 'แดง';
            case 'green': return 'เขียว';
            case 'blue': return 'น้ำเงิน';
            case 'lightblue': return 'ฟ้า';
            case 'black': return 'ดำ';
            case 'white': return 'ขาว';
            case 'yellow': return 'เหลือง';
            case 'brown': return 'น้ำตาล';
            case 'purple': return 'ม่วง';
            case 'orange': return 'ส้ม';
            case 'gray': return 'เทา';
            case 'pink': return 'ชมพู';
        }
    }
}

if(!function_exists('get_upload'))
{
    function get_upload($allowed = array(), $dst_dir = './uploads/', $replace = TRUE)
    {
        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
            if(!in_array(strtolower($extension), $allowed)){
                echo '{"status":"error"}';
            }

            if(move_uploaded_file($_FILES['upl']['tmp_name'], $dst_dir.$_FILES['upl']['name'])){
                echo '{"status":"success"}';
            }
        }
        echo '{"status":"error"}';
    }
}


if(!function_exists('to_flat_array'))
{
    function to_flat_array($array, $key)
    {
        $res = array();
        foreach($array as $a)
        {
            $res[] = $a[$key];
        }
        return $res;
    }
}



if(!function_exists('list_file_path')) {
    function list_product_img($dir)
    {
        $files = scandir(___config('base_path').$dir);
        unset($files[0]);
        unset($files[1]);
        $files = array_values($files);
        $res = array();
        for($i=0;$i<count($files);$i++)
        {
            if($files[$i] != 'thumb.jpg')
                $res[] = base_url().$dir.$files[$i];
        }
        return $res;
    }
}


function thai_date($strDate)
{
    $time = strtotime($strDate);
    $strYear = date("Y",$time)+543;
    $strMonth= date("n",$time);
    $strDay= date("j",$time);
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function thai_datetime($strDateTime, $delim = ' ')
{
    $time = strtotime($strDateTime);
    $strYear = date("Y",$time)+543;
    $strMonth= date("n",$time);
    $strDay= date("j",$time);
    $strHour= date("H",$time);
    $strMinute= date("i",$time);
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear$delim$strHour:$strMinute น.";
}

function download($url, $localFile) {
	try {
		$data = file_get_contents($url);
		$handle = fopen($localFile, "w");
		fwrite($handle, $data);
		fclose($handle);
		return true;	
	} catch (Exception $e) {
        echo $e->getMessage();
        return false;
	}
}

function create_thumb($img_url, $width, $height, $thumb_name)
{
    $url = 'http://proxy.boxresizer.com/convert?resize='.$width.'x'.$height.'&source='.urlencode($img_url);
    download($url, $thumb_name);
}

function is_expired($expired_date)
{
    return ((time()-(60*60*24)) >= strtotime($expired_date));
}

function order_status($status)
{
    switch($status)
    {
        case 'W': return 'สั่งซื้อสินค้าแล้ว รอแจ้งชำระเงิน';
        case 'P': return 'แจ้งชำระเงินแล้ว รอตรวจสอบการชำระเงิน';
        case 'C': return 'ตรวจสอบการชำระเงินแล้ว รอจัดส่งสินค้า';
        case 'D': return 'จัดส่งสินค้าเรียบร้อยแล้ว';
    }
}