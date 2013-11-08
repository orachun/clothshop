<style>
    .login-form .form-item
    {
        margin: 5px 0px;
    }
    .login-form .label
    {
        width: 60px;
        display: inline-block;
        vertical-align: top;
    }
    .login-form .form-item input,
    .login-form .form-item textarea
    {
        width: 180px;
		height: 30px;
    }
</style>
<div class="login-form">
	<form class="login">
		<h1>ลงชื่อเข้าใช้</h1>
		<div class="form-item form-item-email">
			<div><input name="email" type="text" placeholder="อีเมล์"/></div>
		</div>
		<div class="form-item form-item-pass">
			<div><input name="pass" type="password" placeholder="รหัสผ่าน" /></div>
		</div>
		<div class="form-item form-item-login-btn">
			<span class="login-btn ui-corner-all button">ลงชื่อเข้าใช้</span>
			<span class="register-btn ui-corner-all button">สมัครสมาชิก</span>
		</div>
	</form>

	<form class="register">
		<h1>สมัครสมาชิก</h1>
		<div class="form-item form-item-email"><label class="label">อีเมล์</label><div><input name="email" type="text"/></div></div>
		<div class="form-item form-item-pass"><label class="label">รหัสผ่าน</label><div><input id="pass" name="pass" type="password"/></div></div>
		<div class="form-item form-item-confirm-pass"><label class="label">ยืนยัน</label><div><input name="confirm_pass" type="password" /></div></div>
		<div class="form-item form-item-name"><label class="label">ชื่อ</label><div><input name="name" type="text"/></div></div>
		<div class="form-item form-item-addr"><label class="label">ที่อยู่</label><div><textarea name="addr"></textarea></div></div>
		<div class="form-item form-item-tel"><label class="label">โทร.</label><div><input name="tel" type="text"/></div></div>
		<div class="form-item form-item-register-btn"><span class="register-btn ui-corner-all button">สมัครสมาชิก</span></div>
	</form>
</div>

<script type="text/javascript" >
	$('.login-form .register').hide();
	$('.login-form .login .register-btn').click(function(){
		$('.login-form .login').slideUp();
		$('.login-form .register').slideDown();
	});
	
	$('.login-form .register .register-btn').click(function () {
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
	});
    
    var login_function = function(){
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
    };
    
    $('.login-form').keypress(function(e) {if(e.which == 13) {
         login_function();
    }});
    $('.login-form .login .login-btn').click(login_function);
    
    themeButton('.login-form');
</script>