<style>
    .login-form .form-item
    {
        margin: 5px 0px;
    }
    .login-form .form-item input[type="text"],
    .login-form .form-item input[type="password"]
	{
		width: 180px;
		height: 30px;
	}
    .login-form .form-item textarea
    {
        width: 180px;
		height: 50px;
    }
</style>
<div class="login-form">
	<form class="login"><?php set_cookie(array('name'=> 'login_cookie', 'value'=>1));echo get_cookie('login_cookie');?>
		<h1>ลงชื่อเข้าใช้</h1>
		<div class="form-item form-item-email">
			<input name="email" type="text" placeholder="อีเมล์"/>
		</div>
		<div class="form-item form-item-pass">
			<input name="pass" type="password" placeholder="รหัสผ่าน" />
		</div>
		<div class="form-item">
			<label><input type="checkbox" name="remember"/>จดจำการลงชื่อเข้าใช้</label>
		</div>
		<div class="form-item form-item-login-btn">
			<input class="login-btn ui-corner-all button" type="submit" value="ลงชื่อเข้าใช้"/>
			<input class="register-btn ui-corner-all button" type="button" value="สมัครสมาชิก"/>
		</div>
	</form>

	<form class="register">
		<h1>สมัครสมาชิก</h1>
		<div class="form-item form-item-email">
			<input name="email" type="text" placeholder="อีเมล์"/>
		</div>
		<div class="form-item form-item-pass">
			<input id="pass" name="pass" type="password" placeholder="รหัสผ่าน"/>
		</div>
		<div class="form-item form-item-confirm-pass">
			<input name="confirm_pass" type="password" placeholder="ยืนยันรหัสผ่าน"/>
		</div>
		<div class="form-item form-item-name">
			<input name="name" type="text" placeholder="ชื่อ-นามสกุล"/>
		</div>
		<div class="form-item form-item-addr">
			<textarea name="addr" placeholder="ที่อยู่ในการจัดส่งสินค้า"></textarea>
		</div>
		<div class="form-item form-item-tel">
			<input name="tel" type="text" placeholder="หมายเลขโทรศัพท์"/>
		</div>
		<div class="form-item form-item-register-btn">
			<input class="register-btn ui-corner-all button" type="submit" value="สมัครสมาชิก"/>
		</div>
	</form>
</div>

<script type="text/javascript" >
	$(function(){
		$('.login-form .register').hide();
		$('.login-form .login .register-btn').click(function(){
			$('.login-form .login').slideUp();
			$('.login-form .register').slideDown();
		});

		$('.login-form .register').submit(function () {
			//validate form
			if(form_valid('.login-form .register', {
				"email": { required: true, email: true },
				"pass": { required: true, minlength:4 },
				"confirm_pass": { required: true, equalTo: '#pass' },
				"name" : { required: true },
				"addr" : { required: true },
				"tel" : {required: true, digits: true, minlength: 9}
				}))
			{
				$('.login-form').parent().waiting();
				$.post('<?php echo base_url();?>index.php/user/register', 
					$('.login-form .register').serialize(), 
					function (data) {
						if(data == 'ok')
						{
							reloadTab($('.user-tab'));
							$('.user-tab').trigger('onlogin');
							notify('success','สมัครสมาชิก','สมัครสมาชิกเรียบร้อยค่ะ');
						}
						else
						{
							notify('error','ไม่สามารถสมัครสมาชิกได้', data);
						}
						$('.login-form').parent().waiting('done');
					}
				);
			}
			return false;
		});

		$('.login-form .login').submit(function(){
			if(form_valid('.login-form .login', {
				"email": { required: true, email: true },
				"pass": { required: true }
				}))
			{

				$('.login-form').parent().waiting();
				$.post('<?php echo base_url();?>index.php/user/login', 
					$('.login-form .login').serialize(), 
					function (data) {
						if(data == 'ok')
						{
							reloadTab($('.user-tab'));
							$('.user-tab').trigger('onlogin');
							notify('success','ลงชื่อเข้าใช้','ลงชื่อเข้าใช้เรียบร้อยค่ะ');
						}
						else
						{
							notify('error','ไม่สามารถลงชื่อเข้าใช้ได้', data)
						}
						$('.login-form').parent().waiting('done');
					}
				);
			}
			return false;
		});
		themeButton('.login-form');
	});
</script>