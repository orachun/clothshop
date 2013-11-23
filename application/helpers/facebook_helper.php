<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

function load_js_sdk($admin = false)
{
	?>
	<div id="fb-root"></div>
	<script>
		var fb_access_token;
		window.fbAsyncInit = function() {
			// init the FB JS SDK
			FB.init({
				appId: '301848219953299', // App ID from the app dashboard
				status: true, // Check Facebook Login status
				xfbml: true   // Look for social plugins on the page
			});

			// Additional initialization code such as adding Event Listeners goes here
			
			<?php if($admin): ?>
			if(FB.getAuthResponse() === undefined)
			{
				FB.login();
			}
			
			FB.Event.subscribe('auth.authResponseChange', function(response) {
				if (response.status === 'connected') {
					var authResponse = FB.getAuthResponse();
					fb_access_token = (authResponse.accessToken);
				} else if (response.status === 'not_authorized') {
					FB.login({scope: 'manage_pages'});
				} else {
					FB.login();
				}
			});
			<?php endif;?>
			
		};

		// Load the SDK asynchronously
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {
				return;
			}
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js";
			fjs.parentNode.insertBefore(js, fjs);
			
		}(document, 'script', 'facebook-jssdk'));

	</script>
	<?php
}

function post_to_fb($img_path, $desc)
{
	require_once ___config('base_path') . 'libs/facebook-sdk/facebook.php';
	$app_id = '301848219953299';
	$app_secret = 'acde5c7f10f1975973122d9d375644b1';
	$fanpage = '216408685185780';
	$album_id = '241399496020032';
	
	$facebook = new Facebook(array(
		'appId' => $app_id,
		'secret' => $app_secret,
		'fileUpload' => true
	));

	$access_token = '';
	if (empty($_POST['access_token']))
	{
		if(empty($_GET['access_token']))
		{
			return false;
		}
		else
		{
			$access_token = $_GET['access_token'];
		}
	}
	else
	{
		$access_token = $_POST['access_token'];
	}
	// Get the page access token
	$accounts = $facebook->api('/orachun/accounts', 'GET', array(
		'access_token' => $access_token
	));

	$data = $accounts['data'];
	foreach ($data as $account)
	{
		if ($account['id'] == $fanpage || $account['name'] == $fanpage)
			$fanpage_token = $account['access_token'];
	}

	$facebook->api('/' . $album_id . '/photos', 'POST', array(
		'message' => $desc,
		'source' => '@' . $img_path,
		'access_token' => $fanpage_token // note, we use the page token here
	));
}

function prepare_fb_desc($desc, $product_info, $link)
{
//	$p = array(
//            'name' => $this->input->post('name'),
//            'desc' => $this->input->post('desc'),
//            'cat_id' => $this->input->post('cat_id'),
//            'cost' => $this->input->post('cost'),
//            'unit_price' => $this->input->post('unit_price'),
//            'supplier_id' => $this->input->post('supplier_id'),
//            'supplier_product_url' => $this->input->post('supplier_product_url'),
//            'imgs' => $this->input->post('imgs'),
//        );
//        $p['color'] = explode(';', $this->input->post('color'));
//        $p['size'] = explode(';', $this->input->post('size'));
	$color_list = '';
	$size_list = '';
	foreach($product_info['size'] as $s)
	{
		if(empty($s)) continue;
		$size_list .= $s.', ';
	}
	foreach($product_info['color'] as $c)
	{
		if(empty($c)) continue;
		$c = explode(':', $c);
		$color_list .= $c[1].', ';
	}
	$color_list = substr($color_list, 0, strlen($color_list)-2);
	$size_list = substr($size_list, 0, strlen($size_list)-2);
	
	
	$desc = str_replace("{desc}", $product_info['desc'], $desc);
	$desc = str_replace("{name}", $product_info['name'], $desc);
	$desc = str_replace("{unit_price}", $product_info['unit_price'], $desc);
	$desc = str_replace("{link}", $link, $desc);
	$desc = str_replace("{colors}", $color_list, $desc);
	$desc = str_replace("{sizes}", $size_list, $desc);
		
	return $desc;
}

function fb_desc_placeholder_list()
{
	return '{desc}, {name}, {unit_price}, {link}, {colors}, {sizes}';
}

function fb_default_desc()
{
	return "{name}: {unit_price} บาท
สี: {colors} ไซส์: {sizes}
{desc}
ดูเต็มๆที่ {link}";
}

function like_btn($url, $return = false)
{
	$btn = '<iframe src="//www.facebook.com/plugins/like.php?href='.urlencode($url).'&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=301848219953299" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:30px;" allowTransparency="true"></iframe>';
	if($return)
	{
		return $btn;
	}
	else
	{
		echo $btn;
	}
}